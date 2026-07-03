<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice #{{ $invoice->invoice_number }}</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; background: #fff; }
.page { padding: 24px 28px 70px; }

/* ── Header ─────────────────────────── */
.header-tbl { width: 100%; border-collapse: collapse; }
.header-tbl td { vertical-align: top; padding: 0; border: none; }
.tagline { color: #1565C0; font-style: italic; font-size: 8.5pt; margin-top: 4px; }
.company-meta { text-align: right; font-size: 8.5pt; line-height: 1.6; color: #333; }
.company-meta strong { font-size: 10.5pt; color: #1a1a1a; display: block; margin-bottom: 2px; }

/* ── Rule & Title ───────────────────── */
.rule-top { border: none; border-top: 2.5px solid #1565C0; margin: 10px 0 4px; }
.doc-title { text-align: right; font-size: 22pt; font-weight: bold; letter-spacing: 2px; color: #1a1a1a; margin-bottom: 10px; }

/* ── Info block ─────────────────────── */
.info-outer { width: 100%; border-collapse: collapse; border: 1px solid #bbb; margin-bottom: 8px; }
.info-outer td { border: 1px solid #bbb; padding: 6px 8px; vertical-align: top; font-size: 9pt; }
.client-cell { width: 42%; }
.client-label { font-weight: bold; color: #444; font-size: 8pt; text-transform: uppercase; margin-bottom: 3px; }
.ref-tbl { width: 100%; border-collapse: collapse; font-size: 8.5pt; }
.ref-tbl td { padding: 1px 3px; border: none; }
.ref-tbl td:first-child { font-weight: bold; white-space: nowrap; color: #444; }
.section-full { width: 100%; font-size: 9pt; }

/* ── Items table ────────────────────── */
.items-tbl { width: 100%; border-collapse: collapse; margin-top: 4px; }
.items-tbl th { background: #1565C0; color: #fff; padding: 7px 8px; font-size: 9pt; text-transform: uppercase; border: 1px solid #1565C0; }
.items-tbl td { border: 1px solid #ccc; padding: 7px 8px; font-size: 9pt; vertical-align: top; }
.items-tbl tr.subtotal-row td { background: #f0f0f0; font-weight: bold; }
.items-tbl tr.total-row td { background: #1565C0; color: #fff; font-weight: bold; font-size: 10pt; }
.items-tbl tr.words-row td { font-style: italic; background: #f8f8f8; font-size: 8.5pt; color: #333; }
.r { text-align: right; }
.c { text-align: center; }

/* ── Footer ─────────────────────────── */
.footer-note {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    text-align: center;
    font-size: 8.5pt;
    color: #444;
    line-height: 1.7;
    background: #fff;
    border-top: 1px solid #ddd;
    padding: 6px 28px 8px;
}
.no-print { position: fixed; top: 16px; right: 16px; z-index: 99; }
.no-print button { padding: 8px 20px; background: #1565C0; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 9pt; }
@media print { .no-print { display: none; } }
</style>
</head>
<body>
<div class="no-print"><button onclick="window.print()">Print / Save PDF</button></div>

@php
/* ── amount-in-words helper ─────────── */
$numToWords = null;
$numToWords = function(int $n) use (&$numToWords): string {
    if ($n === 0) return 'Zero';
    $ones = ['','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten',
             'Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen'];
    $tens = ['','','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety'];
    if ($n < 20) return $ones[$n];
    if ($n < 100) return $tens[intdiv($n,10)] . ($n%10 ? ' '.$ones[$n%10] : '');
    if ($n < 1000) return $ones[intdiv($n,100)].' Hundred'.($n%100 ? ' '.$numToWords($n%100) : '');
    if ($n < 1000000) return $numToWords(intdiv($n,1000)).' Thousand'.($n%1000 ? ' '.$numToWords($n%1000) : '');
    if ($n < 1000000000) return $numToWords(intdiv($n,1000000)).' Million'.($n%1000000 ? ' '.$numToWords($n%1000000) : '');
    return $numToWords(intdiv($n,1000000000)).' Billion'.($n%1000000000 ? ' '.$numToWords($n%1000000000) : '');
};
$cur = $invoice->currency ?? 'UGX';
$fmt = fn($n) => $cur === 'UGX' ? 'UGX '.number_format($n, 0) : 'USD '.number_format($n, 2);
$words = $numToWords((int) round($invoice->total_amount))
       . ($cur === 'UGX' ? ' Uganda Shillings' : ' US Dollars');
$logo = public_path(config('company.logo', 'css/img/BYTEWAVE_INVESTMENTS-LOGO.png'));
@endphp

<div class="page">

  {{-- ── HEADER ──────────────────────────────── --}}
  <table class="header-tbl">
    <tr>
      <td style="width:220px">
        <img src="{{ $logo }}" alt="{{ config('company.name') }}" style="max-width:200px;height:auto;">
        <div class="tagline">{{ config('company.tagline') }}</div>
      </td>
      <td class="company-meta">
        <strong>{{ config('company.name') }}</strong>
        {{ config('company.address') }}<br>
        {{ config('company.address2') }}<br>
        {{ config('company.address3') }}<br>
        Email: {{ config('company.email') }}<br>
        Tel: {{ config('company.phone') }}
      </td>
    </tr>
  </table>

  <hr class="rule-top">
  <div class="doc-title">INVOICE</div>

  {{-- ── CLIENT & INVOICE INFO ─────────────────── --}}
  <table class="info-outer">
    <tr>
      <td class="client-cell">
        <div class="client-label">Client</div>
        <strong>{{ $invoice->client->name }}</strong><br>
        @if($invoice->client->address){!! nl2br(e($invoice->client->address)) !!}<br>@endif
        @if($invoice->client->phone){{ $invoice->client->phone }}<br>@endif
        @if($invoice->client->email){{ $invoice->client->email }}@endif
      </td>
      <td>
        <table class="ref-tbl">
          <tr>
            <td>Number:</td>
            <td>{{ $invoice->invoice_number }}</td>
            <td style="width:12px"></td>
            <td style="font-weight:bold;color:#444">Date:</td>
            <td>{{ $invoice->date->format('d M Y') }}</td>
          </tr>
          <tr>
            <td>Due Date:</td>
            <td colspan="4">{{ $invoice->due_date->format('d M Y') }}</td>
          </tr>
          @if($invoice->quotation?->subject)
          <tr>
            <td>Order:</td>
            <td colspan="4">{{ $invoice->quotation->subject }}</td>
          </tr>
          @endif
          <tr><td colspan="5" style="padding-top:6px;padding-bottom:2px"><hr style="border:none;border-top:1px solid #ddd"></td></tr>
          <tr>
            <td>Account No:</td>
            <td colspan="4">{{ config('company.bank_account_number') }}</td>
          </tr>
          <tr>
            <td>Account Name:</td>
            <td colspan="4">{{ config('company.bank_account_name') }}</td>
          </tr>
          <tr>
            <td>Bank Branch:</td>
            <td colspan="4">{{ config('company.bank_branch') }}</td>
          </tr>
          <tr>
            <td>TIN:</td>
            <td colspan="4">{{ config('company.tin') }}</td>
          </tr>
        </table>
      </td>
    </tr>
    @if($invoice->quotation?->attn_name)
    <tr>
      <td colspan="2" class="section-full">
        <strong>Attn:</strong> {{ $invoice->quotation->attn_name }}
      </td>
    </tr>
    @endif
  </table>

  {{-- ── ITEMS TABLE ───────────────────────────── --}}
  <table class="items-tbl">
    <thead>
      <tr>
        <th style="width:5%;text-align:center">SN</th>
        <th style="width:55%">DESCRIPTION</th>
        <th style="width:8%;text-align:center">QTY</th>
        <th style="width:16%;text-align:right">UNIT COST</th>
        <th style="width:16%;text-align:right">TOTAL AMOUNT</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoice->items as $i => $item)
      <tr>
        <td class="c">{{ $i + 1 }}</td>
        <td>{{ $item->description }}</td>
        <td class="c">{{ $item->quantity }}{{ $item->unit ? ' '.$item->unit : '' }}</td>
        <td class="r">{{ $fmt($item->rate) }}</td>
        <td class="r">{{ $fmt($item->line_total ?? ($item->quantity * $item->rate)) }}</td>
      </tr>
      @endforeach

      {{-- padding rows if few items --}}
      @for($p = $invoice->items->count(); $p < 4; $p++)
      <tr><td class="c">&nbsp;</td><td></td><td></td><td></td><td></td></tr>
      @endfor

      @if($invoice->tax_rate > 0)
      <tr class="subtotal-row">
        <td colspan="4" class="r">Subtotal</td>
        <td class="r">{{ $fmt($invoice->subtotal) }}</td>
      </tr>
      <tr class="subtotal-row">
        <td colspan="4" class="r">Tax ({{ $invoice->tax_rate }}%)</td>
        <td class="r">{{ $fmt($invoice->tax_amount) }}</td>
      </tr>
      @endif

      <tr class="total-row">
        <td colspan="4" class="r">INVOICE TOTAL</td>
        <td class="r">{{ $fmt($invoice->total_amount) }}</td>
      </tr>
      <tr class="words-row">
        <td colspan="5">Amount in Words: <em>{{ $words }} only</em></td>
      </tr>
    </tbody>
  </table>

  {{-- ── NOTES ────────────────────────────────── --}}
  @if($invoice->notes || $invoice->payment_details)
  <div style="margin-top:10px;font-size:8.5pt;color:#444;line-height:1.6">
    @if($invoice->payment_details)<strong>Payment Instructions:</strong> {!! nl2br(e($invoice->payment_details)) !!}<br>@endif
    @if($invoice->notes)<strong>Notes:</strong> {!! nl2br(e($invoice->notes)) !!}@endif
  </div>
  @endif

  {{-- ── FOOTER ───────────────────────────────── --}}
  <div class="footer-note">
    Make all checks payable to <strong>{{ config('company.name') }}</strong><br>
    Thank you for your business! &nbsp;|&nbsp; <strong>{{ config('company.tagline') }}</strong>
  </div>

</div>
</body>
</html>
