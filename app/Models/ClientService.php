<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'rate',
        'unit'
    ];

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class, 'service_id');
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'service_id');
    }
}
