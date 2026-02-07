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
        'currency',
        'billing_cycle',
        'stock',
        'category',
        'image_url'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    public function getFormattedPriceAttribute(): string
    {
        $currency = strtoupper((string) ($this->currency ?? 'USD'));
        $amount = (float) $this->price;

        if ($currency === 'UGX') {
            return 'UGX ' . number_format($amount, 0);
        }

        return '$' . number_format($amount, 2);
    }

    public function getBillingCycleLabelAttribute(): string
    {
        $cycle = (string) ($this->billing_cycle ?? 'one_time');

        return match ($cycle) {
            'monthly' => 'Monthly',
            'annual' => 'Annual',
            default => 'One-time',
        };
    }

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
