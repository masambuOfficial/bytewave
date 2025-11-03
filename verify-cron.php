<?php
/**
 * Quick verification that cron is working
 * Access via: https://yourdomain.com/verify-cron.php
 * DELETE AFTER VERIFYING!
 */

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Blog;

$latestArticle = Blog::orderBy('created_at', 'desc')->first();
$totalArticles = Blog::count();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cron Verification - BYTEWAVE</title>
    <meta http-equiv="refresh" content="30">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .status { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .info { background: #e3f2fd; border-left: 4px solid #2196f3; }
        .success { background: #e8f5e9; border-left: 4px solid #4caf50; }
        .warning { background: #fff3e0; border-left: 4px solid #ff9800; }
        h1 { color: #333; }
        .time { color: #666; font-size: 14px; }
        .delete-warning { color: red; font-weight: bold; margin-top: 20px; padding: 15px; background: #ffebee; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 BYTEWAVE Cron Job Monitor</h1>
        <p class="time">Last checked: <?php echo date('Y-m-d H:i:s'); ?> (Auto-refreshes every 30 seconds)</p>
        
        <div class="status info">
            <h3>📊 Current Status</h3>
            <p><strong>Total Articles:</strong> <?php echo $totalArticles; ?></p>
            <?php if ($latestArticle): ?>
                <p><strong>Latest Article:</strong> <?php echo htmlspecialchars($latestArticle->title); ?></p>
                <p><strong>Created:</strong> <?php echo $latestArticle->created_at->format('Y-m-d H:i:s'); ?></p>
                <p><strong>Source:</strong> <?php echo htmlspecialchars($latestArticle->source_name ?? 'N/A'); ?></p>
            <?php endif; ?>
        </div>

        <div class="status success">
            <h3>✅ Cron Job Configuration</h3>
            <p><strong>Command:</strong> <code>cd ~/bytewave/bytewave_app && php artisan schedule:run</code></p>
            <p><strong>Frequency:</strong> Every minute</p>
            <p><strong>News Fetch Schedule:</strong> Every hour (temporarily for testing)</p>
        </div>

        <div class="status warning">
            <h3>⏰ What to Expect</h3>
            <ul>
                <li>Cron runs every minute checking for scheduled tasks</li>
                <li>News fetch is scheduled to run every hour (at the top of each hour)</li>
                <li>New articles will appear within the next hour</li>
                <li>This page auto-refreshes every 30 seconds to show updates</li>
            </ul>
        </div>

        <div class="status info">
            <h3>🔍 How to Verify Cron is Running</h3>
            <ol>
                <li>Go to cPanel → Cron Jobs</li>
                <li>Look for "Cron Job History" or "View Logs"</li>
                <li>You should see executions every minute</li>
                <li>Wait until the top of the next hour (e.g., 7:00 PM)</li>
                <li>Refresh this page - article count should increase</li>
            </ol>
        </div>

        <div class="delete-warning">
            ⚠️ <strong>SECURITY WARNING:</strong> Delete this file (verify-cron.php) after confirming cron is working!
        </div>
    </div>
</body>
</html>
