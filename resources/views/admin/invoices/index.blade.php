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
        color: #546270;
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
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        overflow: hidden;
    }

    .invoices-table {
        width: 100%;
        margin-bottom: 0;
        min-width: 980px;
    }

    .invoices-table thead th {
        background: #F3F8FC;
        color: #546270;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #CDE3F1;
        padding: 0.9rem 1.1rem;
        white-space: nowrap;
    }

    .invoices-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #CDE3F1;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0B1F33;
    }

    .invoices-table tbody tr:last-child td {
        border-bottom: none;
    }

    .invoices-table tbody tr:hover {
        background: #F3F8FC;
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

    .status-pill.bg-secondary { background: #F3F8FC !important; color: #546270 !important; }
    .status-pill.bg-info { background: var(--bytewave-blue-light) !important; color: var(--bytewave-blue-dark) !important; }
    .status-pill.bg-primary { background: var(--bytewave-blue-light) !important; color: var(--bytewave-blue-dark) !important; }
    .status-pill.bg-success { background: #E3F5EA !important; color: #17703F !important; }
    .status-pill.bg-danger { background: #FDEDEC !important; color: #C0392B !important; }
    .status-pill.bg-dark { background: #E6F1F8 !important; color: #0B1F33 !important; }

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

    .row-action-btn.green { background: #E3F5EA; color: #17703F; }
    .row-action-btn.green:hover { background: #17703F; color: #fff; }


    .row-action-btn.gray { background: #F3F8FC; color: #546270; }
    .row-action-btn.gray:hover { background: #546270; color: #fff; }

    .row-action-btn.red { background: #FDEDEC; color: #C0392B; }
    .row-action-btn.red:hover { background: #C0392B; color: #fff; }

    .invoices-empty-row {
        text-align: center;
        color: #546270;
        padding: 3rem 1rem !important;
    }

    .status-tabs {
        display: flex;
        gap: 0.4rem;
        background: #F3F8FC;
        padding: 0.35rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        width: fit-content;
        flex-wrap: wrap;
    }

    .status-tab {
        padding: 0.5rem 1rem;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #546270;
        text-decoration: none;
        transition: background 0.2s ease, color 0.2s ease;
        white-space: nowrap;
    }

    .status-tab:hover {
        color: var(--bytewave-blue-dark);
    }

    .status-tab.active {
        background: #fff;
        color: var(--bytewave-blue-dark);
        box-shadow: 0 2px 6px rgba(11, 31, 51, 0.1);
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
        <x-admin.button href="{{ route('admin.invoices.create') }}">New Invoice</x-admin.button>
    </div>

    <div class="status-tabs">
        <a class="status-tab {{ $status === '' ? 'active' : '' }}" href="{{ route('admin.invoices.index') }}">
            All ({{ \App\Models\Invoice::count() }})
        </a>
        <a class="status-tab {{ $status === 'draft' ? 'active' : '' }}" href="{{ route('admin.invoices.index', ['status' => 'draft']) }}">
            Draft ({{ \App\Models\Invoice::where('status', 'draft')->count() }})
        </a>
        <a class="status-tab {{ $status === 'issued' ? 'active' : '' }}" href="{{ route('admin.invoices.index', ['status' => 'issued']) }}">
            Issued ({{ \App\Models\Invoice::where('status', 'issued')->count() }})
        </a>
        <a class="status-tab {{ $status === 'partially_paid' ? 'active' : '' }}" href="{{ route('admin.invoices.index', ['status' => 'partially_paid']) }}">
            Partially Paid ({{ \App\Models\Invoice::where('status', 'partially_paid')->count() }})
        </a>
        <a class="status-tab {{ $status === 'paid' ? 'active' : '' }}" href="{{ route('admin.invoices.index', ['status' => 'paid']) }}">
            Paid ({{ \App\Models\Invoice::where('status', 'paid')->count() }})
        </a>
        <a class="status-tab {{ $status === 'overdue' ? 'active' : '' }}" href="{{ route('admin.invoices.index', ['status' => 'overdue']) }}">
            Overdue ({{ \App\Models\Invoice::where('status', 'overdue')->count() }})
        </a>
        <a class="status-tab {{ $status === 'void' ? 'active' : '' }}" href="{{ route('admin.invoices.index', ['status' => 'void']) }}">
            Void ({{ \App\Models\Invoice::where('status', 'void')->count() }})
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
                                        class="row-action-btn blue"
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
                        <td colspan="7" class="invoices-empty-row">{{ $status !== '' ? 'No invoices match this filter.' : 'No invoices found.' }}</td>
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
