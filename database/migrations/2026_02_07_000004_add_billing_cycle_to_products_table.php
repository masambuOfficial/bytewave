<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'billing_cycle')) {
                $table->string('billing_cycle', 20)->default('one_time')->after('currency');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'billing_cycle')) {
                $table->dropColumn('billing_cycle');
            }
        });
    }
};
