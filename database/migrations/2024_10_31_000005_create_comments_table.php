<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable(); // For guest comments
            $table->string('email')->nullable(); // For guest comments
            $table->text('body');
            $table->boolean('is_approved')->default(false);
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // For replies
            $table->timestamps();
            
            $table->index('blog_id');
            $table->index('is_approved');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
