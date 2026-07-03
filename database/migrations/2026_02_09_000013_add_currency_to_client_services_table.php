<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('client_services')) {
            return;
        }

        Schema::table('client_services', function (Blueprint $table) {
            if (!Schema::hasColumn('client_services', 'currency')) {
                $table->string('currency', 3)->default('UGX')->after('rate');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('client_services')) {
            return;
        }

        Schema::table('client_services', function (Blueprint $table) {
            if (Schema::hasColumn('client_services', 'currency')) {
                $table->dropColumn('currency');
            }
        });
    }
};
