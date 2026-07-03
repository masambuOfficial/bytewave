<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('quotation_items') && Schema::hasColumn('quotation_items', 'service_id')) {
            DB::statement('ALTER TABLE `quotation_items` MODIFY `service_id` BIGINT UNSIGNED NULL');
        }

        if (Schema::hasTable('invoice_items') && Schema::hasColumn('invoice_items', 'service_id')) {
            DB::statement('ALTER TABLE `invoice_items` MODIFY `service_id` BIGINT UNSIGNED NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('quotation_items') && Schema::hasColumn('quotation_items', 'service_id')) {
            DB::statement('ALTER TABLE `quotation_items` MODIFY `service_id` BIGINT UNSIGNED NOT NULL');
        }

        if (Schema::hasTable('invoice_items') && Schema::hasColumn('invoice_items', 'service_id')) {
            DB::statement('ALTER TABLE `invoice_items` MODIFY `service_id` BIGINT UNSIGNED NOT NULL');
        }
    }
};
