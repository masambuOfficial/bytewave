@extends('layouts.admin')

@section('title', 'Quotations')

@push('styles')
<style>
    .quotations-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .quotations-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .quotations-header p {
        color: #6B7A85;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-quotation {
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

    .btn-add-quotation:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .quotations-card {
        background: #fff;
        border: 1px solid #EEF1F4;
        border-radius: 16px;
        overflow: hidden;
    }

    .quotations-table {
        width: 100%;
        margin-bottom: 0;
        min-width: 980px;
    }

    .quotations-table thead th {
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

    .quotations-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #F4F6F8;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #1F2A33;
    }

    .quotations-table tbody tr:last-child td {
        border-bottom: none;
    }

    .quotations-table tbody tr:hover {
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
    .status-pill.bg-success { background: #E9F9EF !important; color: #1E8E4F !important; }
    .status-pill.bg-danger { background: #FDEDEC !important; color: #C0392B !important; }

    .amount-cell {
        font-weight: 700;
        color: var(--bytewave-blue-dark);
    }

    .row-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
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

    .quotations-empty {
        text-align: center;
        padding: 3rem 1rem;
    }

    .quotations-empty i {
        font-size: 2.5rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .quotations-empty p {
        color: #6B7A85;
        margin-bottom: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="quotations-header">
        <div>
            <h1>Quotations</h1>
            <p>Manage quotations and export for print/PDF.</p>
        </div>
        <a href="{{ route('admin.quotations.create') }}" class="btn-add-quotation">
            <i class="fas fa-plus"></i> New Quotation
        </a>
    </div>

    <div class="quotations-card">
        @if($quotations->isEmpty())
            <div class="quotations-empty">
                <i class="fas fa-file-invoice"></i>
                <p>No quotations found.</p>
                <a href="{{ route('admin.quotations.create') }}" class="btn-add-quotation">
                    Create your first quotation
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="quotations-table">
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
                                <td class="fw-semibold">{{ $quotation->quote_number }}</td>
                                <td>{{ $quotation->client->name }}</td>
                                <td>{{ $quotation->subject }}</td>
                                <td>{{ $quotation->date->format('M d, Y') }}</td>
                                <td>{{ $quotation->valid_until->format('M d, Y') }}</td>
                                <td>
                                    <span class="status-pill bg-{{ $quotation->status_color }}">
                                        {{ ucfirst($quotation->status) }}
                                    </span>
                                </td>
                                <td class="amount-cell">
                                    @if(($quotation->currency ?? 'UGX') === 'UGX')
                                        UGX {{ number_format($quotation->total_amount, 0) }}
                                    @else
                                        ${{ number_format($quotation->total_amount, 2) }}
                                    @endif
                                </td>
                                <td>
                                    <div class="row-actions">
                                        @if($quotation->status === 'accepted' && !$quotation->invoice)
                                        <form action="{{ route('admin.quotations.convert-to-invoice', $quotation) }}"
                                              method="POST"
                                              onsubmit="return confirm('Create an invoice from this quotation?')">
                                            @csrf
                                            <button type="submit"
                                                    class="row-action-btn green"
                                                    title="Convert to Invoice">
                                                <i class="fas fa-file-invoice-dollar"></i> Invoice
                                            </button>
                                        </form>
                                        @elseif($quotation->invoice)
                                        <a href="{{ route('admin.invoices.show', $quotation->invoice) }}"
                                           class="row-action-btn green"
                                           title="View Invoice">
                                            <i class="fas fa-file-invoice"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('admin.quotations.edit', $quotation) }}"
                                           class="row-action-btn blue"
                                           title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('admin.quotations.print', $quotation) }}"
                                           class="row-action-btn gray"
                                           title="Print"
                                           target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <a href="{{ route('admin.quotations.pdf', $quotation) }}"
                                           class="row-action-btn gray"
                                           title="Download PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        @if($quotation->client->email)
                                        <button type="button"
                                                class="row-action-btn gold"
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
                                              onsubmit="return confirm('Are you sure you want to delete this quotation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="row-action-btn red"
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
@endsection
