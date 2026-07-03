@extends('layouts.admin')

@section('title', isset($invoice) ? 'Edit Invoice' : 'New Invoice')

@push('styles')
<style>
:root {
    --bw-blue: #0773B8;
    --bw-blue-dark: #04456E;
    --bw-gold: #FBB145;
    --bw-surface: #f8fafc;
    --bw-border: #e2e8f0;
    --bw-radius: 12px;
}

.inv-page { background: var(--bw-surface); min-height: 100vh; padding: 1.5rem 0 6rem; }

/* ── Header card ─────────────────────────────── */
.inv-header-card {
    background: #fff;
    border: 1px solid var(--bw-border);
    border-radius: var(--bw-radius);
    padding: 1.75rem 2rem;
    margin-bottom: 1.25rem;
}
.inv-title { font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0; }
.inv-back { color: var(--bw-blue); font-size: 0.85rem; text-decoration: none; }
.inv-back:hover { text-decoration: underline; }

/* ── Two-panel top section ───────────────────── */
.inv-top { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem; }
@media(max-width: 768px) { .inv-top { grid-template-columns: 1fr; } }

.inv-panel {
    background: #fff;
    border: 1px solid var(--bw-border);
    border-radius: var(--bw-radius);
    padding: 1.5rem;
}
.inv-panel-title {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--bw-blue);
    border-bottom: 2px solid var(--bw-blue);
    padding-bottom: .5rem;
    margin-bottom: 1rem;
}

