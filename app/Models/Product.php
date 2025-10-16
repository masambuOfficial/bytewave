<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category',
        'image_url'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the product's image URL or return a default image
     */
    public function getImageUrlAttribute($value)
    {
        if ($value && file_exists(public_path('storage/' . $value))) {
            return 'storage/' . $value;
        }
        return 'images/no-image.png';
    }

    /**
     * Check if the product has an image
     */
    public function hasImage()
    {
        return $this->image_url && $this->image_url !== 'images/no-image.png';
    }
}
