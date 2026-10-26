@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add New Service')

@section('content')
<div class="container-fluid pf pf--narrow">
    <div class="pf-head">
        <div>
            <h1>{{ isset($service) ? 'Edit service' : 'New service' }}</h1>
            <p>Services are templates. You can override the rate per quotation or invoice.</p>
        </div>
        <a href="{{ route('admin.client-services.index') }}" class="pf-back">&larr; All services</a>
    </div>

    <form action="{{ isset($service) ? route('admin.client-services.update', $service) : route('admin.client-services.store') }}" 
                          method="POST">
        @csrf
                        @if(isset($service))
                            @method('PUT')
                        @endif

        <div class="pf-panel">

                        <div class="row g-3">
                            <div class="col-12">
                            <label for="name" class="form-label">Service Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $service->name ?? '') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control doc-text @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4">{{ old('description', $service->description ?? '') }}</textarea>
                                <div class="bw-help mt-1">Optional. Appears on quotations and invoices when this service is picked. Use bullets to itemize what is included.</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="rate" class="form-label">Suggested Rate</label>
                                <input type="number" 
                                       class="form-control @error('rate') is-invalid @enderror" 
                                       id="rate" 
                                       name="rate" 
                                       value="{{ old('rate', $service->rate ?? '') }}" 
                                       step="0.01" 
                                       min="0" 
                                       required>
                                @error('rate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(!empty($hasCurrencyColumn))
                                <div class="col-md-6">
                                    <label for="currency" class="form-label">Currency</label>
                                    @php
                                        $serviceCurrency = old('currency', $service->currency ?? 'UGX');
                                    @endphp
                                    <select class="form-select @error('currency') is-invalid @enderror" id="currency" name="currency" required>
                                        <option value="UGX" {{ $serviceCurrency === 'UGX' ? 'selected' : '' }}>UGX</option>
                                        <option value="USD" {{ $serviceCurrency === 'USD' ? 'selected' : '' }}>USD</option>
                                    </select>
                                    @error('currency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-6">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text"
                                       class="form-control @error('unit') is-invalid @enderror"
                                       id="unit"
                                       name="unit"
                                       value="{{ old('unit', $service->unit ?? '') }}"
                                       list="unit_suggestions"
                                       placeholder="e.g. day, project, hour">
                                <datalist id="unit_suggestions">
                                    <option value="one-time">One-Time</option>
                                    <option value="hour">Per Hour</option>
                                    <option value="day">Per Day</option>
                                    <option value="project">Per Project</option>
                                    <option value="month">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="annually">Annually / Per Year</option>
                                    <option value="unit"></option>
                                    <option value="visit"></option>
                                    <option value="trip"></option>
                                    <option value="crew-day"></option>
                                </datalist>
                                @error('unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(!empty($hasStatusColumn))
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                        @php
                                            $statusValue = old('status', $service->status ?? 'active');
                                        @endphp
                                        @foreach(['active' => 'Active', 'inactive' => 'Inactive'] as $value => $label)
                                            <option value="{{ $value }}" {{ $statusValue === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                        </div>
        </div>

        <div class="pf-actions">
            <a href="{{ route('admin.client-services.index') }}" class="pf-back">Cancel</a>
            <x-admin.button type="submit">{{ isset($service) ? 'Update' : 'Create' }} service</x-admin.button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@include('admin.partials.doc-text-editor')
@endpush
