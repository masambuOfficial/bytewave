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

        $this->info('Found ' . count($articles) . ' articles. Importing...');

        $imported = $newsApiService->importArticles($articles);

        $this->info("Successfully imported {$imported} new articles.");

        return 0;
    }
}
