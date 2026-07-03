@extends('layouts.admin')

@push('styles')
<style>
    .bw-card {
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 12px;
    }
    .bw-card-header {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }
    .bw-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }
    .bw-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    .bw-table {
        min-width: 980px;
    }
    .bw-table thead th {
        font-size: 0.8rem;
        letter-spacing: 0.02em;
        color: #6c757d;
        text-transform: uppercase;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        padding: 0.85rem 0.9rem;
        white-space: nowrap;
    }
    .bw-table tbody td {
        padding: 0.85rem 0.9rem;
        vertical-align: middle;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="bw-title">Invoices</h1>
            <div class="bw-subtitle">Manage invoices and export for print/PDF.</div>
        </div>
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Invoice
        </a>
    </div>

    <div class="card shadow-sm bw-card">
        <div class="card-header bw-card-header py-3">
            <div class="fw-semibold">All Invoices</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 bw-table">
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
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->date->format('Y-m-d') }}</td>
                                <td>{{ $invoice->due_date->format('Y-m-d') }}</td>
                                <td>
                                    @if(($invoice->currency ?? 'UGX') === 'UGX')
                                        UGX {{ number_format($invoice->total_amount, 0) }}
                                    @else
                                        ${{ number_format($invoice->total_amount, 2) }}
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $invoice->status_color }}">
                                        {{ ucwords(str_replace('_', ' ', $invoice->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1 align-items-center">
                                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.invoices.print', $invoice->id) }}" class="btn btn-sm btn-secondary" title="Print" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <a href="{{ route('admin.invoices.pdf', $invoice->id) }}" class="btn btn-sm btn-dark" title="Download PDF" target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        @if($invoice->client->email)
                                        <button type="button"
                                                class="btn btn-sm btn-primary"
                                                title="Send Invoice to Client"
                                                data-send-modal
                                                data-title="Send Invoice {{ $invoice->invoice_number }}"
                                                data-to="{{ $invoice->client->email }}"
                                                data-action="{{ route('admin.invoices.send-email', $invoice->id) }}"
                                                data-preview="{{ route('admin.invoices.print', $invoice->id) }}"
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                        @if($invoice->payments()->exists())
                                        <button type="button"
                                                class="btn btn-sm btn-success"
                                                title="Send Receipt to Client"
                                                data-send-modal
                                                data-title="Send Receipt – Invoice {{ $invoice->invoice_number }}"
                                                data-to="{{ $invoice->client->email }}"
                                                data-action="{{ route('admin.invoices.send-receipt', $invoice->id) }}"
                                                data-preview="{{ route('admin.invoices.receipt', $invoice->id) }}"
                                            <i class="fas fa-receipt"></i>
                                        </button>
                                        @endif
                                        @endif
                                        <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No invoices found</td>
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
</div>
@endsection
