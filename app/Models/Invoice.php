<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'quotation_id',
        'date',
        'due_date',
        'status',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total_amount',
        'notes',
        'payment_details'
    ];

    protected $casts = [
        'date' => 'datetime',
        'due_date' => 'datetime',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            'draft' => 'secondary',
            'sent' => 'info',
            'paid' => 'success',
            'overdue' => 'danger',
            'cancelled' => 'dark'
        ][$this->status] ?? 'secondary';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            // Calculate totals
            $invoice->subtotal = $invoice->items->sum(function ($item) {
                return $item->quantity * $item->rate;
            });
            
            $invoice->tax_amount = $invoice->subtotal * ($invoice->tax_rate / 100);
            $invoice->total_amount = $invoice->subtotal + $invoice->tax_amount;
        });

        static::updating(function ($invoice) {
            // Calculate totals
            $invoice->subtotal = $invoice->items->sum(function ($item) {
                return $item->quantity * $item->rate;
            });
            
            $invoice->tax_amount = $invoice->subtotal * ($invoice->tax_rate / 100);
            $invoice->total_amount = $invoice->subtotal + $invoice->tax_amount;
        });
    }
}
