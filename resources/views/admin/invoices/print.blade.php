<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @page {
            margin: 2.5cm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 1rem;
        }
        .company-info {
            margin-bottom: 2rem;
        }
        .invoice-info {
            margin-bottom: 2rem;
        }
        .client-info {
            margin-bottom: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        th, td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .totals {
            width: 300px;
            margin-left: auto;
            margin-bottom: 2rem;
        }
        .totals table {
            margin-bottom: 0;
        }
        .notes {
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .payment-info {
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f0f8ff;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #ddd;
            font-size: 0.9rem;
        }
        .status-paid {
            position: relative;
        }
        .status-paid::after {
            content: 'PAID';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 6rem;
            color: rgba(0, 128, 0, 0.2);
            border: 1rem solid rgba(0, 128, 0, 0.2);
            padding: 1rem;
            border-radius: 1rem;
            pointer-events: none;
            z-index: 1;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="{{ $invoice->status === 'paid' ? 'status-paid' : '' }}">
    <div class="no-print" style="position: fixed; top: 20px; right: 20px;">
        <button onclick="window.print()">Print Invoice</button>
    </div>

    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="ByteWave IT Solutions" class="logo">
        <h1>INVOICE</h1>
    </div>

    <div class="company-info">
        <strong>ByteWave IT Solutions</strong><br>
        {{ config('company.address') }}<br>
        Phone: {{ config('company.phone') }}<br>
        Email: {{ config('company.email') }}<br>
        Website: {{ config('company.website') }}
    </div>

    <div class="invoice-info">
        <table>
            <tr>
                <td><strong>Invoice #:</strong></td>
                <td>{{ $invoice->invoice_number }}</td>
                <td><strong>Date:</strong></td>
                <td>{{ $invoice->date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Due Date:</strong></td>
                <td>{{ $invoice->due_date->format('d/m/Y') }}</td>
                <td><strong>Status:</strong></td>
                <td>{{ ucfirst($invoice->status) }}</td>
            </tr>
            @if($invoice->quotation_id)
            <tr>
                <td><strong>Quote Reference:</strong></td>
                <td colspan="3">{{ $invoice->quotation->quote_number }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="client-info">
        <h3>Bill To</h3>
        <strong>{{ $invoice->client->name }}</strong><br>
        {!! nl2br(e($invoice->client->address)) !!}<br>
        Phone: {{ $invoice->client->phone }}<br>
        Email: {{ $invoice->client->email }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Service</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->service->name }}</td>
                <td>{{ $item->service->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->rate, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->rate, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td>${{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            @if($invoice->tax_rate > 0)
            <tr>
                <td><strong>Tax ({{ $invoice->tax_rate }}%):</strong></td>
                <td>${{ number_format($invoice->tax_amount, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Total Amount:</strong></td>
                <td>${{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </table>
    </div>

    @if($invoice->payment_details)
    <div class="payment-info">
        <h3>Payment Information</h3>
        {!! nl2br(e($invoice->payment_details)) !!}
    </div>
    @endif

    @if($invoice->notes)
    <div class="notes">
        <h3>Notes</h3>
        {!! nl2br(e($invoice->notes)) !!}
    </div>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This is a computer-generated document and requires no signature.</p>
    </div>
</body>
</html>
