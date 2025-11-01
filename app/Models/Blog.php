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
        'excerpt',
        'image_url',
        'cover_image',
        'category_id',
        'author_name',
        'author_image',
        'author_id',
        'views',
        'read_time',
        'is_published',
        'featured',
        'hero',
        'source_url',
        'source_name',
        'published_at',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'featured' => 'boolean',
        'hero' => 'boolean',
        'views' => 'integer',
        'read_time' => 'integer',
        'published_at' => 'datetime',
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
     * Get the author of the blog post.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the category of the blog post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags for the blog post.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get approved comments for the blog post.
     */
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true)->whereNull('parent_id');
    }

    /**
     * Get the cover image with fallback.
     */
    public function getCoverImageAttribute($value)
    {
        if ($value) {
            return asset($value);
        }
        return $this->image_url ? asset($this->image_url) : asset('images/blog-default.jpg');
    }

    /**
     * Get the excerpt with fallback.
     */
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return Str::limit($value, 100);
        }
        return Str::limit(strip_tags($this->content), 100);
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
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to only include featured posts.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to only include hero posts.
     */
    public function scopeHero($query)
    {
        return $query->where('hero', true);
    }

    /**
     * Scope a query to order by most popular.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    /**
     * Scope a query by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query by tag.
     */
    public function scopeByTag($query, $tagId)
    {
        return $query->whereHas('tags', function($q) use ($tagId) {
            $q->where('tags.id', $tagId);
        });
    }

    /**
     * Scope a query to search posts.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }

    /**
     * Get related blog posts based on category.
     */
    public function getRelatedPosts($limit = 3)
    {
        return static::published()
            ->where('id', '!=', $this->id)
            ->where('category_id', $this->category_id)
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Calculate and set read time based on content.
     */
    public function calculateReadTime()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $this->read_time = max(1, ceil($wordCount / 200)); // 200 words per minute
        return $this->read_time;
    }
}
