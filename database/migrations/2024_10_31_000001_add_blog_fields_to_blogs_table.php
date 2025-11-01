<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Add new fields
            $table->text('excerpt')->nullable()->after('content');
            $table->string('cover_image')->nullable()->after('image_url');
            $table->unsignedBigInteger('author_id')->nullable()->after('author_name');
            $table->unsignedBigInteger('category_id')->nullable()->after('category');
            $table->integer('read_time')->nullable()->after('views'); // in minutes
            $table->boolean('featured')->default(false)->after('is_published');
            $table->boolean('hero')->default(false)->after('featured');
            $table->string('source_url')->nullable()->after('hero');
            $table->string('source_name')->nullable()->after('source_url');
            $table->timestamp('published_at')->nullable()->after('is_published');
            
            // Indexes
            $table->index('author_id');
            $table->index('category_id');
            $table->index('featured');
            $table->index('hero');
            $table->index('published_at');
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['author_id']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['featured']);
            $table->dropIndex(['hero']);
            $table->dropIndex(['published_at']);
            
            $table->dropColumn([
                'excerpt', 'cover_image', 'author_id', 'category_id',
                'read_time', 'featured', 'hero', 'source_url', 'source_name', 'published_at'
            ]);
        });
    }
};
