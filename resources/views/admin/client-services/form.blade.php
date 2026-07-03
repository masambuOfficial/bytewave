@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add New Service')

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
    .bw-help {
        font-size: 0.85rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm bw-card">
                <div class="card-header bw-card-header py-3">
                    <h5 class="mb-1">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</h5>
                    <div class="bw-help">Services are templates. You can override rate per quotation/invoice.</div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ isset($service) ? route('admin.client-services.update', $service) : route('admin.client-services.store') }}" 
                          method="POST">
                        @csrf
                        @if(isset($service))
                            @method('PUT')
                        @endif

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
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3">{{ old('description', $service->description ?? '') }}</textarea>
                                <div class="bw-help mt-1">Optional. Use this for internal notes or what the service typically includes.</div>
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
                                    <option value="hour"></option>
                                    <option value="day"></option>
                                    <option value="project"></option>
                                    <option value="month"></option>
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

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.client-services.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($service) ? 'Update' : 'Create' }} Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
