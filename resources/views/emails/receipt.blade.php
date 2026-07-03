@php
    $amtPaid = (float) $invoice->payments->sum('amount');
    $balance = max(0, (float) $invoice->total_amount - $amtPaid);
    $fmt = fn($n) => $invoice->currency === 'UGX' ? 'UGX '.number_format($n, 0) : 'USD '.number_format($n, 2);
@endphp

@component('mail::message')
# Payment Receipt – Invoice {{ $invoice->invoice_number }}

Dear {{ $invoice->client->name }},

Thank you for your payment. Please find attached your **Receipt** for Invoice **{{ $invoice->invoice_number }}**.

@component('mail::table')
| | |
|:--|--:|
| **Invoice #** | {{ $invoice->invoice_number }} |
| **Invoice Date** | {{ $invoice->date->format('d M Y') }} |
| **Invoice Total** | {{ $fmt($invoice->total_amount) }} |
| **Total Paid** | {{ $fmt($amtPaid) }} |
@if($balance > 0)
| **Balance Remaining** | {{ $fmt($balance) }} |
@else
| **Status** | ✓ Paid in Full |
@endif
@endcomponent

@if($balance <= 0)
Your account is fully settled. We appreciate your prompt payment.
@else
A balance of **{{ $fmt($balance) }}** remains outstanding. Please arrange payment at your earliest convenience.
@endif

@if($invoice->quotation?->subject)
**Order Reference:** {{ $invoice->quotation->subject }}

@endif

Thank you for doing business with us!

Thanks & Regards,<br>
**{{ config('company.name') }}**<br>
Tel: {{ config('company.phone') }}<br>
Email: {{ config('company.email') }}
@endcomponent
