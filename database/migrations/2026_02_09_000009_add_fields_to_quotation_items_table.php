<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('quotation_items')) {
            return;
        }

        Schema::table('quotation_items', function (Blueprint $table) {
            if (!Schema::hasColumn('quotation_items', 'position')) {
                $table->unsignedInteger('position')->default(0)->after('quotation_id');
            }

            if (!Schema::hasColumn('quotation_items', 'description')) {
                $table->longText('description')->nullable()->after('position');
            }

            if (!Schema::hasColumn('quotation_items', 'unit')) {
                $table->string('unit')->nullable()->after('quantity');
            }

            if (!Schema::hasColumn('quotation_items', 'line_total')) {
                $table->decimal('line_total', 15, 2)->default(0)->after('rate');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('quotation_items')) {
            return;
        }

        Schema::table('quotation_items', function (Blueprint $table) {
            $columns = ['position', 'description', 'unit', 'line_total'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('quotation_items', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
