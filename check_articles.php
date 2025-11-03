<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Blog;

echo "=== Latest Articles Check ===\n\n";

$articles = Blog::orderBy('created_at', 'desc')->take(10)->get();

if ($articles->isEmpty()) {
    echo "No articles found in database.\n";
} else {
    echo "Total articles: " . Blog::count() . "\n\n";
    echo "Latest 10 articles:\n";
    echo str_repeat("-", 100) . "\n";
    
    foreach ($articles as $article) {
        echo sprintf(
            "Title: %s\nCreated: %s\nPublished: %s\nSource: %s\n%s\n",
            substr($article->title, 0, 60),
            $article->created_at->format('Y-m-d H:i:s'),
            $article->published_at ? $article->published_at->format('Y-m-d H:i:s') : 'N/A',
            $article->source_name ?? 'N/A',
            str_repeat("-", 100)
        );
    }
}

echo "\n=== Schedule Status ===\n";
echo "The news:fetch command is scheduled to run every 6 hours.\n";
echo "However, Laravel's scheduler requires a cron job to be running.\n\n";

echo "On Windows, you need to either:\n";
echo "1. Run manually: php artisan news:fetch\n";
echo "2. Set up Windows Task Scheduler to run: php artisan schedule:run every minute\n";
