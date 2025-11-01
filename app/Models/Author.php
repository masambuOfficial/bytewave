<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'avatar',
        'bio',
        'twitter',
        'linkedin'
    ];

    protected static function booted()
    {
        static::creating(function ($author) {
            if (empty($author->slug)) {
                $author->slug = Str::slug($author->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getAvatarAttribute($value)
    {
        return $value ? asset($value) : asset('images/default-avatar.png');
    }
}
