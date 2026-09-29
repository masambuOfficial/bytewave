<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = ['products', 'services', 'portfolios'];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasColumn($table, 'meta_description')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->string('meta_description', 320)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasColumn($table, 'meta_description')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropColumn('meta_description');
                });
            }
        }
    }
};
