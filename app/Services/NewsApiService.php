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
     * Fetch articles from NewsAPI
     */
    public function fetchArticles($sources = null, $limit = 20)
    {
        try {
            $sources = $sources ?? config('services.newsapi.sources', 'techcrunch,the-verge,wired');
            
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
        $defaultAuthor = Author::first();

        if (!$defaultAuthor) {
            Log::error('No default author found. Please run BlogSystemSeeder first.');
            return 0;
        }

        foreach ($articles as $article) {
            // Skip if already exists
            if (Blog::where('source_url', $article['url'])->exists()) {
                continue;
            }

            // Skip articles without title or description
            if (empty($article['title']) || empty($article['description'])) {
                continue;
            }

            // Map source to category
            $category = $this->mapSourceToCategory($article['source']['name'] ?? 'Technology');

            // Download and store image
            $coverImage = null;
            if (!empty($article['urlToImage'])) {
                $coverImage = $this->downloadImage($article['urlToImage']);
            }

            // Create blog post
            $blog = Blog::create([
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'content' => $article['content'] ?? $article['description'],
                'excerpt' => Str::limit($article['description'], 100),
                'cover_image' => $coverImage,
                'author_id' => $defaultAuthor->id,
                'author_name' => $article['author'] ?? $article['source']['name'],
                'category_id' => $category->id,
                'source_url' => $article['url'],
                'source_name' => $article['source']['name'],
                'published_at' => $article['publishedAt'] ?? now(),
                'is_published' => true,
                'featured' => $imported < 3, // First 3 are featured
                'hero' => $imported === 0, // First one is hero
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
