<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remap old ENUM values to the canonical values the app uses
        DB::statement("UPDATE invoices SET status = 'issued' WHERE status = 'sent'");
        DB::statement("UPDATE invoices SET status = 'void'   WHERE status = 'cancelled'");

        // Replace the old narrow ENUM with a plain VARCHAR(20)
        DB::statement("ALTER TABLE invoices MODIFY COLUMN status VARCHAR(20) NOT NULL DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("UPDATE invoices SET status = 'sent'      WHERE status = 'issued'");
        DB::statement("UPDATE invoices SET status = 'cancelled' WHERE status IN ('void', 'partially_paid')");

        DB::statement("ALTER TABLE invoices MODIFY COLUMN status ENUM('draft','sent','paid','overdue','cancelled') NOT NULL DEFAULT 'draft'");
    }
};
