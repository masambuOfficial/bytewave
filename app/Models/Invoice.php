<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'client_id',
        'quotation_id',
        'work_order_id',
        'date',
        'due_date',
        'status',
        'currency',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total_amount',
        'notes',
        'payment_details',
        'issued_at',
        'issued_by_user_id'
    ];

    protected $casts = [
        'date' => 'date',
        'due_date' => 'date',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'issued_at' => 'datetime',
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

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getAmountPaidAttribute(): float
    {
        return (float) ($this->payments()->sum('amount') ?? 0);
    }

    public function getBalanceDueAttribute(): float
    {
        return max(0, (float) $this->total_amount - (float) $this->amount_paid);
    }

    public function getStatusColorAttribute()
    {
        return [
            'draft' => 'secondary',
            'issued' => 'info',
            'partially_paid' => 'primary',
            'paid' => 'success',
            'overdue' => 'danger',
            'void' => 'dark'
        ][$this->status] ?? 'secondary';
    }

    public function syncStatusFromPayments(): void
    {
        if ($this->status === 'void') {
            return;
        }

        $paid  = (float) $this->payments()->sum('amount');
        $total = (float) $this->total_amount;

        if ($paid <= 0) {
            if (in_array($this->status, ['paid', 'partially_paid'])) {
                $this->status = 'issued';
                $this->save();
            }
            return;
        }

        $newStatus = $paid >= $total ? 'paid' : 'partially_paid';

        if ($this->status !== $newStatus) {
            $this->status = $newStatus;
            $this->save();
        }
    }
}
