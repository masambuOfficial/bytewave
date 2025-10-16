@extends('layouts.admin')

@section('title', isset($quotation) ? 'Edit Quotation' : 'Create Quotation')

@push('styles')
<style>
    .item-row {
        transition: all 0.3s ease;
    }
    .item-row:hover {
        background-color: #f8f9fa;
    }
    .remove-item {
        transition: all 0.2s ease;
    }
    .remove-item:hover {
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($quotation) ? 'Edit Quotation' : 'Create New Quotation' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ isset($quotation) ? route('admin.quotations.update', $quotation) : route('admin.quotations.store') }}" 
                          method="POST" 
                          id="quotationForm">
                        @csrf
                        @if(isset($quotation))
                            @method('PUT')
                        @endif

                        <div class="row mb-4">
                            <!-- Client Selection -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client_id" class="form-label">Client</label>
                                    <select class="form-select @error('client_id') is-invalid @enderror" 
                                            id="client_id" 
                                            name="client_id" 
                                            required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" 
                                                {{ old('client_id', $quotation->client_id ?? '') == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        @foreach(['draft', 'sent', 'accepted', 'rejected'] as $status)
                                            <option value="{{ $status }}" 
                                                {{ old('status', $quotation->status ?? 'draft') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Quote Date</label>
                                    <input type="date" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ old('date', isset($quotation) ? $quotation->date->format('Y-m-d') : date('Y-m-d')) }}" 
                                           required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="valid_until" class="form-label">Valid Until</label>
                                    <input type="date" 
                                           class="form-control @error('valid_until') is-invalid @enderror" 
                                           id="valid_until" 
                                           name="valid_until" 
                                           value="{{ old('valid_until', isset($quotation) ? $quotation->valid_until->format('Y-m-d') : date('Y-m-d', strtotime('+30 days'))) }}" 
                                           required>
                                    @error('valid_until')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Items Section -->
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Items</h6>
                            </div>
                            <div class="card-body">
                                <div id="items-container">
                                    @if(isset($quotation) && $quotation->items->count() > 0)
                                        @foreach($quotation->items as $index => $item)
                                            <div class="row item-row mb-3 align-items-center">
                                                <div class="col-md-4">
                                                    <select class="form-select" name="items[{{ $index }}][service_id]" required>
                                                        <option value="">Select Service</option>
                                                        @foreach($services as $service)
                                                            <option value="{{ $service->id }}" 
                                                                {{ $item->service_id == $service->id ? 'selected' : '' }}
                                                                data-rate="{{ $service->rate }}">
                                                                {{ $service->name }} ({{ ucfirst($service->unit) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" 
                                                           class="form-control" 
                                                           name="items[{{ $index }}][quantity]" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" 
                                                           placeholder="Quantity" 
                                                           required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" 
                                                           class="form-control" 
                                                           name="items[{{ $index }}][rate]" 
                                                           value="{{ $item->rate }}" 
                                                           step="0.01" 
                                                           placeholder="Rate" 
                                                           required>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" 
                                                           class="form-control" 
                                                           value="${{ number_format($item->quantity * $item->rate, 2) }}" 
                                                           readonly>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-outline-danger remove-item">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row item-row mb-3 align-items-center">
                                            <div class="col-md-4">
                                                <select class="form-select" name="items[0][service_id]" required>
                                                    <option value="">Select Service</option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}" data-rate="{{ $service->rate }}">
                                                            {{ $service->name }} ({{ ucfirst($service->unit) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" 
                                                       class="form-control" 
                                                       name="items[0][quantity]" 
                                                       value="1" 
                                                       min="1" 
                                                       placeholder="Quantity" 
                                                       required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" 
                                                       class="form-control" 
                                                       name="items[0][rate]" 
                                                       step="0.01" 
                                                       placeholder="Rate" 
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" 
                                                       class="form-control" 
                                                       value="$0.00" 
                                                       readonly>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-outline-danger remove-item">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-outline-primary" id="add-item">
                                        <i class="fas fa-plus"></i> Add Item
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" 
                                      name="notes" 
                                      rows="3">{{ old('notes', $quotation->notes ?? '') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.quotations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($quotation) ? 'Update' : 'Create' }} Quotation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('items-container');
    const addButton = document.getElementById('add-item');
    let itemCount = container.children.length;

    // Add new item row
    addButton.addEventListener('click', function() {
        const template = container.children[0].cloneNode(true);
        const inputs = template.querySelectorAll('input, select');
        
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                input.setAttribute('name', name.replace(/\[\d+\]/, `[${itemCount}]`));
            }
            if (input.type !== 'hidden') {
                input.value = input.type === 'number' ? (input.min || 0) : '';
            }
        });

        container.appendChild(template);
        itemCount++;
        updateCalculations();
    });

    // Remove item row
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            const row = e.target.closest('.item-row');
            if (container.children.length > 1) {
                row.remove();
                updateCalculations();
            }
        }
    });

    // Update rate when service is selected
    container.addEventListener('change', function(e) {
        if (e.target.matches('select')) {
            const row = e.target.closest('.item-row');
            const option = e.target.options[e.target.selectedIndex];
            const rate = option.dataset.rate;
            
            if (rate) {
                row.querySelector('input[name$="[rate]"]').value = rate;
                updateCalculations();
            }
        }
    });

    // Update calculations when quantity or rate changes
    container.addEventListener('input', function(e) {
        if (e.target.matches('input[type="number"]')) {
            updateCalculations();
        }
    });

    function updateCalculations() {
        const rows = container.querySelectorAll('.item-row');
        rows.forEach(row => {
            const quantity = parseFloat(row.querySelector('input[name$="[quantity]"]').value) || 0;
            const rate = parseFloat(row.querySelector('input[name$="[rate]"]').value) || 0;
            const total = quantity * rate;
            row.querySelector('input[readonly]').value = '$' + total.toFixed(2);
        });
    }

    // Initial calculation
    updateCalculations();
});
</script>
@endpush
