<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Blog;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class NewsApiService
{
    protected $apiKey;
    protected $baseUrl = 'https://newsapi.org/v2';

    public function __construct()
    {
        $this->apiKey = config('services.newsapi.key');
    }

    /**
     * Off-topic markers that show up in "top-headlines" for general-interest tech outlets
     * even when scoped to tech sources (word-game columns, politics, etc.) — reject
     * regardless of query match. Checked against title + description, case-insensitive.
     */
    protected $blocklist = [
        'hints and answers', 'wordle', 'quordle', 'nyt connections', 'nyt strands', 'crossword',
        'deportation', 'immigration', ' ice raid', ' ice arrest', 'embryo', 'abortion',
        'senate', 'congress', 'election', 'supreme court', 'government shutdown',
        'ceasefire', 'shooting', 'homicide', 'trial verdict', 'war in ',
        'world cup', 'fifa', 'kick-off', 'kickoff', 'premier league', 'champions league',
        'olympics', 'super bowl', 'nba finals', 'grand slam', 'how to watch', 'live stream',
    ];

    /**
     * At least one of these must appear in title + description for an article to
     * be considered on-topic for a tech/ICT company blog. "streaming" deliberately
     * excluded — too easily matched by sports/TV "how to watch" guides.
     */
    protected $allowlist = [
        'tech', 'software', 'app', 'ai', 'artificial intelligence', 'startup', 'cloud',
        'cyber', 'data', 'device', 'gadget', 'internet', 'digital', 'hardware', 'chip',
        'smartphone', 'computer', 'robot', 'code', 'developer', 'platform', 'api',
        'gaming', 'console', 'wearable', 'social media', 'browser',
        'operating system', 'processor', 'battery', 'camera', 'laptop', 'tablet',
        'headphone', 'earbud', 'router', 'network', 'encryption', ' vr ', ' ar ',
        'crypto', 'blockchain',
    ];

    /**
     * Reject clearly off-topic articles (word-game columns, politics, etc.) that slip
     * through NewsAPI's per-source "top-headlines" feed even when scoped to tech sources.
     * Blocklist wins over allowlist (e.g. "startup" + "embryo" still gets rejected).
     */
    protected function isRelevant(array $article): bool
    {
        $haystack = strtolower(($article['title'] ?? '') . ' ' . ($article['description'] ?? ''));

        foreach ($this->blocklist as $term) {
            if (str_contains($haystack, $term)) {
                return false;
            }
        }

        foreach ($this->allowlist as $term) {
            if (str_contains($haystack, $term)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Fetch articles from NewsAPI
     */
    public function fetchArticles($sources = null, $limit = 20)
    {
        try {
            $sources = $sources ?? config('services.newsapi.sources', 'techcrunch,the-verge,wired');

            // Note: NewsAPI's top-headlines endpoint returns zero results when a 'q' query
            // is combined with a multi-source 'sources' filter (tested directly — totalResults
            // drops from 80 to 0 with q added). Topic relevance is enforced entirely by
            // isRelevant() below instead, after fetching the full unfiltered source feed.
            $response = Http::get("{$this->baseUrl}/top-headlines", [
                'apiKey' => $this->apiKey,
                'sources' => $sources,
                'pageSize' => $limit,
                'language' => 'en'
            ]);

            if ($response->successful()) {
                return $response->json()['articles'] ?? [];
            }

            Log::error('NewsAPI fetch failed', ['response' => $response->body()]);
            return [];
        } catch (\Exception $e) {
            Log::error('NewsAPI exception', ['message' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Import articles into database
     */
    public function importArticles($articles)
    {
        $imported = 0;
        $skipped = 0;
        $filtered = 0;
        $curatedAuthor = Author::firstOrCreate(
            ['slug' => 'bytewave-tech-desk'],
            [
                'name' => 'ByteWave Tech Desk',
                'email' => 'editorial@bytewave.com',
                'bio' => 'Curated tech news roundups from around the web, with commentary from the ByteWave team.',
                'avatar' => '/bytewave_icon.jpg',
            ]
        );

        if (!$curatedAuthor) {
            Log::error('No curated author found. Please run BlogSystemSeeder first.');
            return 0;
        }

        foreach ($articles as $article) {
            // Skip if already exists
            if (Blog::where('source_url', $article['url'])->exists()) {
                $skipped++;
                Log::info('Skipping duplicate article', ['title' => $article['title']]);
                continue;
            }

            // Skip articles without title or description
            if (empty($article['title']) || empty($article['description'])) {
                continue;
            }

            // Skip off-topic articles (word-game columns, politics, etc.) — this is the
            // only safety net now that imports auto-publish with no human review step.
            if (!$this->isRelevant($article)) {
                $filtered++;
                Log::info('Skipping off-topic article', ['title' => $article['title']]);
                continue;
            }

            // Map source to category
            $category = $this->mapSourceToCategory($article['source']['name'] ?? 'Technology');

            // Download and store image
            $coverImage = null;
            if (!empty($article['urlToImage'])) {
                $coverImage = $this->downloadImage($article['urlToImage']);
            }

            // Build a short, original-style commentary instead of republishing the source's
            // own text — avoids duplicate-content/ToS risk from mirroring full articles.
            // strtr (not sprintf) since titles/descriptions may contain literal "%" characters.
            $commentary = strtr("**ByteWave's take:** {source} reports on \"{title}.\"\n\n{description}\n\n*Read the full story at the source link below.*", [
                '{source}' => $article['source']['name'] ?? 'a tech outlet',
                '{title}' => $article['title'],
                '{description}' => $article['description'],
            ]);

            // Create blog post as a published digest — auto-published per business decision,
            // relying on the isRelevant() topic filter above as the only gate (no human
            // review step). featured/hero stay false so auto-imports can't hijack the
            // homepage hero/featured slots without human curation.
            $blog = Blog::create([
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'content' => $commentary,
                'excerpt' => Str::limit($article['description'], 100),
                'cover_image' => $coverImage,
                'author_id' => $curatedAuthor->id,
                'author_name' => $curatedAuthor->name,
                'category_id' => $category->id,
                'source_url' => $article['url'],
                'source_name' => $article['source']['name'],
                'published_at' => $article['publishedAt'] ?? now(),
                'is_published' => true,
                'featured' => false,
                'hero' => false,
                'views' => 0,
                'meta_description' => Str::limit($article['description'], 160)
            ]);

            // Calculate read time
            $blog->calculateReadTime();
            $blog->save();

            // Assign tags based on category
            $this->assignTags($blog, $category);

            $imported++;
        }

        Log::info('Article import completed', [
            'imported' => $imported,
            'skipped' => $skipped,
            'filtered_off_topic' => $filtered,
            'total_processed' => count($articles)
        ]);

        return $imported;
    }

    /**
     * Map NewsAPI source to category
     */
    protected function mapSourceToCategory($sourceName)
    {
        $mapping = [
            'TechCrunch' => 'Technology',
            'The Verge' => 'Technology',
            'Wired' => 'Technology',
            'Ars Technica' => 'Technology',
            'Engadget' => 'Technology',
            'Mashable' => 'Multimedia',
            'The Next Web' => 'Web Development'
        ];

        $categoryName = $mapping[$sourceName] ?? 'Technology';
        return Category::where('name', $categoryName)->first() ?? Category::first();
    }

    /**
     * Download and store image
     */
    protected function downloadImage($url)
    {
        try {
            $response = Http::timeout(10)->get($url);
            
            if ($response->successful()) {
                $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                $filename = Str::random(40) . '.' . $extension;
                $path = 'blog/' . date('Y/m');
                $fullPath = storage_path('app/public/' . $path);

                if (!file_exists($fullPath)) {
                    mkdir($fullPath, 0755, true);
                }

                file_put_contents($fullPath . '/' . $filename, $response->body());
                
                return 'storage/' . $path . '/' . $filename;
            }
        } catch (\Exception $e) {
            Log::warning('Image download failed', ['url' => $url, 'error' => $e->getMessage()]);
        }

        return null;
    }

    /**
     * Assign relevant tags to blog
     */
    protected function assignTags($blog, $category)
    {
        $tagMapping = [
            'Technology' => ['AI', 'Cloud Computing', 'DevOps'],
            'Web Development' => ['Laravel', 'React', 'JavaScript'],
            'Mobile Apps' => ['iOS', 'Android', 'Mobile Development'],
            'Design' => ['UI/UX', 'Design'],
            'AI & Machine Learning' => ['AI', 'Machine Learning', 'Python'],
            'Multimedia' => ['Video Editing', 'Audio Production']
        ];

        $tagNames = $tagMapping[$category->name] ?? [];
        $tags = Tag::whereIn('name', $tagNames)->get();

        if ($tags->isNotEmpty()) {
            $blog->tags()->attach($tags->pluck('id'));
        }
    }
}
