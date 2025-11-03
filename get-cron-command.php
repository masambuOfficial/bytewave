<?php
/**
 * Run this file once uploaded to cPanel to get the exact cron command
 * Access via: https://yourdomain.com/get-cron-command.php
 */

$basePath = dirname(__DIR__); // Parent directory since we're in public/
$phpPath = PHP_BINARY;

echo "<h2>cPanel Cron Job Setup Instructions</h2>";
echo "<h3>Your Cron Command:</h3>";
echo "<pre style='background: #f4f4f4; padding: 15px; border: 1px solid #ddd;'>";
echo "cd {$basePath} && {$phpPath} artisan schedule:run >> /dev/null 2>&1";
echo "</pre>";

echo "<h3>Alternative (if above doesn't work):</h3>";
echo "<pre style='background: #f4f4f4; padding: 15px; border: 1px solid #ddd;'>";
echo "/usr/bin/php {$basePath}/artisan schedule:run >> /dev/null 2>&1";
echo "</pre>";

echo "<h3>Steps:</h3>";
echo "<ol>";
echo "<li>Log into cPanel</li>";
echo "<li>Go to 'Cron Jobs'</li>";
echo "<li>Set frequency to: <strong>Once Per Minute</strong> (or */1 for all time fields)</li>";
echo "<li>Paste one of the commands above</li>";
echo "<li>Click 'Add New Cron Job'</li>";
echo "</ol>";

echo "<h3>Current Server Info:</h3>";
echo "<ul>";
echo "<li><strong>PHP Binary:</strong> {$phpPath}</li>";
echo "<li><strong>Base Path:</strong> {$basePath}</li>";
echo "<li><strong>PHP Version:</strong> " . PHP_VERSION . "</li>";
echo "</ul>";

echo "<p style='color: red;'><strong>IMPORTANT:</strong> Delete this file after getting your cron command for security!</p>";
?>
