<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsApiService;

class FetchNewsArticles extends Command
{
    protected $signature = 'news:fetch {--limit=20 : Number of articles to fetch}';
    protected $description = 'Fetch latest articles from NewsAPI and import them into the database';

    public function handle(NewsApiService $newsApiService)
    {
        $this->info('Fetching articles from NewsAPI...');

        $limit = $this->option('limit');
        $articles = $newsApiService->fetchArticles(null, $limit);

        if (empty($articles)) {
            $this->error('No articles fetched. Please check your API key and internet connection.');
            return 1;
        }

        $this->info('Found ' . count($articles) . ' articles from NewsAPI. Importing...');

        $imported = $newsApiService->importArticles($articles);

        if ($imported > 0) {
            $this->info("✅ Successfully imported and published {$imported} new digest posts.");
        } else {
            $this->warn("⚠️  No new articles imported. All fetched articles were either duplicates or filtered out as off-topic.");
            $this->info("This is normal - NewsAPI free tier only provides recent articles (24-48 hours), and the topic filter rejects non-tech headlines.");
        }

        return 0;
    }
}
