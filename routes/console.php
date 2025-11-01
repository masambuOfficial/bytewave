<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Helper function to convert MySQL CREATE TABLE to SQLite
if (!function_exists('convertMySQLToSQLite')) {
    function convertMySQLToSQLite($mysqlSQL, $tableName) {
        // Remove backticks
        $sqliteSQL = str_replace('`', '', $mysqlSQL);
        
        // Remove MySQL-specific syntax
        $sqliteSQL = preg_replace('/ENGINE=\w+/', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/DEFAULT CHARSET=\w+/', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/COLLATE[\s=]+[\w_]+/', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/CHARACTER SET[\s=]+[\w_]+/', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/AUTO_INCREMENT=\d+/', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/COMMENT=\'[^\']*\'/', '', $sqliteSQL);
        
        // Convert ENUM to TEXT
        $sqliteSQL = preg_replace('/enum\([^)]+\)/i', 'TEXT', $sqliteSQL);
        
        // Convert date/time types
        $sqliteSQL = preg_replace('/\bdate\b/i', 'TEXT', $sqliteSQL);
        $sqliteSQL = preg_replace('/\bdatetime\b/i', 'TEXT', $sqliteSQL);
        $sqliteSQL = preg_replace('/\btimestamp\b/i', 'TEXT', $sqliteSQL);
        
        // Convert numeric types
        $sqliteSQL = preg_replace('/bigint\(\d+\)\s+unsigned/i', 'INTEGER', $sqliteSQL);
        $sqliteSQL = preg_replace('/int\(\d+\)\s+unsigned/i', 'INTEGER', $sqliteSQL);
        $sqliteSQL = preg_replace('/bigint\(\d+\)/i', 'INTEGER', $sqliteSQL);
        $sqliteSQL = preg_replace('/int\(\d+\)/i', 'INTEGER', $sqliteSQL);
        $sqliteSQL = preg_replace('/tinyint\(\d+\)/i', 'INTEGER', $sqliteSQL);
        $sqliteSQL = preg_replace('/smallint\(\d+\)/i', 'INTEGER', $sqliteSQL);
        
        // Convert string types
        $sqliteSQL = preg_replace('/varchar\(\d+\)/i', 'TEXT', $sqliteSQL);
        $sqliteSQL = preg_replace('/\btext\b/i', 'TEXT', $sqliteSQL);
        $sqliteSQL = preg_replace('/longtext/i', 'TEXT', $sqliteSQL);
        $sqliteSQL = preg_replace('/mediumtext/i', 'TEXT', $sqliteSQL);
        
        // Convert decimal types
        $sqliteSQL = preg_replace('/decimal\([^)]+\)/i', 'REAL', $sqliteSQL);
        $sqliteSQL = preg_replace('/\bdouble\b/i', 'REAL', $sqliteSQL);
        $sqliteSQL = preg_replace('/\bfloat\b/i', 'REAL', $sqliteSQL);
        
        // Fix AUTOINCREMENT - must be part of PRIMARY KEY definition
        $sqliteSQL = preg_replace('/\s+NOT NULL AUTO_INCREMENT,/i', ' PRIMARY KEY AUTOINCREMENT,', $sqliteSQL);
        $sqliteSQL = preg_replace('/\s+AUTO_INCREMENT,/i', ' PRIMARY KEY AUTOINCREMENT,', $sqliteSQL);
        
        // Remove separate PRIMARY KEY definition if AUTOINCREMENT was added
        if (preg_match('/PRIMARY KEY AUTOINCREMENT/i', $sqliteSQL)) {
            $sqliteSQL = preg_replace('/,\s*PRIMARY KEY\s*\([^)]+\)/i', '', $sqliteSQL);
        }
        
        // Remove KEY definitions (SQLite handles indexes differently)
        $sqliteSQL = preg_replace('/,\s*KEY\s+[\w_]+\s*\([^)]+\)/i', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/,\s*UNIQUE KEY\s+[\w_]+\s*\([^)]+\)/i', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/,\s*FULLTEXT KEY\s+[\w_]+\s*\([^)]+\)/i', '', $sqliteSQL);
        
        // Remove CHECK constraints from JSON columns first (they leave orphaned parentheses)
        $sqliteSQL = preg_replace('/CHECK\s*\([^)]+\)/i', '', $sqliteSQL);
        
        // Remove CONSTRAINT definitions and foreign key references
        $sqliteSQL = preg_replace('/,\s*CONSTRAINT\s+[\w_]+\s+FOREIGN KEY[^)]+\)[^)]*\)/i', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/\)\s*REFERENCES\s+[\w_]+\s*\([^)]+\)[^,)]*(?=,|\))/i', '', $sqliteSQL);
        
        // Remove orphaned ON DELETE/UPDATE clauses (can appear anywhere)
        $sqliteSQL = preg_replace('/\s+ON\s+DELETE\s+[\w\s]+/i', '', $sqliteSQL);
        $sqliteSQL = preg_replace('/\s+ON\s+UPDATE\s+[\w\s]+/i', '', $sqliteSQL);
        
        // Remove orphaned closing parentheses from CHECK constraints
        $sqliteSQL = preg_replace('/\s*\)\s*,/i', ',', $sqliteSQL);
        
        // Fix current_timestamp functions - remove parentheses
        $sqliteSQL = preg_replace('/current_timestamp\s*\(\s*\)/i', 'CURRENT_TIMESTAMP', $sqliteSQL);
        $sqliteSQL = preg_replace('/current_TEXT\s*\(\s*\)/i', 'CURRENT_TIMESTAMP', $sqliteSQL);
        
        // Clean up multiple commas and spaces
        $sqliteSQL = preg_replace('/,\s*,+/', ',', $sqliteSQL);
        $sqliteSQL = preg_replace('/,\s*\)/', ')', $sqliteSQL);
        $sqliteSQL = preg_replace('/\(\s*,/', '(', $sqliteSQL);
        $sqliteSQL = preg_replace('/\s+/', ' ', $sqliteSQL);
        
        return $sqliteSQL;
    }
}

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule: Fetch news articles automatically
use Illuminate\Console\Scheduling\Schedule;

