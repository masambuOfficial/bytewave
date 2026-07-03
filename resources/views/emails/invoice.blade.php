@component('mail::message')
# Invoice {{ $invoice->invoice_number }}

Dear {{ $invoice->quotation?->attn_name ?? $invoice->client->name }},

Please find attached **Invoice {{ $invoice->invoice_number }}** from **{{ config('company.name') }}**.

@component('mail::table')
| | |
|:--|--:|
| **Invoice #** | {{ $invoice->invoice_number }} |
| **Date** | {{ $invoice->date->format('d M Y') }} |
| **Due Date** | {{ $invoice->due_date->format('d M Y') }} |
@if($invoice->quotation?->subject)
| **Order** | {{ $invoice->quotation->subject }} |
@endif
| **Total Amount** | {{ $invoice->currency === 'UGX' ? 'UGX '.number_format($invoice->total_amount, 0) : 'USD '.number_format($invoice->total_amount, 2) }} |
@endcomponent

**Payment Details:**

| | |
|:--|:--|
| Account Name | {{ config('company.bank_account_name') }} |
| Account Number | {{ config('company.bank_account_number') }} |
| Bank Branch | {{ config('company.bank_branch') }} |

Please ensure payment is made by **{{ $invoice->due_date->format('d M Y') }}**.

@if($invoice->notes)
**Notes:** {{ $invoice->notes }}

@endif

If you have any questions, please do not hesitate to contact us.

Thanks & Regards,<br>
**{{ config('company.name') }}**<br>
Tel: {{ config('company.phone') }}<br>
Email: {{ config('company.email') }}
@endcomponent
