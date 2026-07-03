<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('client_services') && Schema::hasColumn('client_services', 'unit')) {
            DB::statement('ALTER TABLE `client_services` MODIFY `unit` VARCHAR(50) NULL');
        }
    }

    public function down(): void
    {
        // no-op
    }
};