app(Schedule::class)->command('news:fetch --limit=10')->everySixHours();

Artisan::command('db:sync-production', function () {
    /** @var ClosureCommand $this */
    $this->info('Starting production database sync...');
    
    try {
        // Test production connection
        $this->info('Testing production database connection...');
        DB::connection('production')->getPdo();
        $this->info('✓ Production database connected successfully');
        
        // Get all tables from production
        $tables = DB::connection('production')
            ->select('SHOW TABLES');
        
        $databaseName = config('database.connections.production.database');
        $tableKey = "Tables_in_{$databaseName}";
        
        $this->info('Found ' . count($tables) . ' tables to sync');
        
        // Disable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = OFF');
        
        $bar = $this->output->createProgressBar(count($tables));
        $bar->start();
        
        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            
            // Skip migrations table
            if ($tableName === 'migrations') {
                $bar->advance();
                continue;
            }
            
            $this->newLine();
            $this->info("Syncing table: {$tableName}");
            
            // Get data from production
            $data = DB::connection('production')
                ->table($tableName)
                ->get()
                ->toArray();
            
            // Check if table exists locally
            if (!Schema::hasTable($tableName)) {
                $this->warn("  ⚠ Skipping {$tableName}: Table does not exist locally (run migrations first)");
                $bar->advance();
                continue;
            }
            
            if (count($data) > 0) {
                // Clear local table
                DB::table($tableName)->truncate();
                
                // Insert data in chunks to avoid memory issues
                $chunks = array_chunk($data, 500);
                foreach ($chunks as $chunk) {
                    $insertData = array_map(function($item) {
                        return (array) $item;
                    }, $chunk);
                    
                    DB::table($tableName)->insert($insertData);
                }
                
                $this->info("  ✓ Synced {$tableName}: " . count($data) . " records");
            } else {
                $this->info("  - {$tableName}: No records to sync");
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine(2);
        
        // Re-enable foreign key checks
        DB::statement('PRAGMA foreign_keys = ON');
        
        $this->info('✓ Database sync completed successfully!');
        
    } catch (\Exception $e) {
        $this->error('Error syncing database: ' . $e->getMessage());
        $this->error('Stack trace: ' . $e->getTraceAsString());
        return 1;
    }
    
    return 0;
})->purpose('Sync production MySQL database to local SQLite database');

Artisan::command('db:clone-schema', function () {
    /** @var ClosureCommand $this */
    $this->info('Cloning production database schema...');
    
    try {
        // Test production connection
        $this->info('Testing production database connection...');
        DB::connection('production')->getPdo();
        $this->info('✓ Production database connected successfully');
        
        // Get all tables from production
        $tables = DB::connection('production')->select('SHOW TABLES');
        $databaseName = config('database.connections.production.database');
        $tableKey = "Tables_in_{$databaseName}";
        
        $this->info('Found ' . count($tables) . ' tables to clone');
        
        // Disable foreign key checks
        DB::statement('PRAGMA foreign_keys = OFF');
        
        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            
            // Skip migrations table
            if ($tableName === 'migrations') {
                continue;
            }
            
            $this->info("Creating table: {$tableName}");
            
            // Drop table if exists
            Schema::dropIfExists($tableName);
            
            // Get CREATE TABLE statement from production
            $createTableResult = DB::connection('production')
                ->select("SHOW CREATE TABLE `{$tableName}`");
            
            if (empty($createTableResult)) {
                $this->warn("  ⚠ Could not get CREATE statement for {$tableName}");
                continue;
            }
            
            $createTableSQL = $createTableResult[0]->{'Create Table'};
            
            // Convert MySQL syntax to SQLite-compatible syntax
            $sqliteSQL = convertMySQLToSQLite($createTableSQL, $tableName);
            
            try {
                DB::statement($sqliteSQL);
                $this->info("  ✓ Created {$tableName}");
            } catch (\Exception $e) {
                $this->error("  ✗ Failed to create {$tableName}: " . $e->getMessage());
            }
        }
        
        // Re-enable foreign key checks
        DB::statement('PRAGMA foreign_keys = ON');
        
        $this->newLine();
        $this->info('✓ Schema cloning completed!');
        $this->info('Now run: php artisan db:sync-production');
        
    } catch (\Exception $e) {
        $this->error('Error cloning schema: ' . $e->getMessage());
        return 1;
    }
    
    return 0;
})->purpose('Clone production database schema to local SQLite');
