@component('mail::message')
# Quotation {{ $quotation->quote_number }}

Dear {{ $quotation->attn_name ?? $quotation->client->name }},

Please find attached **Quotation {{ $quotation->quote_number }}** from **{{ config('company.name') }}**.

@component('mail::table')
| | |
|:--|--:|
| **Quotation #** | {{ $quotation->quote_number }} |
| **Date** | {{ $quotation->date->format('d M Y') }} |
| **Valid Until** | {{ $quotation->valid_until->format('d M Y') }} |
@if($quotation->subject)
| **Subject** | {{ $quotation->subject }} |
@endif
| **Total Amount** | {{ $quotation->currency === 'UGX' ? 'UGX '.number_format($quotation->total_amount, 0) : 'USD '.number_format($quotation->total_amount, 2) }} |
@endcomponent

To accept this quotation, please reply to this email or contact us directly.

@if($quotation->notes)
**Notes:** {{ $quotation->notes }}

@endif

This quotation is valid until **{{ $quotation->valid_until->format('d M Y') }}**.

Thanks & Regards,<br>
**{{ config('company.name') }}**<br>
Tel: {{ config('company.phone') }}<br>
Email: {{ config('company.email') }}
@endcomponent
