<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained('portfolios')->cascadeOnDelete();
            $table->string('media_type', 20); // image|video|embed
            $table->string('media_path')->nullable();
            $table->text('media_embed')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_media');
    }
};
