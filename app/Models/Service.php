<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'image',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->slug = Str::slug($service->name);
        });

        static::updating(function ($service) {
            if ($service->isDirty('name')) {
                $service->slug = Str::slug($service->name);
            }
        });
    }
}