<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation #{{ $quotation->quote_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-logo {
            max-width: 200px;
            height: auto;
        }
        .quotation-info {
            margin-bottom: 30px;
        }
        .quotation-info table {
            width: 100%;
        }
        .quotation-info td {
            padding: 5px;
            vertical-align: top;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .items-table th {
            background-color: #f8f9fa;
        }
        .total-section {
            float: right;
            width: 300px;
        }
        .total-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .total-table td {
            padding: 5px;
        }
        .total-table .total-row {
            font-weight: bold;
            font-size: 1.1em;
        }
        .notes {
            clear: both;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
        @media print {
            body {
                padding: 0;
                margin: 20px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            <i class="fas fa-print"></i> Print
        </button>
    </div>

    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="company-logo">
        <h1>QUOTATION</h1>
    </div>

    <div class="quotation-info">
        <table>
            <tr>
                <td width="50%">
                    <strong>From:</strong><br>
                    {{ config('app.name') }}<br>
                    {{ config('company.address') }}<br>
                    {{ config('company.phone') }}<br>
                    {{ config('company.email') }}
                </td>
                <td width="50%" style="text-align: right;">
                    <strong>To:</strong><br>
                    {{ $quotation->client->name }}<br>
                    {{ $quotation->client->address }}<br>
                    {{ $quotation->client->phone }}<br>
                    {{ $quotation->client->email }}
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <strong>Quotation #:</strong> {{ $quotation->quote_number }}<br>
                    <strong>Date:</strong> {{ $quotation->date->format('M d, Y') }}<br>
                    <strong>Valid Until:</strong> {{ $quotation->valid_until->format('M d, Y') }}
                </td>
                <td style="text-align: right;">
                    <strong>Status:</strong> 
                    <span style="padding: 5px 10px; background-color: {{ $quotation->status_color }}; color: white; border-radius: 4px;">
                        {{ ucfirst($quotation->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th width="40%">Service</th>
                <th width="15%">Unit</th>
                <th width="15%">Quantity</th>
                <th width="15%">Rate</th>
                <th width="15%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotation->items as $item)
            <tr>
                <td>{{ $item->service->name }}</td>
                <td>{{ ucfirst($item->service->unit) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->rate, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->rate, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <table class="total-table">
            <tr>
                <td>Subtotal:</td>
                <td style="text-align: right">${{ number_format($quotation->subtotal, 2) }}</td>
            </tr>
            @if($quotation->tax_rate > 0)
            <tr>
                <td>Tax ({{ $quotation->tax_rate }}%):</td>
                <td style="text-align: right">${{ number_format($quotation->tax_amount, 2) }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td>Total:</td>
                <td style="text-align: right">${{ number_format($quotation->total_amount, 2) }}</td>
            </tr>
        </table>
    </div>

    @if($quotation->notes)
    <div class="notes">
        <h3>Notes</h3>
        <p>{{ $quotation->notes }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This quotation is valid until {{ $quotation->valid_until->format('M d, Y') }}</p>
        <p>{{ config('company.name') }} | {{ config('company.address') }} | {{ config('company.phone') }}</p>
    </div>
</body>
</html>
