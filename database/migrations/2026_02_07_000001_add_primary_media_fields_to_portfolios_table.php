<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'primary_media_type')) {
                $table->string('primary_media_type', 20)->nullable()->after('image_url');
            }
            if (!Schema::hasColumn('portfolios', 'primary_media_path')) {
                $table->string('primary_media_path')->nullable()->after('primary_media_type');
            }
            if (!Schema::hasColumn('portfolios', 'primary_media_embed')) {
                $table->text('primary_media_embed')->nullable()->after('primary_media_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (Schema::hasColumn('portfolios', 'primary_media_embed')) {
                $table->dropColumn('primary_media_embed');
            }
            if (Schema::hasColumn('portfolios', 'primary_media_path')) {
                $table->dropColumn('primary_media_path');
            }
            if (Schema::hasColumn('portfolios', 'primary_media_type')) {
                $table->dropColumn('primary_media_type');
            }
        });
    }
};
