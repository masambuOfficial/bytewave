<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioMedia extends Model
{
    use HasFactory;

    protected $table = 'portfolio_media';

    protected $fillable = [
        'portfolio_id',
        'media_type',
        'media_path',
        'media_embed',
        'sort_order',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
