@extends('layouts.admin')

@section('title', 'Invoices')

@push('styles')
<style>
    .invoices-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .invoices-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .invoices-header p {
        color: #6B7A85;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-invoice {
        background: var(--bytewave-blue);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        white-space: nowrap;
    }

    .btn-add-invoice:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .invoices-card {
        background: #fff;
        border: 1px solid #EEF1F4;
        border-radius: 16px;
        overflow: hidden;
    }

    .invoices-table {
        width: 100%;
        margin-bottom: 0;
        min-width: 980px;
    }

    .invoices-table thead th {
        background: #FAFBFC;
        color: #8A97A0;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #EEF1F4;
        padding: 0.9rem 1.1rem;
        white-space: nowrap;
    }

    .invoices-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #F4F6F8;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #1F2A33;
    }

    .invoices-table tbody tr:last-child td {
        border-bottom: none;
    }

    .invoices-table tbody tr:hover {
        background: #FAFCFE;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pill.bg-secondary { background: #F1F4F7 !important; color: #6B7A85 !important; }
    .status-pill.bg-info { background: var(--bytewave-blue-light) !important; color: var(--bytewave-blue-dark) !important; }
    .status-pill.bg-primary { background: var(--bytewave-blue-light) !important; color: var(--bytewave-blue-dark) !important; }
    .status-pill.bg-success { background: #E9F9EF !important; color: #1E8E4F !important; }
    .status-pill.bg-danger { background: #FDEDEC !important; color: #C0392B !important; }
    .status-pill.bg-dark { background: #E7E9EC !important; color: #33393D !important; }

    .amount-cell {
        font-weight: 700;
        color: var(--bytewave-blue-dark);
    }

    .row-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        align-items: center;
    }

    .row-action-btn {
        min-width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        border: none;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0 0.6rem;
        transition: background 0.2s ease, color 0.2s ease;
        flex-shrink: 0;
        white-space: nowrap;
    }

    .row-action-btn.blue { background: var(--bytewave-blue-light); color: var(--bytewave-blue-dark); }
    .row-action-btn.blue:hover { background: var(--bytewave-blue); color: #fff; }

    .row-action-btn.green { background: #E9F9EF; color: #1E8E4F; }
    .row-action-btn.green:hover { background: #1E8E4F; color: #fff; }

    .row-action-btn.gold { background: rgba(251, 177, 69, 0.15); color: #92600C; }
    .row-action-btn.gold:hover { background: #92600C; color: #fff; }

    .row-action-btn.gray { background: #F1F4F7; color: #4B5A63; }
    .row-action-btn.gray:hover { background: #4B5A63; color: #fff; }

    .row-action-btn.red { background: #FDEDEC; color: #C0392B; }
    .row-action-btn.red:hover { background: #E74C3C; color: #fff; }

    .invoices-empty-row {
        text-align: center;
        color: #8A97A0;
        padding: 3rem 1rem !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="invoices-header">
        <div>
            <h1>Invoices</h1>
            <p>Manage invoices and export for print/PDF.</p>
        </div>
        <a href="{{ route('admin.invoices.create') }}" class="btn-add-invoice">
            <i class="fas fa-plus"></i> New Invoice
        </a>
    </div>

    <div class="invoices-card">
        <div class="table-responsive">
            <table class="invoices-table">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Due Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                    <tr>
                        <td class="fw-semibold">{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->client->name }}</td>
                        <td>{{ $invoice->date->format('Y-m-d') }}</td>
                        <td>{{ $invoice->due_date->format('Y-m-d') }}</td>
                        <td class="amount-cell">
                            @if(($invoice->currency ?? 'UGX') === 'UGX')
                                UGX {{ number_format($invoice->total_amount, 0) }}
                            @else
                                ${{ number_format($invoice->total_amount, 2) }}
                            @endif
                        </td>
                        <td>
                            <span class="status-pill bg-{{ $invoice->status_color }}">
                                {{ ucwords(str_replace('_', ' ', $invoice->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="row-actions">
                                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="row-action-btn blue" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="row-action-btn blue" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{ route('admin.invoices.print', $invoice->id) }}" class="row-action-btn gray" title="Print" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="{{ route('admin.invoices.pdf', $invoice->id) }}" class="row-action-btn gray" title="Download PDF" target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @if($invoice->client->email)
                                <button type="button"
                                        class="row-action-btn gold"
                                        title="Send Invoice to Client"
                                        data-send-modal
                                        data-title="Send Invoice {{ $invoice->invoice_number }}"
                                        data-to="{{ $invoice->client->email }}"
                                        data-action="{{ route('admin.invoices.send-email', $invoice->id) }}"
                                        data-preview="{{ route('admin.invoices.print', $invoice->id) }}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                @if($invoice->payments()->exists())
                                <button type="button"
                                        class="row-action-btn green"
                                        title="Send Receipt to Client"
                                        data-send-modal
                                        data-title="Send Receipt – Invoice {{ $invoice->invoice_number }}"
                                        data-to="{{ $invoice->client->email }}"
                                        data-action="{{ route('admin.invoices.send-receipt', $invoice->id) }}"
                                        data-preview="{{ route('admin.invoices.receipt', $invoice->id) }}">
                                    <i class="fas fa-receipt"></i>
                                </button>
                                @endif
                                @endif
                                <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="row-action-btn red" onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="invoices-empty-row">No invoices found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($invoices->hasPages())
            <div class="d-flex justify-content-center p-3 border-top">
                {{ $invoices->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
