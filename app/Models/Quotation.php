<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_number',
        'client_id',
        'date',
        'valid_until',
        'status',
        'notes',
        'total_amount'
    ];

    protected $casts = [
        'date' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            'draft' => 'secondary',
            'sent' => 'info',
            'accepted' => 'success',
            'rejected' => 'danger'
        ][$this->status] ?? 'secondary';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            // Calculate total amount from items
            $quotation->total_amount = $quotation->items->sum(function ($item) {
                return $item->quantity * $item->rate;
            });
        });

        static::updating(function ($quotation) {
            // Calculate total amount from items
            $quotation->total_amount = $quotation->items->sum(function ($item) {
                return $item->quantity * $item->rate;
            });
        });
    }
}
