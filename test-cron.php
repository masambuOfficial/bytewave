<?php
/**
 * Test if cron is working and manually trigger news fetch
 * Access via: https://yourdomain.com/test-cron.php
 * DELETE THIS FILE AFTER TESTING FOR SECURITY!
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Services\NewsApiService;
use App\Models\Blog;

echo "<h2>BYTEWAVE News Fetch Test</h2>";
echo "<hr>";

// Check current articles
echo "<h3>Current Article Count: " . Blog::count() . "</h3>";
echo "<p>Latest article created: " . Blog::orderBy('created_at', 'desc')->first()?->created_at . "</p>";
echo "<hr>";

// Test NewsAPI connection
echo "<h3>Testing NewsAPI Connection...</h3>";
$newsService = new NewsApiService();
$articles = $newsService->fetchArticles(null, 5);

if (empty($articles)) {
    echo "<p style='color: red;'>❌ Failed to fetch articles from NewsAPI</p>";
    echo "<p>Possible issues:</p>";
    echo "<ul>";
    echo "<li>Check NEWS_API_KEY in .env file</li>";
    echo "<li>Verify internet connection</li>";
    echo "<li>Check NewsAPI quota (free tier has limits)</li>";
    echo "</ul>";
} else {
    echo "<p style='color: green;'>✅ Successfully fetched " . count($articles) . " articles from NewsAPI</p>";
    echo "<hr>";
    
    echo "<h3>Importing Articles...</h3>";
    $imported = $newsService->importArticles($articles);
    
    if ($imported > 0) {
        echo "<p style='color: green;'>✅ Successfully imported {$imported} new articles!</p>";
        echo "<p><strong>Refresh your website to see the new articles.</strong></p>";
    } else {
        echo "<p style='color: orange;'>⚠️ No new articles imported (they may already exist in database)</p>";
    }
    
    echo "<hr>";
    echo "<h3>Sample Articles from NewsAPI:</h3>";
    echo "<ul>";
    foreach (array_slice($articles, 0, 3) as $article) {
        echo "<li><strong>" . htmlspecialchars($article['title']) . "</strong><br>";
        echo "<small>Source: " . htmlspecialchars($article['source']['name']) . " | ";
        echo "Published: " . $article['publishedAt'] . "</small></li>";
    }
    echo "</ul>";
}

echo "<hr>";
echo "<h3>Updated Article Count: " . Blog::count() . "</h3>";
echo "<p>Latest article created: " . Blog::orderBy('created_at', 'desc')->first()?->created_at . "</p>";

echo "<hr>";
echo "<h3>Cron Job Status</h3>";
echo "<p>To verify cron is running, check cPanel → Cron Jobs → View Cron Job History</p>";
echo "<p>The schedule:run command should execute every minute.</p>";
echo "<p>News will auto-fetch every 6 hours once cron is active.</p>";

echo "<hr>";
echo "<p style='color: red; font-weight: bold;'>⚠️ DELETE THIS FILE AFTER TESTING FOR SECURITY!</p>";
?>
