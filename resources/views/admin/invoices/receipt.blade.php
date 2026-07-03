<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Receipt – Invoice #{{ $invoice->invoice_number }}</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 9.5pt; color: #1a1a1a; background: #fff; position: relative; }
.page { padding: 24px 28px 80px; }

/* PAID watermark */
.paid-bg { position: fixed; top: 45%; left: 50%; transform: translate(-50%,-50%) rotate(-40deg);
           font-size: 80pt; font-weight: 900; color: rgba(21,101,192,0.07);
           letter-spacing: 4px; white-space: nowrap; pointer-events: none; z-index: 0; }

.header-tbl { width: 100%; border-collapse: collapse; }
.header-tbl td { vertical-align: top; padding: 0; border: none; }
.tagline { color: #1565C0; font-style: italic; font-size: 8.5pt; margin-top: 4px; }
.company-meta { text-align: right; font-size: 8.5pt; line-height: 1.6; color: #333; }
.company-meta strong { font-size: 10.5pt; color: #1a1a1a; display: block; margin-bottom: 2px; }

.rule-top { border: none; border-top: 2.5px solid #1565C0; margin: 10px 0 4px; }
.doc-title { text-align: right; font-size: 22pt; font-weight: bold; letter-spacing: 2px; color: #1a1a1a; margin-bottom: 10px; }

.info-outer { width: 100%; border-collapse: collapse; border: 1px solid #bbb; margin-bottom: 8px; }
.info-outer td { border: 1px solid #bbb; padding: 6px 8px; vertical-align: top; font-size: 9pt; }
.client-label { font-weight: bold; color: #444; font-size: 8pt; text-transform: uppercase; margin-bottom: 3px; }
.ref-tbl { width: 100%; border-collapse: collapse; font-size: 8.5pt; }
.ref-tbl td { padding: 1px 3px; border: none; }
.ref-tbl td:first-child { font-weight: bold; white-space: nowrap; color: #444; }

/* Services table */
.items-tbl { width: 100%; border-collapse: collapse; margin-top: 4px; margin-bottom: 0; }
.items-tbl th { background: #1565C0; color: #fff; padding: 7px 8px; font-size: 9pt; text-transform: uppercase; border: 1px solid #1565C0; }
.items-tbl td { border: 1px solid #ccc; padding: 7px 8px; font-size: 9pt; vertical-align: top; }
.items-tbl tr.total-row td { background: #1565C0; color: #fff; font-weight: bold; font-size: 10pt; }
.items-tbl tr.words-row td { font-style: italic; background: #f8f8f8; font-size: 8.5pt; color: #333; }
.r { text-align: right; }
.c { text-align: center; }

/* Payment record */
.pay-tbl { width: 100%; border-collapse: collapse; margin-top: 14px; }
.pay-tbl th { background: #e8f0fe; color: #1565C0; padding: 6px 8px; font-size: 8.5pt; text-transform: uppercase; border: 1px solid #c5d4f0; }
.pay-tbl td { border: 1px solid #dde; padding: 6px 8px; font-size: 9pt; }
.pay-tbl tr.pay-total td { background: #f0f0f0; font-weight: bold; }
.pay-tbl tr.pay-paid td { background: #e6f4ea; color: #2e7d32; font-weight: bold; font-size: 10pt; }
.pay-tbl tr.pay-bal td { background: #fce8e6; color: #c62828; font-weight: bold; font-size: 10pt; }

.stamp { text-align: center; margin: 14px 0 4px; }
.stamp-inner { display: inline-block; border: 3px solid #2e7d32; color: #2e7d32; font-weight: bold;
               font-size: 18pt; padding: 4px 22px; letter-spacing: 3px; }

/* Signature section */
.sig-section { width: 100%; border-collapse: collapse; margin-top: 20px; }
.sig-section td { width: 50%; vertical-align: bottom; padding: 0 10px; border: none; }
.sig-section td:first-child { padding-left: 0; padding-right: 30px; }
.sig-section td:last-child  { padding-left: 30px; padding-right: 0; }
.sig-label { font-size: 8pt; font-weight: bold; color: #444; text-transform: uppercase; margin-bottom: 28px; }
.sig-line  { border-top: 1.5px solid #333; padding-top: 4px; font-size: 8pt; color: #555; }
.sig-sub   { font-size: 7.5pt; color: #888; margin-top: 2px; }

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
.no-print button { padding: 8px 20px; background: #2e7d32; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 9pt; }
@media print { .no-print { display: none; } }
</style>
</head>
<body>

@if($invoice->status === 'paid')
<div class="paid-bg">PAID IN FULL</div>
@endif

<div class="no-print"><button onclick="window.print()">Print Receipt</button></div>

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
$cur      = $invoice->currency ?? 'UGX';
$fmt      = fn($n) => $cur === 'UGX' ? 'UGX '.number_format($n, 0) : 'USD '.number_format($n, 2);
$amtPaid  = (float) $invoice->payments->sum('amount');
$balance  = max(0, (float) $invoice->total_amount - $amtPaid);
$words    = $numToWords((int) round($amtPaid))
          . ($cur === 'UGX' ? ' Uganda Shillings' : ' US Dollars');
$lastDate = $invoice->payments->sortByDesc('paid_at')->first()?->paid_at;
$logo     = public_path(config('company.logo', 'css/img/BYTEWAVE_INVESTMENTS-LOGO.png'));
@endphp

<div class="page">

  {{-- ── HEADER ──────────────────────────────── --}}
  <table class="header-tbl">
    <tr>
      <td style="width:220px">
        <img src="{{ $logo }}" alt="{{ config('company.name') }}" style="max-width:200px;height:auto;">
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
  <div class="doc-title">RECEIPT</div>

  {{-- ── RECEIVED FROM & INVOICE REF ─────────── --}}
  <table class="info-outer">
    <tr>
      <td style="width:42%">
        <div class="client-label">Received From</div>
        <strong>{{ $invoice->client->name }}</strong><br>
        @if($invoice->client->address){!! nl2br(e($invoice->client->address)) !!}<br>@endif
        @if($invoice->client->phone){{ $invoice->client->phone }}<br>@endif
        @if($invoice->client->email){{ $invoice->client->email }}@endif
      </td>
      <td>
        <table class="ref-tbl">
          <tr>
            <td>Invoice No:</td>
            <td colspan="4">{{ $invoice->invoice_number }}</td>
          </tr>
          <tr>
            <td>Invoice Date:</td>
            <td colspan="4">{{ $invoice->date->format('d M Y') }}</td>
          </tr>
          @if($lastDate)
          <tr>
            <td>Payment Date:</td>
            <td colspan="4">{{ $lastDate->format('d M Y') }}</td>
          </tr>
          @endif
          @if($invoice->quotation?->subject)
          <tr>
            <td>Order:</td>
            <td colspan="4">{{ $invoice->quotation->subject }}</td>
          </tr>
          @endif
          <tr>
            <td>Currency:</td>
            <td colspan="4">{{ $cur }}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  {{-- ── SERVICES / LINE ITEMS ────────────────── --}}
  <table class="items-tbl">
    <thead>
      <tr>
        <th style="width:5%;text-align:center">SN</th>
        <th style="width:55%">DESCRIPTION OF SERVICES</th>
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

      @for($p = $invoice->items->count(); $p < 3; $p++)
      <tr><td class="c">&nbsp;</td><td></td><td></td><td></td><td></td></tr>
      @endfor

      <tr class="total-row">
        <td colspan="4" class="r">INVOICE TOTAL</td>
        <td class="r">{{ $fmt($invoice->total_amount) }}</td>
      </tr>
    </tbody>
  </table>

  {{-- ── PAYMENT RECORD ──────────────────────── --}}
  <table class="pay-tbl">
    <thead>
      <tr>
        <th style="width:18%">Date</th>
        <th style="width:22%">Method</th>
        <th style="width:30%">Reference / Transaction ID</th>
        <th style="width:30%;text-align:right">Amount Paid</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoice->payments->sortBy('paid_at') as $payment)
      <tr>
        <td>{{ $payment->paid_at->format('d M Y') }}</td>
        <td>{{ $payment->method }}</td>
        <td>{{ $payment->reference ?? '—' }}</td>
        <td class="r">{{ $fmt($payment->amount) }}</td>
      </tr>
      @endforeach
      <tr class="pay-paid">
        <td colspan="3" class="r">TOTAL PAID</td>
        <td class="r">{{ $fmt($amtPaid) }}</td>
      </tr>
      @if($balance > 0)
      <tr class="pay-bal">
        <td colspan="3" class="r">BALANCE REMAINING</td>
        <td class="r">{{ $fmt($balance) }}</td>
      </tr>
      @endif
    </tbody>
  </table>

  <div style="margin-top:8px;font-size:8.5pt;color:#444;font-style:italic">
    Amount in Words: <em>{{ $words }} only</em>
  </div>

  @if($balance <= 0)
  <div class="stamp"><div class="stamp-inner">&#10003; PAID IN FULL</div></div>
  @endif

  {{-- ── SIGNATURES ───────────────────────────── --}}
  <table class="sig-section">
    <tr>
      <td>
        <div class="sig-label">Prepared by (Authorized Signatory)</div>
        <div class="sig-line">{{ config('company.name') }}</div>
        <div class="sig-sub">Name &amp; Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ________________</div>
      </td>
      <td>
        <div class="sig-label">Received by (Client Acknowledgement)</div>
        <div class="sig-line">{{ $invoice->client->name }}</div>
        <div class="sig-sub">Name &amp; Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ________________</div>
      </td>
    </tr>
  </table>

  {{-- ── FOOTER ───────────────────────────────── --}}
  <div class="footer-note">
    Make all checks payable to <strong>{{ config('company.name') }}</strong> &nbsp;|&nbsp;
    @if($balance <= 0)
      This receipt confirms payment received in full. Thank you for your business!
    @else
      Partial payment receipt — outstanding balance: <strong>{{ $fmt($balance) }}</strong>. Thank you for your business!
    @endif
    &nbsp;|&nbsp; <strong>{{ config('company.tagline') }}</strong>
  </div>

</div>
</body>
</html>
