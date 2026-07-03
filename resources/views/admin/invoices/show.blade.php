@extends('layouts.admin')

@section('title', 'Invoice #' . $invoice->invoice_number)

@push('styles')
<style>
    .bw-card { border: 1px solid rgba(0,0,0,0.06); border-radius: 12px; }
    .bw-card-header { background: #fff; border-bottom: 1px solid rgba(0,0,0,0.06); }
    .bw-title { font-size: 1.5rem; font-weight: 700; margin: 0; }
    .bw-subtitle { font-size: 0.9rem; color: #6c757d; margin-top: 0.25rem; }
    .bw-table thead th {
        font-size: 0.8rem; letter-spacing: 0.02em; color: #6c757d;
        text-transform: uppercase; background: #f8fafc;
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding: 0.85rem 0.9rem; white-space: nowrap;
    }
    .bw-table tbody td { padding: 0.85rem 0.9rem; vertical-align: middle; }
    .balance-due { font-size: 1.3rem; font-weight: 700; color: #dc3545; }
    .balance-zero { font-size: 1.3rem; font-weight: 700; color: #198754; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 0.5rem; }
    .summary-row .label { color: #6c757d; font-size: 0.9rem; }
</style>
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
        <div>
            <h1 class="bw-title">Invoice #{{ $invoice->invoice_number }}</h1>
            <div class="bw-subtitle">
                {{ $invoice->client->name }} &bull;
                {{ $invoice->date->format('M d, Y') }} &bull;
                Due {{ $invoice->due_date->format('M d, Y') }} &bull;
                <span class="badge bg-{{ $invoice->status_color }}">{{ ucwords(str_replace('_', ' ', $invoice->status)) }}</span>
            </div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.invoices.edit', $invoice) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.invoices.print', $invoice) }}" class="btn btn-secondary btn-sm" target="_blank">
                <i class="fas fa-print"></i> Print
            </a>
            <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="btn btn-dark btn-sm" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            @if($invoice->payments->isNotEmpty())
            <a href="{{ route('admin.invoices.receipt', $invoice) }}" class="btn btn-success btn-sm" target="_blank">
                <i class="fas fa-receipt"></i> Receipt
            </a>
            <a href="{{ route('admin.invoices.receipt-pdf', $invoice) }}" class="btn btn-outline-success btn-sm" target="_blank">
                <i class="fas fa-file-pdf"></i> Receipt PDF
            </a>
            @endif
            <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @php
        $cur = $invoice->currency ?? 'UGX';
        $fmt = fn($n) => $cur === 'UGX' ? 'UGX ' . number_format($n, 0) : '$' . number_format($n, 2);
    @endphp

    <div class="row g-4">

        {{-- Left column --}}
        <div class="col-lg-8">

            {{-- Line Items --}}
            <div class="card shadow-sm bw-card mb-4">
                <div class="card-header bw-card-header py-3">
                    <div class="fw-semibold">Line Items</div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 bw-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-end">Rate</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->unit ?? '—' }}</td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ $fmt($item->rate) }}</td>
                                    <td class="text-end">{{ $fmt($item->line_total ?? ($item->quantity * $item->rate)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Payment History --}}
            <div class="card shadow-sm bw-card">
                <div class="card-header bw-card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="fw-semibold">Payment History</div>
                    @if(!in_array($invoice->status, ['paid', 'void']))
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#recordPaymentModal">
                        <i class="fas fa-plus"></i> Record Payment
                    </button>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($invoice->payments->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-money-bill-wave fa-2x mb-2 d-block opacity-50"></i>
                        No payments recorded yet.
                        @if(!in_array($invoice->status, ['paid', 'void']))
                        <div class="mt-2">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#recordPaymentModal">
                                Record First Payment
                            </button>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 bw-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Method</th>
                                    <th>Reference</th>
                                    <th>Notes</th>
                                    <th class="text-end">Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->payments as $payment)
                                <tr>
                                    <td>{{ $payment->paid_at->format('M d, Y') }}</td>
                                    <td>{{ $payment->method }}</td>
                                    <td>{{ $payment->reference ?? '—' }}</td>
                                    <td class="text-muted small">{{ $payment->notes ?? '—' }}</td>
                                    <td class="text-end fw-semibold text-success">{{ $fmt($payment->amount) }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.invoices.payments.destroy', [$invoice, $payment]) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Remove this payment entry?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Remove payment">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Right column --}}
        <div class="col-lg-4">

            {{-- Summary --}}
            <div class="card shadow-sm bw-card mb-4">
                <div class="card-header bw-card-header py-3">
                    <div class="fw-semibold">Summary</div>
                </div>
                <div class="card-body">
                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span>{{ $fmt($invoice->subtotal) }}</span>
                    </div>
                    @if($invoice->tax_rate > 0)
                    <div class="summary-row">
                        <span class="label">Tax ({{ $invoice->tax_rate }}%)</span>
                        <span>{{ $fmt($invoice->tax_amount) }}</span>
                    </div>
                    @endif
                    <div class="summary-row border-top pt-2 mt-1">
                        <span class="fw-bold">Invoice Total</span>
                        <span class="fw-bold">{{ $fmt($invoice->total_amount) }}</span>
                    </div>
                    <div class="summary-row mt-2">
                        <span class="label">Amount Paid</span>
                        <span class="text-success fw-semibold">{{ $fmt($invoice->amount_paid) }}</span>
                    </div>
                    <div class="summary-row border-top pt-2 mt-1 align-items-center">
                        <span class="fw-bold">Balance Due</span>
                        @if($invoice->balance_due > 0)
                            <span class="balance-due">{{ $fmt($invoice->balance_due) }}</span>
                        @else
                            <span class="balance-zero"><i class="fas fa-check-circle"></i> PAID</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Invoice Details --}}
            <div class="card shadow-sm bw-card">
                <div class="card-header bw-card-header py-3">
                    <div class="fw-semibold">Details</div>
                </div>
                <div class="card-body">
                    <dl class="row mb-0 small">
                        <dt class="col-5 text-muted fw-normal">Client</dt>
                        <dd class="col-7 mb-2">{{ $invoice->client->name }}</dd>

                        <dt class="col-5 text-muted fw-normal">Currency</dt>
                        <dd class="col-7 mb-2">{{ $cur }}</dd>

                        <dt class="col-5 text-muted fw-normal">Invoice Date</dt>
                        <dd class="col-7 mb-2">{{ $invoice->date->format('M d, Y') }}</dd>

                        <dt class="col-5 text-muted fw-normal">Due Date</dt>
                        <dd class="col-7 mb-2">{{ $invoice->due_date->format('M d, Y') }}</dd>

                        @if($invoice->quotation)
                        <dt class="col-5 text-muted fw-normal">Quote Ref</dt>
                        <dd class="col-7 mb-2">{{ $invoice->quotation->quote_number }}</dd>
                        @endif

                        @if($invoice->payment_details)
                        <dt class="col-12 text-muted fw-normal mt-1">Payment Instructions</dt>
                        <dd class="col-12 mb-2">{!! nl2br(e($invoice->payment_details)) !!}</dd>
                        @endif

                        @if($invoice->notes)
                        <dt class="col-12 text-muted fw-normal mt-1">Notes</dt>
                        <dd class="col-12 mb-0">{!! nl2br(e($invoice->notes)) !!}</dd>
                        @endif
                    </dl>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Record Payment Modal --}}
<div class="modal fade" id="recordPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.invoices.payments.store', $invoice) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Amount <span class="text-muted">({{ $cur }})</span></label>
                        <input type="number"
                               class="form-control"
                               name="amount"
                               step="0.01"
                               min="0.01"
                               value="{{ $invoice->balance_due > 0 ? number_format($invoice->balance_due, 2, '.', '') : '' }}"
                               required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Date</label>
                        <input type="date" class="form-control" name="paid_at" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" name="method" required>
                            <option value="">Select method…</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="MTN Mobile Money">MTN Mobile Money</option>
                            <option value="Airtel Money">Airtel Money</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Card">Card (Visa / Mastercard)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reference / Transaction ID <span class="text-muted">(optional)</span></label>
                        <input type="text" class="form-control" name="reference" placeholder="e.g. TXN-12345">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes <span class="text-muted">(optional)</span></label>
                        <textarea class="form-control" name="notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
