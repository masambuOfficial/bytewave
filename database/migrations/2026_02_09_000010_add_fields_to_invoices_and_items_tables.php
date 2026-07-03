<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('invoices')) {
            Schema::table('invoices', function (Blueprint $table) {
                if (!Schema::hasColumn('invoices', 'work_order_id')) {
                    $table->unsignedBigInteger('work_order_id')->nullable()->after('quotation_id');
                }

                if (!Schema::hasColumn('invoices', 'currency')) {
                    $table->string('currency', 3)->default('UGX')->after('status');
                }

                if (!Schema::hasColumn('invoices', 'issued_at')) {
                    $table->timestamp('issued_at')->nullable()->after('payment_details');
                }

                if (!Schema::hasColumn('invoices', 'issued_by_user_id')) {
                    $table->unsignedBigInteger('issued_by_user_id')->nullable()->after('issued_at');
                }
            });
        }

        if (Schema::hasTable('invoice_items')) {
            Schema::table('invoice_items', function (Blueprint $table) {
                if (!Schema::hasColumn('invoice_items', 'position')) {
                    $table->unsignedInteger('position')->default(0)->after('invoice_id');
                }

                if (!Schema::hasColumn('invoice_items', 'description')) {
                    $table->longText('description')->nullable()->after('position');
                }

                if (!Schema::hasColumn('invoice_items', 'unit')) {
                    $table->string('unit')->nullable()->after('quantity');
                }

                if (!Schema::hasColumn('invoice_items', 'line_total')) {
                    $table->decimal('line_total', 15, 2)->default(0)->after('rate');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('invoices')) {
            Schema::table('invoices', function (Blueprint $table) {
                $columns = ['work_order_id', 'currency', 'issued_at', 'issued_by_user_id'];

                foreach ($columns as $column) {
                    if (Schema::hasColumn('invoices', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('invoice_items')) {
            Schema::table('invoice_items', function (Blueprint $table) {
                $columns = ['position', 'description', 'unit', 'line_total'];

                foreach ($columns as $column) {
                    if (Schema::hasColumn('invoice_items', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
