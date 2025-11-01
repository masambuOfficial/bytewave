<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'is_active',
        'verification_token',
        'verified_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'verified_at' => 'datetime'
    ];

    protected static function booted()
    {
        static::creating(function ($subscriber) {
            if (empty($subscriber->verification_token)) {
                $subscriber->verification_token = Str::random(32);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('verified_at');
    }
}
