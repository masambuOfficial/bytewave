<?php
/**
 * Debug NewsAPI responses to see what's actually being returned
 * DELETE AFTER DEBUGGING!
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Http;
use App\Models\Blog;

$apiKey = config('services.newsapi.key');
$sources = config('services.newsapi.sources');

?>
<!DOCTYPE html>
<html>
<head>
    <title>NewsAPI Debug - BYTEWAVE</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        .section { margin: 20px 0; padding: 15px; border-left: 4px solid #2196f3; background: #f9f9f9; }
        .error { border-left-color: #f44336; background: #ffebee; }
        .success { border-left-color: #4caf50; background: #e8f5e9; }
        .warning { border-left-color: #ff9800; background: #fff3e0; }
        pre { background: #263238; color: #aed581; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .article { border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 NewsAPI Debug Report</h1>
        
        <div class="section">
            <h3>📋 Configuration</h3>
            <p><strong>API Key:</strong> <?php echo substr($apiKey, 0, 10); ?>...<?php echo substr($apiKey, -5); ?></p>
            <p><strong>Sources:</strong> <?php echo $sources; ?></p>
            <p><strong>Current Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <?php
        // Test API call
        echo "<div class='section'><h3>🌐 Testing NewsAPI Connection...</h3>";
        
        try {
            $response = Http::get("https://newsapi.org/v2/top-headlines", [
                'apiKey' => $apiKey,
                'sources' => $sources,
                'pageSize' => 20,
                'language' => 'en'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $articles = $data['articles'] ?? [];
                
                echo "<p class='success' style='color: green;'>✅ API Connection Successful!</p>";
                echo "<p><strong>Total Results:</strong> " . ($data['totalResults'] ?? 0) . "</p>";
                echo "<p><strong>Articles Returned:</strong> " . count($articles) . "</p>";
                echo "</div>";
                
                // Show article dates
                if (!empty($articles)) {
                    echo "<div class='section'><h3>📅 Article Publication Dates</h3>";
                    echo "<table>";
                    echo "<tr><th>Title</th><th>Source</th><th>Published At</th><th>In DB?</th></tr>";
                    
                    foreach ($articles as $article) {
                        $exists = Blog::where('source_url', $article['url'])->exists();
                        $publishedDate = date('Y-m-d H:i', strtotime($article['publishedAt']));
                        $rowClass = $exists ? "style='background: #fff3e0;'" : "";
                        
                        echo "<tr {$rowClass}>";
                        echo "<td>" . htmlspecialchars(substr($article['title'], 0, 60)) . "...</td>";
                        echo "<td>" . htmlspecialchars($article['source']['name']) . "</td>";
                        echo "<td>{$publishedDate}</td>";
                        echo "<td>" . ($exists ? "✅ Yes" : "❌ No") . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<p><strong>Note:</strong> Yellow rows = already in database</p>";
                    echo "</div>";
                    
                    // Check date range
                    $dates = array_map(function($a) { return strtotime($a['publishedAt']); }, $articles);
                    $oldestDate = date('Y-m-d H:i', min($dates));
                    $newestDate = date('Y-m-d H:i', max($dates));
                    
                    echo "<div class='section warning'>";
                    echo "<h3>⏰ Date Range Analysis</h3>";
                    echo "<p><strong>Oldest Article:</strong> {$oldestDate}</p>";
                    echo "<p><strong>Newest Article:</strong> {$newestDate}</p>";
                    echo "<p><strong>Current Date:</strong> " . date('Y-m-d H:i') . "</p>";
                    
                    $hoursDiff = (time() - min($dates)) / 3600;
                    echo "<p><strong>Age of Oldest Article:</strong> " . round($hoursDiff, 1) . " hours ago</p>";
                    
                    if ($hoursDiff > 48) {
                        echo "<p style='color: red;'>⚠️ <strong>Issue Found:</strong> NewsAPI free tier only provides articles from the last 24-48 hours, but the oldest article is " . round($hoursDiff, 1) . " hours old. This suggests the API is returning stale data or there are no newer articles from these sources.</p>";
                    }
                    echo "</div>";
                    
                    // Show sample article
                    echo "<div class='section'>";
                    echo "<h3>📰 Sample Article (First Result)</h3>";
                    echo "<pre>" . json_encode($articles[0], JSON_PRETTY_PRINT) . "</pre>";
                    echo "</div>";
                    
                } else {
                    echo "<div class='section error'>";
                    echo "<p style='color: red;'>❌ No articles returned from API</p>";
                    echo "</div>";
                }
                
                // Check database
                echo "<div class='section'>";
                echo "<h3>💾 Database Status</h3>";
                $dbArticles = Blog::orderBy('created_at', 'desc')->take(10)->get();
                echo "<p><strong>Total Articles in DB:</strong> " . Blog::count() . "</p>";
                echo "<p><strong>Latest 10 Articles:</strong></p>";
                echo "<table>";
                echo "<tr><th>Title</th><th>Created At</th><th>Published At</th></tr>";
                foreach ($dbArticles as $article) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars(substr($article->title, 0, 50)) . "...</td>";
                    echo "<td>" . $article->created_at->format('Y-m-d H:i') . "</td>";
                    echo "<td>" . ($article->published_at ? $article->published_at->format('Y-m-d H:i') : 'N/A') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
                
            } else {
                echo "<p class='error' style='color: red;'>❌ API Request Failed</p>";
                echo "<p><strong>Status Code:</strong> " . $response->status() . "</p>";
                echo "<p><strong>Response:</strong></p>";
                echo "<pre>" . $response->body() . "</pre>";
                echo "</div>";
            }
            
        } catch (Exception $e) {
            echo "<p class='error' style='color: red;'>❌ Exception: " . $e->getMessage() . "</p>";
            echo "</div>";
        }
        ?>
        
        <div class="section error">
            <h3>🔒 Security Warning</h3>
            <p><strong>DELETE THIS FILE IMMEDIATELY AFTER DEBUGGING!</strong></p>
            <p>This file exposes sensitive information about your API configuration.</p>
        </div>
    </div>
</body>
</html>
