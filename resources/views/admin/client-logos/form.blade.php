@extends('layouts.admin')

@section('title', isset($clientLogo) ? 'Edit Client Logo' : 'Add Client Logo')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($clientLogo) ? 'Edit' : 'Add' }} Client Logo</h1>
        <a href="{{ route('admin.client-logos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ isset($clientLogo) ? route('admin.client-logos.update', $clientLogo) : route('admin.client-logos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($clientLogo))
                            @method('PUT')
                        @endif

                        <!-- Client Name -->
                        <div class="form-group">
                            <label for="name">Client Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $clientLogo->name ?? '') }}" 
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Logo Upload -->
                        <div class="form-group">
                            <label for="logo">Logo <span class="text-danger">*</span></label>
                            @if(isset($clientLogo) && $clientLogo->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $clientLogo->logo) }}" alt="Current logo" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input 
                                type="file" 
                                class="form-control-file @error('logo') is-invalid @enderror" 
                                id="logo" 
                                name="logo" 
                                accept="image/*"
                                {{ isset($clientLogo) ? '' : 'required' }}
                            >
                            <small class="form-text text-muted">PNG, JPG, GIF, or SVG. Max size: 2MB. Transparent backgrounds recommended.</small>
                            @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Website URL -->
                        <div class="form-group">
                            <label for="url">Website URL (Optional)</label>
                            <input 
                                type="url" 
                                class="form-control @error('url') is-invalid @enderror" 
                                id="url" 
                                name="url" 
                                value="{{ old('url', $clientLogo->url ?? '') }}" 
                                placeholder="https://example.com"
                            >
                            <small class="form-text text-muted">If provided, logo will be clickable</small>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="form-group">
                            <label for="order">Display Order</label>
                            <input 
                                type="number" 
                                class="form-control @error('order') is-invalid @enderror" 
                                id="order" 
                                name="order" 
                                value="{{ old('order', $clientLogo->order ?? 0) }}" 
                                min="0"
                            >
                            <small class="form-text text-muted">Lower numbers appear first (0 = default)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Is Active -->
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input 
                                    type="checkbox" 
                                    class="custom-control-input" 
                                    id="is_active" 
                                    name="is_active" 
                                    value="1"
                                    {{ old('is_active', $clientLogo->is_active ?? true) ? 'checked' : '' }}
                                >
                                <label class="custom-control-label" for="is_active">
                                    Active (Display on website)
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($clientLogo) ? 'Update' : 'Add' }} Logo
                            </button>
                            <a href="{{ route('admin.client-logos.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Preview</h6>
                </div>
                <div class="card-body text-center">
                    <div class="p-4 bg-light rounded">
                        @if(isset($clientLogo) && $clientLogo->logo)
                            <img src="{{ asset('storage/' . $clientLogo->logo) }}" alt="Logo preview" class="img-fluid" style="max-height: 100px;">
                        @else
                            <div class="text-muted">
                                <i class="fas fa-image fa-3x mb-2"></i>
                                <p>Logo preview will appear here</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <strong>{{ old('name', $clientLogo->name ?? 'Client Name') }}</strong>
                    </div>
                </div>
            </div>

            <div class="card shadow mt-3">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Use transparent PNG for best results</li>
                        <li>Recommended size: 200x100px</li>
                        <li>Keep file size under 500KB</li>
                        <li>SVG format is ideal for logos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
