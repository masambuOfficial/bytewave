<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    // Model attributes
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'published_at',
        'user_id',
        'category',
        'excerpt'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    // Model relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Model accessors
    public function getStatusAttribute()
    {
        return $this->published_at && $this->published_at <= now() ? 'published' : 'draft';
    }

    // Model scopes
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    // Model boot method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = \Str::slug($post->title);
            }
        });
    }
}
