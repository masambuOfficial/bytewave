@extends('layouts.admin')

@section('title', isset($quotation) ? 'Edit Quotation' : 'New Quotation')

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

/* Items table */
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
.items-table .form-select { font-size: 0.82rem; padding: .35rem .65rem; border-radius: 6px; }

.line-amount { font-size: 0.875rem; font-weight: 600; color: #0f172a; white-space: nowrap; }

/* Save-as-service toggle */
.save-toggle {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
    padding-top: 4px;
}
.save-toggle label { font-size: 0.65rem; color: #94a3b8; line-height: 1; }

/* Totals */
.totals-section { padding: 1rem 1.25rem 1.25rem; border-top: 1px solid var(--bw-border); }
.totals-row {
    display: flex; justify-content: flex-end; align-items: center;
    gap: 1rem; padding: .3rem 0; font-size: 0.875rem;
}
.totals-row .t-label { color: #64748b; width: 130px; text-align: right; }
.totals-row .t-value { width: 150px; text-align: right; font-weight: 600; color: #0f172a; }
.totals-row.total-final {
    border-top: 2px solid var(--bw-border);
    margin-top: .4rem; padding-top: .7rem; font-size: 1rem;
}
.totals-row.total-final .t-label { font-weight: 700; color: #0f172a; }
.totals-row.total-final .t-value { font-size: 1.15rem; color: var(--bw-blue); }
.tax-input { width: 80px; display: inline-block; }

/* Add line btn */
.btn-add-line {
    background: none;
    border: 1.5px dashed var(--bw-border);
    color: var(--bw-blue);
    font-size: 0.82rem; font-weight: 600;
    padding: .5rem 1.25rem;
    border-radius: 8px; cursor: pointer;
    transition: all .15s;
    margin: .75rem 1.25rem;
}
.btn-add-line:hover { background: #e8f4fd; border-color: var(--bw-blue); }

/* Bottom notes */
.inv-bottom { display: grid; grid-template-columns: 1fr; gap: 1.25rem; margin-bottom: 1.25rem; }

/* Sticky action bar */
.inv-actions {
    position: fixed; bottom: 0; left: 0; right: 0;
    background: #fff; border-top: 1px solid var(--bw-border);
    padding: .85rem 2rem;
    display: flex; justify-content: flex-end; align-items: center; gap: .75rem;
    z-index: 100; box-shadow: 0 -4px 16px rgba(0,0,0,.06);
}

/* Locked banner */
.locked-banner {
    background: #fef9c3; border: 1px solid #fde047; border-radius: 10px;
    padding: .75rem 1.25rem; font-size: .875rem; color: #713f12; margin-bottom: 1.25rem;
}
</style>
@endpush

@section('content')
@php
    $isEdit   = isset($quotation);
    $locked   = $isEdit && $quotation->status === 'accepted';
    $qCurrency = old('currency', $quotation->currency ?? 'UGX');
    $existingItems = $isEdit ? $quotation->items : collect();
@endphp

<div class="inv-page">
<form action="{{ $isEdit ? route('admin.quotations.update', $quotation) : route('admin.quotations.store') }}"
      method="POST" id="quotationForm">
@csrf
@if($isEdit) @method('PUT') @endif

<div class="container-fluid" style="max-width:1200px">

    {{-- Page heading --}}
    <div class="inv-header-card d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <a href="{{ route('admin.quotations.index') }}" class="inv-back">
                <i class="fas fa-arrow-left me-1"></i> Quotations
            </a>
            <h1 class="inv-title mt-1">{{ $isEdit ? 'Edit Quotation' : 'New Quotation' }}</h1>
        </div>
        @if($isEdit)
        <div class="inv-number-badge">
            <i class="fas fa-hashtag me-1 text-muted" style="font-size:.8rem"></i>{{ $quotation->quote_number }}
        </div>
        @endif
    </div>

    @if($locked)
    <div class="locked-banner">
        <i class="fas fa-lock me-2"></i>
        This quotation has been <strong>accepted</strong> and is locked. To make changes, revert the status first.
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger border-0 rounded-3 mb-3">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    {{-- Two panels --}}
    <div class="inv-top">

        {{-- Quote To --}}
        <div class="inv-panel">
            <div class="inv-panel-title">Quote To</div>

            <div class="mb-3">
                <label class="form-label-sm">Client <span class="text-danger">*</span></label>
                <select class="form-select @error('client_id') is-invalid @enderror"
                        name="client_id" required {{ $locked ? 'disabled' : '' }}>
                    <option value="">Select client…</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}"
                        {{ old('client_id', $quotation->client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                    @endforeach
                </select>
                @error('client_id')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label-sm">Attention (Attn)</label>
                <input type="text" class="form-control @error('attn_name') is-invalid @enderror"
                    name="attn_name"
                    value="{{ old('attn_name', $quotation->attn_name ?? '') }}"
                    placeholder="Contact person name"
                    {{ $locked ? 'readonly' : '' }}>
                @error('attn_name')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
            </div>

            <div class="mb-1">
                <label class="form-label-sm">Subject / Order</label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                    name="subject"
                    value="{{ old('subject', $quotation->subject ?? '') }}"
                    placeholder="e.g. Website Development Project"
                    {{ $locked ? 'readonly' : '' }}>
                @error('subject')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Quotation Details --}}
        <div class="inv-panel">
            <div class="inv-panel-title">Quotation Details</div>

            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label-sm">Quote Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                        name="date"
                        value="{{ old('date', $isEdit ? $quotation->date->format('Y-m-d') : date('Y-m-d')) }}"
                        required {{ $locked ? 'readonly' : '' }}>
                    @error('date')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
                </div>

                <div class="col-6">
                    <label class="form-label-sm">Valid Until <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('valid_until') is-invalid @enderror"
                        name="valid_until"
                        value="{{ old('valid_until', $isEdit ? $quotation->valid_until->format('Y-m-d') : date('Y-m-d', strtotime('+30 days'))) }}"
                        required {{ $locked ? 'readonly' : '' }}>
                    @error('valid_until')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
                </div>

                <div class="col-6">
                    <label class="form-label-sm">Currency</label>
                    <select class="form-select @error('currency') is-invalid @enderror"
                            id="currency" name="currency" required {{ $locked ? 'disabled' : '' }}>
                        <option value="UGX" {{ $qCurrency === 'UGX' ? 'selected' : '' }}>UGX – Uganda Shilling</option>
                        <option value="USD" {{ $qCurrency === 'USD' ? 'selected' : '' }}>USD – US Dollar</option>
                    </select>
                    @error('currency')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
                </div>

                <div class="col-6">
                    <label class="form-label-sm">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror"
                            name="status" required>
                        @foreach(['draft' => 'Draft', 'sent' => 'Sent', 'accepted' => 'Accepted', 'rejected' => 'Rejected'] as $val => $label)
                        <option value="{{ $val }}"
                            {{ old('status', $quotation->status ?? 'draft') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('status')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Line Items --}}
    <div class="inv-items-card">
        <div class="inv-items-header d-flex justify-content-between align-items-center">
            <span>Line Items</span>
            @if(!$locked)
            <button type="button" id="add-item-btn" class="btn btn-sm btn-light" style="font-size:.78rem;padding:.25rem .75rem">
                <i class="fas fa-plus me-1"></i> Add Item
            </button>
            @endif
        </div>

        <div class="table-responsive">
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width:25%">Service</th>
                    <th style="width:28%">Description <span class="text-danger">*</span></th>
                    <th style="width:7%">Unit</th>
                    <th style="width:7%">Qty</th>
                    <th style="width:14%">Rate</th>
                    <th style="width:13%;text-align:right">Amount</th>
                    <th style="width:4%;text-align:center" title="Save as reusable service">Save</th>
                    <th style="width:2%"></th>
                </tr>
            </thead>
            <tbody id="items-container">
                @if($existingItems->count() > 0)
                    @foreach($existingItems as $idx => $item)
                    <tr class="item-row">
                        <td>
                            <select class="form-select service-select" name="items[{{ $idx }}][service_id]" {{ $locked ? 'disabled' : '' }}>
                                <option value="">— pick or type →</option>
                                <option value="__new__">+ Create new service…</option>
                                @foreach($services as $svc)
                                <option value="{{ $svc->id }}"
                                    data-rate="{{ $svc->rate }}"
                                    data-currency="{{ $svc->currency ?? 'UGX' }}"
                                    data-unit="{{ $svc->unit }}"
                                    data-name="{{ $svc->name }}"
                                    {{ $item->service_id == $svc->id ? 'selected' : '' }}>
                                    {{ $svc->name }}{{ $svc->unit ? ' ('.ucfirst($svc->unit).')' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                name="items[{{ $idx }}][description]"
                                value="{{ $item->description }}"
                                placeholder="Description" required {{ $locked ? 'readonly' : '' }}>
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                name="items[{{ $idx }}][unit]"
                                value="{{ $item->unit }}" {{ $locked ? 'readonly' : '' }}>
                        </td>
                        <td>
                            <input type="number" class="form-control quantity"
                                name="items[{{ $idx }}][quantity]"
                                value="{{ $item->quantity }}" min="1" required {{ $locked ? 'readonly' : '' }}>
                        </td>
                        <td>
                            <input type="number" step="0.01" class="form-control rate"
                                name="items[{{ $idx }}][rate]"
                                value="{{ $item->rate }}" required {{ $locked ? 'readonly' : '' }}>
                        </td>
                        <td class="text-end">
                            <span class="line-amount">{{ number_format($item->quantity * $item->rate, 0) }}</span>
                        </td>
                        <td>
                            <div class="save-toggle">
                                <input class="form-check-input save-as-service" type="checkbox"
                                    name="items[{{ $idx }}][save_as_service]" value="1"
                                    {{ $locked ? 'disabled' : '' }}>
                                <label style="font-size:.62rem;color:#94a3b8">save</label>
                            </div>
                        </td>
                        <td>
                            @if(!$locked)
                            <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr class="item-row">
                    <td>
                        <select class="form-select service-select" name="items[0][service_id]">
                            <option value="">— pick or type →</option>
                            <option value="__new__">+ Create new service…</option>
                            @foreach($services as $svc)
                            <option value="{{ $svc->id }}"
                                data-rate="{{ $svc->rate }}"
                                data-currency="{{ $svc->currency ?? 'UGX' }}"
                                data-unit="{{ $svc->unit }}"
                                data-name="{{ $svc->name }}">
                                {{ $svc->name }}{{ $svc->unit ? ' ('.ucfirst($svc->unit).')' : '' }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="items[0][description]" placeholder="Description" required></td>
                    <td><input type="text" class="form-control" name="items[0][unit]"></td>
                    <td><input type="number" class="form-control quantity" name="items[0][quantity]" value="1" min="1" required></td>
                    <td><input type="number" step="0.01" class="form-control rate" name="items[0][rate]" value="0" required></td>
                    <td class="text-end"><span class="line-amount">0</span></td>
                    <td>
                        <div class="save-toggle">
                            <input class="form-check-input save-as-service" type="checkbox" name="items[0][save_as_service]" value="1">
                            <label style="font-size:.62rem;color:#94a3b8">save</label>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>

        @if(!$locked)
        <button type="button" class="btn-add-line" id="add-item-btn-2">
            <i class="fas fa-plus me-1"></i> Add Line Item
        </button>
        @endif

        {{-- Totals --}}
        <div class="totals-section">
            <div class="totals-row">
                <span class="t-label">Subtotal</span>
                <span class="t-value" id="subtotal_display">0</span>
            </div>
            <div class="totals-row align-items-center">
                <span class="t-label">Tax (%)</span>
                <span class="t-value">
                    <input type="number" class="form-control tax-input text-end" id="tax_rate"
                        name="tax_rate"
                        value="{{ old('tax_rate', $isEdit ? $quotation->tax_rate : 0) }}"
                        min="0" max="100" step="0.5"
                        {{ $locked ? 'readonly' : '' }}>
                </span>
            </div>
            <div class="totals-row">
                <span class="t-label">Tax Amount</span>
                <span class="t-value" id="tax_amount_display">0</span>
            </div>
            <div class="totals-row total-final">
                <span class="t-label">Total</span>
                <span class="t-value" id="total_display">0</span>
            </div>
        </div>
    </div>

    {{-- Notes --}}
    <div class="inv-bottom">
        <div class="inv-panel">
            <div class="inv-panel-title">Notes</div>
            <textarea class="form-control @error('notes') is-invalid @enderror"
                      name="notes" rows="3"
                      placeholder="Additional notes, terms, or conditions…"
                      {{ $locked ? 'readonly' : '' }}>{{ old('notes', $quotation->notes ?? '') }}</textarea>
            @error('notes')<div class="text-danger" style="font-size:.78rem">{{ $message }}</div>@enderror
        </div>
    </div>

</div>{{-- /container --}}

{{-- Sticky action bar --}}
<div class="inv-actions">
    <a href="{{ route('admin.quotations.index') }}" class="btn btn-outline-secondary">Cancel</a>
    @if(!$locked)
    <button type="submit" class="btn btn-primary px-4">
        <i class="fas fa-save me-1"></i>
        {{ $isEdit ? 'Update Quotation' : 'Save Quotation' }}
    </button>
    @endif
</div>

</form>
</div>

{{-- Row template --}}
<template id="item-row-tpl">
    <tr class="item-row">
        <td>
            <select class="form-select service-select" name="items[__IDX__][service_id]">
                <option value="">— pick or type →</option>
                <option value="__new__">+ Create new service…</option>
                @foreach($services as $svc)
                <option value="{{ $svc->id }}"
                    data-rate="{{ $svc->rate }}"
                    data-currency="{{ $svc->currency ?? 'UGX' }}"
                    data-unit="{{ $svc->unit }}"
                    data-name="{{ $svc->name }}">
                    {{ $svc->name }}{{ $svc->unit ? ' ('.ucfirst($svc->unit).')' : '' }}
                </option>
                @endforeach
            </select>
        </td>
        <td><input type="text" class="form-control" name="items[__IDX__][description]" placeholder="Description" required></td>
        <td><input type="text" class="form-control" name="items[__IDX__][unit]"></td>
        <td><input type="number" class="form-control quantity" name="items[__IDX__][quantity]" value="1" min="1" required></td>
        <td><input type="number" step="0.01" class="form-control rate" name="items[__IDX__][rate]" value="0" required></td>
        <td class="text-end"><span class="line-amount">0</span></td>
        <td>
            <div class="save-toggle">
                <input class="form-check-input save-as-service" type="checkbox" name="items[__IDX__][save_as_service]" value="1">
                <label style="font-size:.62rem;color:#94a3b8">save</label>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-danger remove-item" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
</template>

{{-- Create Service Modal --}}
<div class="modal fade" id="createServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;border:none">
            <div class="modal-header" style="border-bottom:1px solid var(--bw-border)">
                <h5 class="modal-title fw-700" style="font-size:1rem">
                    <i class="fas fa-plus-circle me-2 text-primary"></i>Create New Service
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label-sm">Service Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="service_modal_name" placeholder="e.g. Livestreaming">
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Unit</label>
                        <input type="text" class="form-control" id="service_modal_unit" placeholder="day, project, hour">
                    </div>
                    <div class="col-6">
                        <label class="form-label-sm">Currency</label>
                        <select class="form-select" id="service_modal_currency">
                            <option value="UGX">UGX</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label-sm">Suggested Rate <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="service_modal_rate" step="0.01" min="0">
                        <div style="font-size:.75rem;color:#94a3b8;margin-top:.25rem">Can be overridden per quotation.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label-sm">Description <span class="text-muted fw-normal">(optional)</span></label>
                        <textarea class="form-control" id="service_modal_description" rows="2" placeholder="Optional"></textarea>
                    </div>
                </div>
                <div class="text-danger small mt-2 d-none" id="service_modal_error"></div>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--bw-border)">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="service_modal_save">
                    <i class="fas fa-save me-1"></i> Save Service
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var container  = document.getElementById('items-container');
    var tplEl      = document.getElementById('item-row-tpl');
    var taxInput   = document.getElementById('tax_rate');
    var csrfToken  = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
    var createServiceModalEl = document.getElementById('createServiceModal');
    var createServiceModal   = createServiceModalEl ? new bootstrap.Modal(createServiceModalEl) : null;
    var activeServiceSelect  = null;

    // ── Number helpers ────────────────────────────────
    function num(v) { return parseFloat(String(v || 0).replace(/,/g, '')) || 0; }

    function fmt(n) {
        var cur = document.getElementById('currency')?.value || 'UGX';
        return cur === 'UGX'
            ? 'UGX ' + Math.round(n).toLocaleString()
            : 'USD ' + n.toFixed(2);
    }

    // ── Recalculate ───────────────────────────────────
    function recalc() {
        var subtotal = 0;
        container.querySelectorAll('.item-row').forEach(function (row) {
            var qty  = num(row.querySelector('.quantity')?.value);
            var rate = num(row.querySelector('.rate')?.value);
            var line = qty * rate;
            var span = row.querySelector('.line-amount');
            if (span) span.textContent = fmt(line);
            subtotal += line;
        });
        var taxRate   = num(taxInput?.value);
        var taxAmount = subtotal * taxRate / 100;
        var total     = subtotal + taxAmount;

        var el;
        if ((el = document.getElementById('subtotal_display')))    el.textContent = fmt(subtotal);
        if ((el = document.getElementById('tax_amount_display')))   el.textContent = fmt(taxAmount);
        if ((el = document.getElementById('total_display')))        el.textContent = fmt(total);
    }

    // ── Add row ───────────────────────────────────────
    function addRow() {
        var idx   = container.querySelectorAll('.item-row').length;
        var clone = tplEl.content.cloneNode(true);
        var row   = clone.querySelector('tr');
        row.querySelectorAll('[name]').forEach(function (el) {
            el.setAttribute('name', el.getAttribute('name').replace(/__IDX__/g, idx));
        });
        container.appendChild(row);
        recalc();
    }

    // ── Bind add buttons ──────────────────────────────
    ['add-item-btn', 'add-item-btn-2'].forEach(function (id) {
        var btn = document.getElementById(id);
        if (btn) btn.addEventListener('click', addRow);
    });

    // ── Remove row ────────────────────────────────────
    container.addEventListener('click', function (e) {
        var btn = e.target.closest('.remove-item');
        if (!btn) return;
        if (container.querySelectorAll('.item-row').length > 1) {
            btn.closest('.item-row').remove();
            recalc();
        }
    });

    // ── Service select → auto-fill ────────────────────
    container.addEventListener('change', function (e) {
        if (!e.target.classList.contains('service-select')) return;
        var row = e.target.closest('.item-row');
        var val = e.target.value;

        if (val === '__new__') {
            activeServiceSelect = e.target;
            e.target.value = '';
            var errorEl = document.getElementById('service_modal_error');
            if (errorEl) { errorEl.classList.add('d-none'); errorEl.textContent = ''; }
            document.getElementById('service_modal_name').value        = '';
            document.getElementById('service_modal_unit').value        = row.querySelector('[name$="[unit]"]')?.value || '';
            document.getElementById('service_modal_rate').value        = row.querySelector('.rate')?.value || '';
            document.getElementById('service_modal_currency').value    = document.getElementById('currency')?.value || 'UGX';
            document.getElementById('service_modal_description').value = '';
            if (createServiceModal) {
                createServiceModal.show();
                setTimeout(function () { document.getElementById('service_modal_name').focus(); }, 200);
            }
            return;
        }

        var opt  = e.target.options[e.target.selectedIndex];
        var rate = opt.dataset.rate || 0;
        var cur  = opt.dataset.currency || 'UGX';
        var unit = opt.dataset.unit || '';
        var name = opt.dataset.name || '';
        var qCur = document.getElementById('currency')?.value || 'UGX';

        if (cur === qCur) row.querySelector('.rate').value = rate;

        var unitEl = row.querySelector('[name$="[unit]"]');
        if (unit && unitEl && !unitEl.value) unitEl.value = unit;

        var descEl = row.querySelector('[name$="[description]"]');
        if (name && descEl && !descEl.value) descEl.value = name;

        var saveEl = row.querySelector('.save-as-service');
        if (saveEl) saveEl.checked = false;

        recalc();
    });

    // ── Qty / Rate / Tax input ────────────────────────
    container.addEventListener('input', function (e) {
        if (e.target.classList.contains('quantity') || e.target.classList.contains('rate')) recalc();
    });
    if (taxInput) taxInput.addEventListener('input', recalc);

    // Currency change → reformat amounts
    var currencySelect = document.getElementById('currency');
    if (currencySelect) currencySelect.addEventListener('change', recalc);

    // ── Create Service modal save ─────────────────────
    var saveServiceBtn = document.getElementById('service_modal_save');
    if (saveServiceBtn) {
        saveServiceBtn.addEventListener('click', async function () {
            var errorEl = document.getElementById('service_modal_error');
            if (errorEl) { errorEl.classList.add('d-none'); errorEl.textContent = ''; }

            var name     = (document.getElementById('service_modal_name').value || '').trim();
            var unit     = (document.getElementById('service_modal_unit').value || '').trim();
            var rate     = (document.getElementById('service_modal_rate').value || '').trim();
            var currency = (document.getElementById('service_modal_currency').value || 'UGX').trim();
            var desc     = (document.getElementById('service_modal_description').value || '').trim();

            if (!name || !rate) {
                if (errorEl) { errorEl.textContent = 'Service name and rate are required.'; errorEl.classList.remove('d-none'); }
                return;
            }

            saveServiceBtn.disabled = true;
            saveServiceBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving…';

            try {
                var res  = await fetch('{{ route('admin.client-services.quick-store') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ name, unit: unit || null, rate, currency, description: desc || null }),
                });
                var data = await res.json();
                if (!res.ok) throw new Error(data?.message || 'Failed to create service.');

                if (activeServiceSelect) {
                    var row   = activeServiceSelect.closest('.item-row');
                    var label = data.name + (data.unit ? ' (' + data.unit.charAt(0).toUpperCase() + data.unit.slice(1) + ')' : '');

                    var existing = Array.from(activeServiceSelect.options).find(function (o) { return String(o.value) === String(data.id); });
                    if (!existing) {
                        existing = document.createElement('option');
                        existing.value = data.id;
                        activeServiceSelect.appendChild(existing);
                    }
                    existing.textContent      = label;
                    existing.dataset.rate     = data.rate;
                    existing.dataset.currency = data.currency || 'UGX';
                    existing.dataset.unit     = data.unit || '';
                    existing.dataset.name     = data.name;
                    activeServiceSelect.value = String(data.id);

                    var rateEl = row?.querySelector('.rate');
                    if (rateEl && !rateEl.value) rateEl.value = data.rate;
                    var unitEl = row?.querySelector('[name$="[unit]"]');
                    if (unitEl && data.unit && !unitEl.value) unitEl.value = data.unit;
                    var descEl = row?.querySelector('[name$="[description]"]');
                    if (descEl && !descEl.value) descEl.value = data.name;

                    recalc();
                }
                createServiceModal?.hide();
            } catch (err) {
                if (errorEl) { errorEl.textContent = err?.message || 'Failed to create service.'; errorEl.classList.remove('d-none'); }
            } finally {
                saveServiceBtn.disabled = false;
                saveServiceBtn.innerHTML = '<i class="fas fa-save me-1"></i> Save Service';
            }
        });
    }

    // ── Init ──────────────────────────────────────────
    recalc();
}());
</script>
@endpush
