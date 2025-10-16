@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($invoice) ? 'Edit' : 'Create' }} Invoice</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($invoice) ? route('admin.invoices.update', $invoice->id) : route('admin.invoices.store') }}" method="POST">
                        @csrf
                        @if(isset($invoice))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_id">Client</label>
                                    <select class="form-control select2 @error('client_id') is-invalid @enderror" 
                                        id="client_id" name="client_id" required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" 
                                                {{ (old('client_id', $invoice->client_id ?? '') == $client->id) ? 'selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quotation_id">From Quotation (Optional)</label>
                                    <select class="form-control select2" id="quotation_id" name="quotation_id">
                                        <option value="">Select Quotation</option>
                                        @foreach($quotations as $quotation)
                                            <option value="{{ $quotation->id }}" 
                                                {{ (old('quotation_id', $invoice->quotation_id ?? '') == $quotation->id) ? 'selected' : '' }}>
                                                {{ $quotation->quote_number }} - {{ $quotation->client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">Invoice Date</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                        id="date" name="date" value="{{ old('date', isset($invoice) ? $invoice->date->format('Y-m-d') : date('Y-m-d')) }}" required>
                                    @error('date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                        id="due_date" name="due_date" 
                                        value="{{ old('due_date', isset($invoice) ? $invoice->due_date->format('Y-m-d') : date('Y-m-d', strtotime('+30 days'))) }}" required>
                                    @error('due_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="draft" {{ (old('status', $invoice->status ?? '') == 'draft') ? 'selected' : '' }}>Draft</option>
                                        <option value="sent" {{ (old('status', $invoice->status ?? '') == 'sent') ? 'selected' : '' }}>Sent</option>
                                        <option value="paid" {{ (old('status', $invoice->status ?? '') == 'paid') ? 'selected' : '' }}>Paid</option>
                                        <option value="overdue" {{ (old('status', $invoice->status ?? '') == 'overdue') ? 'selected' : '' }}>Overdue</option>
                                        <option value="cancelled" {{ (old('status', $invoice->status ?? '') == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Invoice Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="invoice-items">
                                    @forelse(old('items', $invoice->items ?? []) as $index => $item)
                                    <div class="invoice-item row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Service</label>
                                                <select class="form-control service-select" name="items[{{ $index }}][service_id]" required>
                                                    <option value="">Select Service</option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}" 
                                                            data-rate="{{ $service->rate }}"
                                                            {{ $item['service_id'] == $service->id ? 'selected' : '' }}>
                                                            {{ $service->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control quantity" 
                                                    name="items[{{ $index }}][quantity]" 
                                                    value="{{ $item['quantity'] }}" min="1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Rate</label>
                                                <input type="number" step="0.01" class="form-control rate" 
                                                    name="items[{{ $index }}][rate]" 
                                                    value="{{ $item['rate'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" class="form-control amount" readonly 
                                                    value="{{ number_format($item['quantity'] * $item['rate'], 2) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-item mt-4">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="invoice-item row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Service</label>
                                                <select class="form-control service-select" name="items[0][service_id]" required>
                                                    <option value="">Select Service</option>
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}" data-rate="{{ $service->rate }}">
                                                            {{ $service->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control quantity" 
                                                    name="items[0][quantity]" value="1" min="1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Rate</label>
                                                <input type="number" step="0.01" class="form-control rate" 
                                                    name="items[0][rate]" value="0.00" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" class="form-control amount" readonly value="0.00">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-item mt-4">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success add-item">
                                            <i class="fas fa-plus"></i> Add Item
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Subtotal</label>
                                            <input type="text" class="form-control" id="subtotal" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Tax Rate (%)</label>
                                            <input type="number" class="form-control" id="tax_rate" name="tax_rate" 
                                                value="{{ old('tax_rate', $invoice->tax_rate ?? 0) }}" min="0" max="100">
                                        </div>
                                        <div class="form-group">
                                            <label>Tax Amount</label>
                                            <input type="text" class="form-control" id="tax_amount" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Amount</label>
                                            <input type="text" class="form-control" id="total_amount" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $invoice->notes ?? '') }}</textarea>
                        </div>

                        <div class="form-group mt-4">
                            <label for="payment_details">Payment Details</label>
                            <textarea class="form-control" id="payment_details" name="payment_details" rows="3">{{ old('payment_details', $invoice->payment_details ?? '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($invoice) ? 'Update' : 'Create' }} Invoice
                            </button>
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();

    // Calculate line item amount
    function calculateAmount(item) {
        var quantity = parseFloat(item.find('.quantity').val()) || 0;
        var rate = parseFloat(item.find('.rate').val()) || 0;
        var amount = quantity * rate;
        item.find('.amount').val(amount.toFixed(2));
        calculateTotals();
    }

    // Calculate totals
    function calculateTotals() {
        var subtotal = 0;
        $('.amount').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });
        
        var taxRate = parseFloat($('#tax_rate').val()) || 0;
        var taxAmount = subtotal * (taxRate / 100);
        var total = subtotal + taxAmount;
        
        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_amount').val(taxAmount.toFixed(2));
        $('#total_amount').val(total.toFixed(2));
    }

    // Add new item
    $('.add-item').click(function() {
        var index = $('.invoice-item').length;
        var template = $('.invoice-item').first().clone();
        
        template.find('input').val('');
        template.find('select').val('');
        template.find('[name]').each(function() {
            var name = $(this).attr('name');
            name = name.replace(/\[\d+\]/, '[' + index + ']');
            $(this).attr('name', name);
        });
        
        $('.invoice-items').append(template);
    });

    // Remove item
    $(document).on('click', '.remove-item', function() {
        if ($('.invoice-item').length > 1) {
            $(this).closest('.invoice-item').remove();
            calculateTotals();
        }
    });

    // Update rate when service is selected
    $(document).on('change', '.service-select', function() {
        var rate = $(this).find(':selected').data('rate') || 0;
        $(this).closest('.invoice-item').find('.rate').val(rate);
        calculateAmount($(this).closest('.invoice-item'));
    });

    // Recalculate on quantity, rate or tax rate change
    $(document).on('input', '.quantity, .rate, #tax_rate', function() {
        if ($(this).hasClass('quantity') || $(this).hasClass('rate')) {
            calculateAmount($(this).closest('.invoice-item'));
        } else {
            calculateTotals();
        }
    });

    // Load quotation data
    $('#quotation_id').change(function() {
        var quotationId = $(this).val();
        if (quotationId) {
            $.get('/admin/quotations/' + quotationId + '/items', function(data) {
                $('.invoice-items').empty();
                data.forEach(function(item, index) {
                    var template = $('.invoice-item').first().clone();
                    template.find('.service-select').val(item.service_id);
                    template.find('.quantity').val(item.quantity);
                    template.find('.rate').val(item.rate);
                    template.find('.amount').val((item.quantity * item.rate).toFixed(2));
                    
                    template.find('[name]').each(function() {
                        var name = $(this).attr('name');
                        name = name.replace(/\[\d+\]/, '[' + index + ']');
                        $(this).attr('name', name);
                    });
                    
                    $('.invoice-items').append(template);
                });
                calculateTotals();
            });
        }
    });

    // Initial calculation
    calculateTotals();
});
</script>
@endpush
@endsection
