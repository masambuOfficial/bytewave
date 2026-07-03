<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Quotation #{{ $quotation->quote_number }}</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; background: #fff; }
.page { padding: 24px 28px 70px; }

.header-tbl { width: 100%; border-collapse: collapse; }
.header-tbl td { vertical-align: top; padding: 0; border: none; }
.tagline { color: #1565C0; font-style: italic; font-size: 8.5pt; margin-top: 4px; }
.company-meta { text-align: right; font-size: 8.5pt; line-height: 1.6; color: #333; }
.company-meta strong { font-size: 10.5pt; color: #1a1a1a; display: block; margin-bottom: 2px; }

.rule-top { border: none; border-top: 2.5px solid #1565C0; margin: 10px 0 4px; }
.doc-title { text-align: right; font-size: 22pt; font-weight: bold; letter-spacing: 2px; color: #1a1a1a; margin-bottom: 10px; }

.info-outer { width: 100%; border-collapse: collapse; border: 1px solid #bbb; margin-bottom: 8px; }
.info-outer td { border: 1px solid #bbb; padding: 6px 8px; vertical-align: top; font-size: 9pt; }
.client-cell { width: 42%; }
.client-label { font-weight: bold; color: #444; font-size: 8pt; text-transform: uppercase; margin-bottom: 3px; }
.ref-tbl { width: 100%; border-collapse: collapse; font-size: 8.5pt; }
.ref-tbl td { padding: 1px 3px; border: none; }
.ref-tbl td:first-child { font-weight: bold; white-space: nowrap; color: #444; }

.items-tbl { width: 100%; border-collapse: collapse; margin-top: 4px; }
.items-tbl th { background: #1565C0; color: #fff; padding: 7px 8px; font-size: 9pt; text-transform: uppercase; border: 1px solid #1565C0; }
.items-tbl td { border: 1px solid #ccc; padding: 7px 8px; font-size: 9pt; vertical-align: top; }
.items-tbl tr.subtotal-row td { background: #f0f0f0; font-weight: bold; }
.items-tbl tr.total-row td { background: #1565C0; color: #fff; font-weight: bold; font-size: 10pt; }
.items-tbl tr.words-row td { font-style: italic; background: #f8f8f8; font-size: 8.5pt; color: #333; }
.r { text-align: right; }
.c { text-align: center; }

.validity-box { border: 1px solid #1565C0; border-radius: 3px; padding: 6px 10px; font-size: 8.5pt;
                color: #1565C0; display: inline-block; margin-top: 8px; }
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
$cur   = $quotation->currency ?? 'UGX';
$fmt   = fn($n) => $cur === 'UGX' ? 'UGX '.number_format($n, 0) : 'USD '.number_format($n, 2);
$words = $numToWords((int) round($quotation->total_amount))
       . ($cur === 'UGX' ? ' Uganda Shillings' : ' US Dollars');
$logo  = public_path(config('company.logo', 'css/img/BYTEWAVE_INVESTMENTS-LOGO.png'));
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
  <div class="doc-title">QUOTATION</div>

  {{-- ── CLIENT & QUOTE INFO ──────────────────── --}}
  <table class="info-outer">
    <tr>
      <td class="client-cell">
        <div class="client-label">Client</div>
        <strong>{{ $quotation->client->name }}</strong><br>
        @if($quotation->client->address){!! nl2br(e($quotation->client->address)) !!}<br>@endif
        @if($quotation->client->phone){{ $quotation->client->phone }}<br>@endif
        @if($quotation->client->email){{ $quotation->client->email }}@endif
      </td>
      <td>
        <table class="ref-tbl">
          <tr>
            <td>Number:</td>
            <td>{{ $quotation->quote_number }}</td>
            <td style="width:12px"></td>
            <td style="font-weight:bold;color:#444">Date:</td>
            <td>{{ $quotation->date->format('d M Y') }}</td>
          </tr>
          <tr>
            <td>Valid Until:</td>
            <td colspan="4">{{ $quotation->valid_until->format('d M Y') }}</td>
          </tr>
          @if($quotation->subject)
          <tr>
            <td>Order:</td>
            <td colspan="4">{{ $quotation->subject }}</td>
          </tr>
          @endif
          <tr>
            <td>Currency:</td>
            <td colspan="4">{{ $cur }}</td>
          </tr>
        </table>
      </td>
    </tr>
    @if($quotation->attn_name)
    <tr>
      <td colspan="2" style="font-size:9pt;padding:6px 8px">
        <strong>Attn:</strong> {{ $quotation->attn_name }}
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
      @foreach($quotation->items as $i => $item)
      <tr>
        <td class="c">{{ $i + 1 }}</td>
        <td>{{ $item->description }}</td>
        <td class="c">{{ $item->quantity }}{{ $item->unit ? ' '.$item->unit : '' }}</td>
        <td class="r">{{ $fmt($item->rate) }}</td>
        <td class="r">{{ $fmt($item->line_total ?? ($item->quantity * $item->rate)) }}</td>
      </tr>
      @endforeach

      @for($p = $quotation->items->count(); $p < 4; $p++)
      <tr><td class="c">&nbsp;</td><td></td><td></td><td></td><td></td></tr>
      @endfor

      @if(($quotation->tax_rate ?? 0) > 0)
      <tr class="subtotal-row">
        <td colspan="4" class="r">Subtotal</td>
        <td class="r">{{ $fmt($quotation->subtotal) }}</td>
      </tr>
      <tr class="subtotal-row">
        <td colspan="4" class="r">Tax ({{ $quotation->tax_rate }}%)</td>
        <td class="r">{{ $fmt($quotation->tax_total) }}</td>
      </tr>
      @endif

      <tr class="total-row">
        <td colspan="4" class="r">QUOTATION TOTAL</td>
        <td class="r">{{ $fmt($quotation->total_amount) }}</td>
      </tr>
      <tr class="words-row">
        <td colspan="5">Amount in Words: <em>{{ $words }} only</em></td>
      </tr>
    </tbody>
  </table>

  @if($quotation->notes)
  <div style="margin-top:10px;font-size:8.5pt;color:#444;line-height:1.6">
    <strong>Notes:</strong> {!! nl2br(e($quotation->notes)) !!}
  </div>
  @endif

  <div class="validity-box">
    This quotation is valid until {{ $quotation->valid_until->format('d M Y') }}.
    Prices are subject to change after this date.
  </div>

  {{-- ── FOOTER ───────────────────────────────── --}}
  <div class="footer-note">
    To accept this quotation, please sign and return a copy or contact us at {{ config('company.email') }}<br>
    Thank you for your business!<br>
    <strong>{{ config('company.tagline') }}</strong>
  </div>

</div>
</body>
</html>
