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
        'primary_media_type',
        'primary_media_path',
        'primary_media_embed',
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

    public function media()
    {
        return $this->hasMany(PortfolioMedia::class)->orderBy('sort_order')->orderBy('id');
    }

    public function getPrimaryMediaType(): string
    {
        $type = (string) ($this->getRawOriginal('primary_media_type') ?? '');
        if ($type !== '') {
            return $type;
        }

        return $this->hasImage() ? 'image' : 'image';
    }

    public function getPrimaryMediaPath(): ?string
    {
        $path = $this->getRawOriginal('primary_media_path');
        if ($path) {
            return $path;
        }

        $legacy = $this->getRawOriginal('image_url');
        return $legacy ?: null;
    }

    public function getPrimaryMediaEmbed(): ?string
    {
        $raw = $this->getRawOriginal('primary_media_embed');
        return $raw ?: null;
    }

    public function primaryMediaPublicUrl(): ?string
    {
        $path = $this->getPrimaryMediaPath();
        if (!$path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public function primaryEmbedSrc(): ?string
    {
        $raw = $this->getPrimaryMediaEmbed();
        return static::embedSrcFromRaw($raw);
    }

    public function primaryEmbedThumbnailUrl(): ?string
    {
        $src = $this->primaryEmbedSrc();
        return static::thumbnailFromEmbedSrc($src);
    }

    public static function embedSrcFromRaw(?string $raw): ?string
    {
        if (!$raw) {
            return null;
        }

        $value = trim($raw);

        if (Str::startsWith($value, ['http://', 'https://'])) {
            $src = static::normalizeEmbedUrl($value);
            return $src;
        }

        if (preg_match('/<iframe[^>]*src=["\']([^"\']+)["\'][^>]*>/i', $value, $m)) {
            $candidate = $m[1] ?? null;
            return $candidate ? static::normalizeEmbedUrl($candidate) : null;
        }

        return null;
    }

    public static function normalizeEmbedUrl(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') {
            return null;
        }

        $parts = parse_url($url);
        if (!$parts || empty($parts['host'])) {
            return $url;
        }

        $host = strtolower($parts['host']);
        $path = $parts['path'] ?? '';
        $query = [];
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
        }

        // YouTube
        if (Str::contains($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'])) {
            if (Str::contains($path, '/embed/')) {
                return $url;
            }

            if ($path === '/watch' && !empty($query['v'])) {
                return 'https://www.youtube.com/embed/' . $query['v'];
            }

            if (preg_match('#^/shorts/([^/?]+)#', $path, $m)) {
                return 'https://www.youtube.com/embed/' . $m[1];
            }

            if (preg_match('#^/live/([^/?]+)#', $path, $m)) {
                return 'https://www.youtube.com/embed/' . $m[1];
            }

            return $url;
        }

        if ($host === 'youtu.be') {
            $id = ltrim($path, '/');
            if ($id !== '') {
                return 'https://www.youtube.com/embed/' . $id;
            }
            return $url;
        }

        // Vimeo
        if (Str::contains($host, ['vimeo.com', 'www.vimeo.com'])) {
            if (preg_match('#^/([0-9]+)#', $path, $m)) {
                return 'https://player.vimeo.com/video/' . $m[1];
            }
            return $url;
        }

        if (Str::contains($host, ['player.vimeo.com'])) {
            return $url;
        }

        return $url;
    }

    public static function thumbnailFromEmbedSrc(?string $src): ?string
    {
        if (!$src) {
            return null;
        }

        $parts = parse_url($src);
        if (!$parts || empty($parts['host'])) {
            return null;
        }

        $host = strtolower($parts['host']);
        $path = $parts['path'] ?? '';

        // YouTube embed: https://www.youtube.com/embed/{id}
        if (Str::contains($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'])) {
            if (preg_match('#^/embed/([^/?]+)#', $path, $m)) {
                $id = $m[1] ?? null;
                if ($id) {
                    return 'https://i.ytimg.com/vi/' . $id . '/hqdefault.jpg';
                }
            }
        }

        return null;
    }
}