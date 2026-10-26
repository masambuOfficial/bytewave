@extends('layouts.admin')

@section('title', isset($clientLogo) ? 'Edit Client Logo' : 'Add Client Logo')

@section('content')
<div class="container-fluid pf">
    <div class="pf-head">
        <div>
            <h1>{{ isset($clientLogo) ? 'Edit client logo' : 'New client logo' }}</h1>
            <p>Logos appear in the "trusted by" strip on the public site.</p>
        </div>
        <a href="{{ route('admin.client-logos.index') }}" class="pf-back">&larr; All logos</a>
    </div>

    <form action="{{ isset($clientLogo) ? route('admin.client-logos.update', $clientLogo) : route('admin.client-logos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($clientLogo))
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="pf-panel">
                    <h2 class="pf-panel__title">Details</h2>

                    <div class="mb-field">
                        <label for="name" class="form-label">Client name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                               value="{{ old('name', $clientLogo->name ?? '') }}" placeholder="e.g. Stellar Industries" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-field">
                        <label for="logo" class="form-label">Logo <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*"
                               {{ isset($clientLogo) ? '' : 'required' }}>
                        <small class="text-muted">PNG, JPG, GIF or SVG. Max size 2MB. Transparent backgrounds work best.</small>
                        @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-field">
                        <label for="url" class="form-label">Website URL <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url"
                               value="{{ old('url', $clientLogo->url ?? '') }}" placeholder="https://example.com">
                        <small class="text-muted">If provided, the logo links to this address.</small>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="pf-panel">
                    <h2 class="pf-panel__title">Display</h2>

                    <div class="mb-field">
                        <label for="order" class="form-label">Display order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                               value="{{ old('order', $clientLogo->order ?? 0) }}" min="0" style="max-width: 10rem;">
                        <small class="text-muted">Lower numbers appear first (0 = default).</small>
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-field">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" role="switch" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $clientLogo->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (show on website)</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="pf-side">
                    <div class="pf-panel pf-preview">
                        <h2 class="pf-panel__title">Preview</h2>
                        <div class="pf-preview__stage">
                            @if(isset($clientLogo) && $clientLogo->logo)
                                <img src="{{ asset('storage/' . $clientLogo->logo) }}" alt="Logo preview" class="img-fluid" style="max-height: 100px;">
                            @else
                                <div style="color:#546270">
                                    <i class="fas fa-image mb-2" style="font-size:1.75rem;color:#0773B9;opacity:.6"></i>
                                    <p class="mb-0 small">Logo preview will appear here</p>
                                </div>
                            @endif
                        </div>
                        <strong class="d-block mt-3">{{ old('name', $clientLogo->name ?? 'Client name') }}</strong>
                    </div>

                    <div class="pf-panel">
                        <h2 class="pf-panel__title">Tips</h2>
                        <ul class="pf-note">
                            <li>Use a transparent PNG for best results</li>
                            <li>Recommended size: 200x100px</li>
                            <li>Keep the file under 500KB</li>
                            <li>SVG is ideal for logos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pf-actions">
            <a href="{{ route('admin.client-logos.index') }}" class="pf-back">Cancel</a>
            <x-admin.button type="submit">{{ isset($clientLogo) ? 'Update' : 'Add' }} logo</x-admin.button>
        </div>
    </form>
</div>
@endsection
