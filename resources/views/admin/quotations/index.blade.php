@extends('layouts.admin')

@section('title', 'Quotations')

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
            <h1 class="bw-title">Quotations</h1>
            <div class="bw-subtitle">Manage quotations and export for print/PDF.</div>
        </div>
        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Quotation
        </a>
    </div>

    <div class="card shadow-sm bw-card">
        <div class="card-header bw-card-header py-3">
            <div class="fw-semibold">All Quotations</div>
        </div>
        <div class="card-body p-0">
            @if($quotations->isEmpty())
                <div class="text-center p-4">
                    <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No quotations found.</p>
                    <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary">
                        Create your first quotation
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0 bw-table">
                        <thead>
                            <tr>
                                <th>Quote #</th>
                                <th>Client</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Valid Until</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotations as $quotation)
                                <tr>
                                    <td>{{ $quotation->quote_number }}</td>
                                    <td>{{ $quotation->client->name }}</td>
                                    <td>{{ $quotation->subject }}</td>
                                    <td>{{ $quotation->date->format('M d, Y') }}</td>
                                    <td>{{ $quotation->valid_until->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $quotation->status_color }}">
                                            {{ ucfirst($quotation->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(($quotation->currency ?? 'UGX') === 'UGX')
                                            UGX {{ number_format($quotation->total_amount, 0) }}
                                        @else
                                            ${{ number_format($quotation->total_amount, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group flex-wrap gap-1">
                                            @if($quotation->status === 'accepted' && !$quotation->invoice)
                                            <form action="{{ route('admin.quotations.convert-to-invoice', $quotation) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Create an invoice from this quotation?')">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-success"
                                                        title="Convert to Invoice">
                                                    <i class="fas fa-file-invoice-dollar"></i> Invoice
                                                </button>
                                            </form>
                                            @elseif($quotation->invoice)
                                            <a href="{{ route('admin.invoices.show', $quotation->invoice) }}"
                                               class="btn btn-sm btn-outline-success"
                                               title="View Invoice">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                            @endif
                                            <a href="{{ route('admin.quotations.edit', $quotation) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.quotations.print', $quotation) }}"
                                               class="btn btn-sm btn-outline-info"
                                               title="Print"
                                               target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a href="{{ route('admin.quotations.pdf', $quotation) }}"
                                               class="btn btn-sm btn-outline-secondary"
                                               title="Download PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            @if($quotation->client->email)
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Send to Client"
                                                    data-send-modal
                                                    data-title="Send Quotation {{ $quotation->quote_number }}"
                                                    data-to="{{ $quotation->client->email }}"
                                                    data-action="{{ route('admin.quotations.send-email', $quotation) }}"
                                                    data-preview="{{ route('admin.quotations.print', $quotation) }}">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            @endif
                                            <form action="{{ route('admin.quotations.destroy', $quotation) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this quotation?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center p-3 border-top">
                    {{ $quotations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
