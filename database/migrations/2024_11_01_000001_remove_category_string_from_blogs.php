<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Remove the redundant category string column
            // We only need category_id for the relationship
            $table->dropColumn('category');
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('category')->nullable()->after('category_id');
        });
    }
};
