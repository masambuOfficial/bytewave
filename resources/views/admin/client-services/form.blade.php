@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add New Service')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">{{ isset($service) ? 'Edit Service' : 'Add New Service' }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($service) ? route('admin.client-services.update', $service) : route('admin.client-services.store') }}" 
                          method="POST">
                        @csrf
                        @if(isset($service))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
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

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required>{{ old('description', $service->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rate" class="form-label">Rate</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               class="form-control @error('rate') is-invalid @enderror" 
                                               id="rate" 
                                               name="rate" 
                                               value="{{ old('rate', $service->rate ?? '') }}" 
                                               step="0.01" 
                                               min="0" 
                                               required>
                                    </div>
                                    @error('rate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select class="form-select @error('unit') is-invalid @enderror" 
                                            id="unit" 
                                            name="unit" 
                                            required>
                                        <option value="">Select a unit</option>
                                        @foreach(['hour', 'project', 'month', 'unit'] as $unit)
                                            <option value="{{ $unit }}" 
                                                {{ old('unit', $service->unit ?? '') == $unit ? 'selected' : '' }}>
                                                {{ ucfirst($unit) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.client-services.index') }}" class="btn btn-secondary">
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
