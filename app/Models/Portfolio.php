<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'work_done',
        'client',
        'completion_date',
        'category',
        'technologies',
        'image_url',
        'project_url'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'technologies' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($portfolio) {
            $portfolio->slug = Str::slug($portfolio->title);
        });

        static::updating(function ($portfolio) {
            if ($portfolio->isDirty('title')) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }

    /**
     * Get the portfolio's image URL or return a default image
     */
    public function getImageUrlAttribute($value)
    {
        if ($value && file_exists(public_path('storage/' . $value))) {
            return 'storage/' . $value;
        }
        return 'images/no-image.png';
    }

    /**
     * Check if the portfolio has an image
     */
    public function hasImage()
    {
        $rawValue = $this->getRawOriginal('image_url');
        return $rawValue && $rawValue !== 'images/no-image.png';
    }
}