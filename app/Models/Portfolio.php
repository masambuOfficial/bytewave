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
        'meta_description',
        'work_done',
        'client',
        'completion_date',
        'category',
        'technologies',
        'image_url',
        'primary_media_type',
        'primary_media_path',
        'primary_media_embed',
        'project_url',
        'project_type',
        'challenge',
        'solution',
        'results',
        'highlights',
        'process_steps',
        'testimonial',
        'testimonial_author',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'technologies' => 'array',
        'highlights' => 'array',
        'process_steps' => 'array',
    ];

    public const TYPES = [
        'ict' => 'ICT (websites, systems, apps)',
        'multimedia' => 'Multimedia (events, video, design)',
    ];

    public function isMultimedia(): bool
    {
        return $this->project_type === 'multimedia';
    }

    /**
     * A project counts as a full case study once it tells the problem and the fix.
     */
    public function isCaseStudy(): bool
    {
        return filled($this->challenge) && filled($this->solution);
    }

    /**
     * Split free text into paragraphs and numbered/bulleted lists so
     * pasted content keeps its structure on the public page.
     *
     * @return array<int, array{type: string, items: array<int, string>}>
     */
    public static function textBlocks(?string $text): array
    {
        $blocks = [];

        foreach (preg_split('/\R/', (string) $text) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            if (preg_match('/^\d+[.)]\s+(.+)$/', $line, $m)) {
                $type = 'ol';
                $line = $m[1];
            } elseif (preg_match('/^(?:[-•*]\s+|[➢▪●]\s*)(.+)$/u', $line, $m)) {
                $type = 'ul';
                $line = $m[1];
            } else {
                $type = 'p';
            }

            $last = count($blocks) - 1;
            if ($type !== 'p' && $last >= 0 && $blocks[$last]['type'] === $type) {
                $blocks[$last]['items'][] = $line;
            } else {
                $blocks[] = ['type' => $type, 'items' => [$line]];
            }
        }

        return $blocks;
    }

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