.form-label-sm { font-size: 0.78rem; font-weight: 600; color: #475569; margin-bottom: .3rem; }
.form-control, .form-select { font-size: 0.875rem; border-color: var(--bw-border); border-radius: 8px; }
.form-control:focus, .form-select:focus { border-color: var(--bw-blue); box-shadow: 0 0 0 3px rgba(7,115,184,.12); }

/* ── Invoice number badge ───────────────────── */
.inv-number-badge {
    background: var(--bw-surface);
    border: 1px solid var(--bw-border);
    border-radius: 8px;
    padding: .6rem 1rem;
    font-size: 1rem;
    font-weight: 600;
    color: #0f172a;
    display: inline-block;
    letter-spacing: .03em;
}

/* ── Items table card ───────────────────────── */
.inv-items-card {
    background: #fff;
    border: 1px solid var(--bw-border);
    border-radius: var(--bw-radius);
    margin-bottom: 1.25rem;
    overflow: hidden;
}
.inv-items-header {
    background: var(--bw-blue);
    color: #fff;
    padding: .75rem 1.25rem;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
}
.items-table { width: 100%; border-collapse: collapse; }
.items-table thead th {
    background: #f1f5f9;
    padding: .6rem 1rem;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: #64748b;
    border-bottom: 1px solid var(--bw-border);
    white-space: nowrap;
}
.items-table tbody td {
    padding: .6rem .75rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}
.items-table tbody tr:last-child td { border-bottom: none; }
.items-table tbody tr:hover td { background: #fafcff; }

.items-table .form-control,
.items-table .form-select {
    font-size: 0.82rem;
    padding: .35rem .65rem;
    border-radius: 6px;
}
.line-amount {
    font-size: 0.875rem;
    font-weight: 600;
    color: #0f172a;
    white-space: nowrap;
}

/* totals */
.totals-section { padding: 1rem 1.25rem 1.25rem; border-top: 1px solid var(--bw-border); }
.totals-row {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 1rem;
    padding: .3rem 0;
    font-size: 0.875rem;
}
.totals-row .t-label { color: #64748b; width: 120px; text-align: right; }
.totals-row .t-value { width: 140px; text-align: right; font-weight: 600; color: #0f172a; }
.totals-row.total-final {
    border-top: 2px solid var(--bw-border);
    margin-top: .4rem;
    padding-top: .7rem;
    font-size: 1rem;
}
.totals-row.total-final .t-label { font-weight: 700; color: #0f172a; }
.totals-row.total-final .t-value { font-size: 1.15rem; color: var(--bw-blue); }
.tax-input { width: 80px; display: inline-block; }

/* add line btn */
.btn-add-line {
    background: none;
    border: 1.5px dashed var(--bw-border);
    color: var(--bw-blue);
    font-size: 0.82rem;
    font-weight: 600;
    padding: .5rem 1.25rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all .15s;
    margin: .75rem 1.25rem;
}
.btn-add-line:hover { background: #e8f4fd; border-color: var(--bw-blue); }

/* ── Notes / Payment details ────────────────── */
.inv-bottom { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }
@media(max-width: 768px) { .inv-bottom { grid-template-columns: 1fr; } }

/* ── Sticky action bar ──────────────────────── */
.inv-actions {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: #fff;
    border-top: 1px solid var(--bw-border);
    padding: .85rem 2rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: .75rem;
    z-index: 100;
    box-shadow: 0 -4px 16px rgba(0,0,0,.06);
}

/* hint */
#quotation_hint { display: none; font-size: 0.78rem; color: #94a3b8; margin-top: .25rem; }
</style>
@endpush

@section('content')
@php
    $isEdit        = isset($invoice);
    $invoiceCurrency = old('currency', $invoice->currency ?? 'UGX');
    $existingItems = old('items', $isEdit ? $invoice->items->toArray() : []);
@endphp

<div class="inv-page">
<form action="{{ $isEdit ? route('admin.invoices.update', $invoice->id) : route('admin.invoices.store') }}"
      method="POST" id="invoiceForm">
@csrf
@if($isEdit) @method('PUT') @endif

<div class="container-fluid" style="max-width:1200px">

    {{-- ── Page heading ─────────────────────────────── --}}
    <div class="inv-header-card d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <a href="{{ route('admin.invoices.index') }}" class="inv-back">
                <i class="fas fa-arrow-left me-1"></i> Invoices
            </a>
            <h1 class="inv-title mt-1">{{ $isEdit ? 'Edit Invoice' : 'New Invoice' }}</h1>
        </div>
        @if($isEdit)
        <div class="inv-number-badge">
            <i class="fas fa-hashtag me-1 text-muted" style="font-size:.8rem"></i>{{ $invoice->invoice_number }}
        </div>
        @endif
    </div>

    @if($errors->any())
    <div class="alert alert-danger border-0 rounded-3 mb-3">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    {{-- ── Top two panels ──────────────────────────── --}}
    <div class="inv-top">

        {{-- Bill To --}}
        <div class="inv-panel">
            <div class="inv-panel-title">Bill To</div>

            <div class="mb-3">
                <label class="form-label-sm">Client <span class="text-danger">*</span></label>
                <select class="form-select" id="client_id" name="client_id" required>
                    <option value="">Select client…</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ old('client_id', $invoice->client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                    @endforeach
                </select>
                @error('client_id')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
            </div>

            <div class="mb-1">
                <label class="form-label-sm">From Quotation <span class="text-muted fw-normal">(optional)</span></label>
                <select class="form-select" id="quotation_id" name="quotation_id">
                    <option value="">— Manual / No quotation —</option>
                    @foreach($quotations as $q)
                    <option value="{{ $q->id }}"
                        data-client="{{ $q->client_id }}"
                        {{ old('quotation_id', $invoice->quotation_id ?? '') == $q->id ? 'selected' : '' }}>
                        {{ $q->quote_number }} – {{ $q->subject ?? $q->client->name }}
                    </option>
                    @endforeach
                </select>
                <div id="quotation_hint">No quotations found for this client.</div>
            </div>
        </div>

        {{-- Invoice Details --}}
        <div class="inv-panel">
            <div class="inv-panel-title">Invoice Details</div>

            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label-sm">Invoice Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="date"
                        value="{{ old('date', $isEdit ? $invoice->date->format('Y-m-d') : date('Y-m-d')) }}" required>
                    @error('date')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
                </div>
                <div class="col-6">
                    <label class="form-label-sm">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="due_date"
                        value="{{ old('due_date', $isEdit ? $invoice->due_date->format('Y-m-d') : date('Y-m-d', strtotime('+30 days'))) }}" required>
                    @error('due_date')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
                </div>
                <div class="col-6">
                    <label class="form-label-sm">Currency</label>
                    <select class="form-select" name="currency">
                        <option value="UGX" {{ $invoiceCurrency === 'UGX' ? 'selected' : '' }}>UGX – Uganda Shilling</option>
                        <option value="USD" {{ $invoiceCurrency === 'USD' ? 'selected' : '' }}>USD – US Dollar</option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-label-sm">Status</label>
                    <select class="form-select" name="status" required>
                        @foreach(['draft'=>'Draft','issued'=>'Issued','partially_paid'=>'Partially Paid','paid'=>'Paid','overdue'=>'Overdue','void'=>'Void'] as $val => $label)
                        <option value="{{ $val }}" {{ old('status', $invoice->status ?? 'draft') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Line Items ───────────────────────────────── --}}
    <div class="inv-items-card">
        <div class="inv-items-header">Line Items</div>

        <div class="table-responsive">
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width:28%">Service / Description</th>
                    <th style="width:8%">Unit</th>
                    <th style="width:8%">Qty</th>
                    <th style="width:18%">Rate</th>
                    <th style="width:14%;text-align:right">Amount</th>
                    <th style="width:4%"></th>
                </tr>
            </thead>
            <tbody id="invoice-items-body">
                @forelse($existingItems as $idx => $item)
                <tr class="invoice-item">
                    <td>
                        <select class="form-select service-select mb-1" name="items[{{ $idx }}][service_id]">
                            <option value="">— pick or type below —</option>
                            @foreach($services as $svc)
                            <option value="{{ $svc->id }}"
                                data-rate="{{ $svc->rate }}"
                                data-unit="{{ $svc->unit }}"
                                data-name="{{ $svc->name }}"
                                {{ ($item['service_id'] ?? $item->service_id ?? '') == $svc->id ? 'selected' : '' }}>
                                {{ $svc->name }}
                            </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control description"
                            name="items[{{ $idx }}][description]"
                            value="{{ $item['description'] ?? $item->description ?? '' }}"
                            placeholder="Description *" required>
                    </td>
                    <td><input type="text" class="form-control unit" name="items[{{ $idx }}][unit]" value="{{ $item['unit'] ?? $item->unit ?? '' }}"></td>
                    <td><input type="number" class="form-control quantity" name="items[{{ $idx }}][quantity]" value="{{ $item['quantity'] ?? $item->quantity ?? 1 }}" min="1" required></td>
                    <td><input type="number" step="0.01" class="form-control rate" name="items[{{ $idx }}][rate]" value="{{ $item['rate'] ?? $item->rate ?? 0 }}" required></td>
                    <td class="text-end">
                        <span class="line-amount">{{ number_format(($item['quantity'] ?? $item->quantity ?? 0) * ($item['rate'] ?? $item->rate ?? 0), 0) }}</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr class="invoice-item">
                    <td>
                        <select class="form-select service-select mb-1" name="items[0][service_id]">
                            <option value="">— pick or type below —</option>
                            @foreach($services as $svc)
                            <option value="{{ $svc->id }}" data-rate="{{ $svc->rate }}" data-unit="{{ $svc->unit }}" data-name="{{ $svc->name }}">
                                {{ $svc->name }}
                            </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control description" name="items[0][description]" placeholder="Description *" required>
                    </td>
                    <td><input type="text" class="form-control unit" name="items[0][unit]"></td>
                    <td><input type="number" class="form-control quantity" name="items[0][quantity]" value="1" min="1" required></td>
                    <td><input type="number" step="0.01" class="form-control rate" name="items[0][rate]" value="0" required></td>
                    <td class="text-end"><span class="line-amount">0</span></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <button type="button" class="btn-add-line" id="add-item-btn">
            <i class="fas fa-plus me-1"></i> Add Line Item
        </button>

        {{-- Totals --}}
        <div class="totals-section">
            <div class="totals-row">
                <span class="t-label">Subtotal</span>
                <span class="t-value" id="subtotal-display">0</span>
            </div>
            <div class="totals-row align-items-center">
                <span class="t-label">Tax (%)</span>
                <span class="t-value">
                    <input type="number" class="form-control tax-input text-end" id="tax_rate"
                        name="tax_rate" value="{{ old('tax_rate', $invoice->tax_rate ?? 0) }}" min="0" max="100" step="0.01">
                </span>
            </div>
            <div class="totals-row">
                <span class="t-label">Tax Amount</span>
                <span class="t-value" id="tax-amount-display">0</span>
            </div>
            <div class="totals-row total-final">
                <span class="t-label">Total</span>
                <span class="t-value" id="total-display">0</span>
            </div>
        </div>
    </div>

    {{-- ── Notes & Payment Details ──────────────────── --}}
    <div class="inv-bottom">
        <div class="inv-panel">
            <div class="inv-panel-title">Notes</div>
            <textarea class="form-control" name="notes" rows="4"
                placeholder="Additional notes for the client…">{{ old('notes', $invoice->notes ?? '') }}</textarea>
        </div>
        <div class="inv-panel">
            <div class="inv-panel-title">Payment Instructions</div>
            <textarea class="form-control" name="payment_details" rows="4"
                placeholder="Bank account details, payment reference…">{{ old('payment_details', $invoice->payment_details ?? '') }}</textarea>
        </div>
    </div>

</div>{{-- /container --}}

{{-- ── Sticky action bar ─────────────────────────── --}}
<div class="inv-actions">
    <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary">
        Cancel
    </a>
    <button type="submit" class="btn btn-primary px-4">
        <i class="fas fa-save me-1"></i>
        {{ $isEdit ? 'Update Invoice' : 'Save Invoice' }}
    </button>
</div>

</form>
</div>

{{-- ── Row template (hidden, used by JS) ────────────── --}}
<template id="item-row-tpl">
    <tr class="invoice-item">
        <td>
            <select class="form-select service-select mb-1" name="items[__IDX__][service_id]">
                <option value="">— pick or type below —</option>
                @foreach($services as $svc)
                <option value="{{ $svc->id }}" data-rate="{{ $svc->rate }}" data-unit="{{ $svc->unit }}" data-name="{{ $svc->name }}">
                    {{ $svc->name }}
                </option>
                @endforeach
            </select>
            <input type="text" class="form-control description" name="items[__IDX__][description]" placeholder="Description *" required>
        </td>
        <td><input type="text" class="form-control unit" name="items[__IDX__][unit]"></td>
        <td><input type="number" class="form-control quantity" name="items[__IDX__][quantity]" value="1" min="1" required></td>
        <td><input type="number" step="0.01" class="form-control rate" name="items[__IDX__][rate]" value="0" required></td>
        <td class="text-end"><span class="line-amount">0</span></td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
</template>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // ── Quotation data keyed by client_id ─────────────
    var allQuotations = {};
    @foreach($quotations as $q)
    (allQuotations[{{ $q->client_id }}] = allQuotations[{{ $q->client_id }}] || []).push({
        id: {{ $q->id }},
        label: @json($q->quote_number . ' – ' . ($q->subject ?? $q->client->name))
    });
    @endforeach

    // ── DOM refs ──────────────────────────────────────
    var clientSel   = document.getElementById('client_id');
    var quoteSel    = document.getElementById('quotation_id');
    var quoteHint   = document.getElementById('quotation_hint');
    var itemsBody   = document.getElementById('invoice-items-body');
    var addBtn      = document.getElementById('add-item-btn');
    var taxInput    = document.getElementById('tax_rate');
    var tplEl       = document.getElementById('item-row-tpl');

    // ── Number helpers ────────────────────────────────
    function num(v) { return parseFloat(String(v || 0).replace(/,/g, '')) || 0; }
    function fmt(n) { return Number(n).toLocaleString('en-UG', { minimumFractionDigits: 0, maximumFractionDigits: 0 }); }

    // ── Recalculate totals ────────────────────────────
    function recalc() {
        var subtotal = 0;
        itemsBody.querySelectorAll('.invoice-item').forEach(function (row) {
            var qty  = num(row.querySelector('.quantity').value);
            var rate = num(row.querySelector('.rate').value);
            var line = qty * rate;
            row.querySelector('.line-amount').textContent = fmt(line);
            subtotal += line;
        });
        var taxRate   = num(taxInput.value);
        var taxAmount = subtotal * taxRate / 100;
        var total     = subtotal + taxAmount;
        document.getElementById('subtotal-display').textContent    = fmt(subtotal);
        document.getElementById('tax-amount-display').textContent  = fmt(taxAmount);
        document.getElementById('total-display').textContent       = fmt(total);
    }

    // ── Add a row from template ───────────────────────
    function addRow(data) {
        var idx   = itemsBody.querySelectorAll('.invoice-item').length;
        var clone = tplEl.content.cloneNode(true);
        var row   = clone.querySelector('tr');

        row.querySelectorAll('[name]').forEach(function (el) {
            el.setAttribute('name', el.getAttribute('name').replace(/__IDX__/g, idx));
        });

        if (data) {
            if (data.service_id) row.querySelector('.service-select').value = data.service_id;
            row.querySelector('.description').value = data.description || '';
            row.querySelector('.unit').value        = data.unit || '';
            row.querySelector('.quantity').value    = data.quantity || 1;
            row.querySelector('.rate').value        = data.rate || 0;
        }

        itemsBody.appendChild(row);
        recalc();
    }

    // ── Add line item button ──────────────────────────
    addBtn.addEventListener('click', function () { addRow(); });

    // ── Remove row ────────────────────────────────────
    itemsBody.addEventListener('click', function (e) {
        var btn = e.target.closest('.remove-item');
        if (!btn) return;
        if (itemsBody.querySelectorAll('.invoice-item').length > 1) {
            btn.closest('.invoice-item').remove();
            recalc();
        }
    });

    // ── Service select → auto-fill ────────────────────
    itemsBody.addEventListener('change', function (e) {
        if (!e.target.classList.contains('service-select')) return;
        var opt  = e.target.options[e.target.selectedIndex];
        var row  = e.target.closest('.invoice-item');
        var rate = opt.dataset.rate || 0;
        var unit = opt.dataset.unit || '';
        var name = opt.dataset.name || '';
        row.querySelector('.rate').value = rate;
        if (unit && !row.querySelector('.unit').value) row.querySelector('.unit').value = unit;
        if (name && !row.querySelector('.description').value) row.querySelector('.description').value = name;
        recalc();
    });

    // ── Qty / Rate / Tax input ────────────────────────
    itemsBody.addEventListener('input', function (e) {
        if (e.target.classList.contains('quantity') || e.target.classList.contains('rate')) recalc();
    });
    taxInput.addEventListener('input', recalc);

    // ── Client → filter quotation dropdown ───────────
    function filterQuotations(clientId) {
        var currentVal = quoteSel.value;
        // Remove all but first option
        while (quoteSel.options.length > 1) quoteSel.remove(1);

        if (!clientId) { quoteHint.style.display = 'none'; return; }

        var opts = allQuotations[clientId] || [];
        if (opts.length === 0) {
            quoteHint.style.display = 'block';
        } else {
            quoteHint.style.display = 'none';
            opts.forEach(function (q) {
                var o = new Option(q.label, q.id);
                quoteSel.appendChild(o);
            });
            // Restore selection if still valid
            if (currentVal) quoteSel.value = currentVal;
        }
    }

    clientSel.addEventListener('change', function () {
        filterQuotations(this.value);
        // Clear quotation selection only when client changes
        quoteSel.value = '';
    });

    // ── Quotation selected → load items ──────────────
    quoteSel.addEventListener('change', function () {
        var qid = this.value;
        if (!qid) return;

        fetch('/admin/quotations/' + qid + '/items')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                itemsBody.innerHTML = '';
                if (!data || data.length === 0) { addRow(); return; }
                data.forEach(function (item) { addRow(item); });
            })
            .catch(function () { /* keep existing rows on error */ });
    });

    // ── Init ──────────────────────────────────────────
    recalc();

    // On edit / validation-fail page load, restore quotation dropdown for current client
    var initClient = clientSel.value;
    if (initClient) {
        var savedQuote = quoteSel.value;
        filterQuotations(initClient);
        if (savedQuote) quoteSel.value = savedQuote;
    }
}());
</script>
@endpush
