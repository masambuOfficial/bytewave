<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_url',
        'category',
        'author_name',
        'author_image',
        'views',
        'is_published',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the URL for the blog post's image.
     */
    public function getImageUrlAttribute($value)
    {
        return $value ?? 'css/img/blog-default.jpg';
    }

    /**
     * Increment the view count for this blog post.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Scope a query to only include published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to order by latest first.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get related blog posts based on category.
     */
    public function getRelatedPosts($limit = 3)
    {
        return static::published()
            ->where('id', '!=', $this->id)
            ->where('category', $this->category)
            ->latest()
            ->take($limit)
            ->get();
    }
}
