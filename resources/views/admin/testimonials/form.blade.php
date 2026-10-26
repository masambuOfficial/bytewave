@extends('layouts.admin')

@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial')

@section('content')
<div class="container-fluid pf">
    <div class="pf-head">
        <div>
            <h1>{{ isset($testimonial) ? 'Edit testimonial' : 'New testimonial' }}</h1>
            <p>Client feedback shown on the public site once approved.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="pf-back">&larr; All testimonials</a>
    </div>

    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($testimonial))
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="pf-panel">
                    <h2 class="pf-panel__title">Author</h2>

                    <div class="mb-field">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                               value="{{ old('name', $testimonial->name ?? '') }}" placeholder="Full name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-field">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title / position <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                   value="{{ old('title', $testimonial->title ?? '') }}" placeholder="e.g. Project Manager" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company"
                                   value="{{ old('company', $testimonial->company ?? '') }}" placeholder="e.g. Stellar Industries">
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-field">
                        <label for="avatar" class="form-label">Profile photo</label>
                        @if(isset($testimonial) && $testimonial->avatar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Current avatar" class="rounded-circle" width="64" height="64" style="object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                        <small class="text-muted">JPG, PNG or GIF. Max size 2MB.</small>
                        @error('avatar')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="pf-panel">
                    <h2 class="pf-panel__title">Testimonial</h2>

                    <div class="mb-field">
                        <label for="testimonial" class="form-label">What they said <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('testimonial') is-invalid @enderror" id="testimonial" name="testimonial"
                                  rows="6" placeholder="The client's own words" required>{{ old('testimonial', $testimonial->testimonial ?? '') }}</textarea>
                        @error('testimonial')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-field">
                        <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                        <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                                    {{ $i }} star{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="pf-side">
                    <div class="pf-panel">
                        <h2 class="pf-panel__title">Publishing</h2>

                        <div class="mb-field">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $testimonial->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $testimonial->status ?? '') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $testimonial->status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-field">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" role="switch" id="is_featured" name="is_featured" value="1"
                                       {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Feature this testimonial</label>
                            </div>
                            <small class="text-muted">Featured testimonials may be highlighted on the website.</small>
                        </div>

                        <div class="mb-field">
                            <label for="order" class="form-label">Display order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                                   value="{{ old('order', $testimonial->order ?? 0) }}" min="0">
                            <small class="text-muted">Lower numbers appear first (0 = default).</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="pf-panel pf-preview">
                        <h2 class="pf-panel__title">Preview</h2>
                        <div class="pf-preview__stage">
                            <div class="mb-2">
                                @if(isset($testimonial) && $testimonial->avatar)
                                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Avatar" class="rounded-circle" width="72" height="72" style="object-fit: cover;">
                                @else
                                    <span class="pf-avatar">{{ isset($testimonial) ? strtoupper(substr($testimonial->name, 0, 1)) : '?' }}</span>
                                @endif
                            </div>
                            <div class="mb-2" style="color:#0773B9">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= old('rating', $testimonial->rating ?? 5) ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>
                            <p class="small mb-2" style="color:#546270">
                                {{ old('testimonial', $testimonial->testimonial ?? 'Your testimonial will appear here...') }}
                            </p>
                            <strong class="d-block">{{ old('name', $testimonial->name ?? 'Client name') }}</strong>
                            <small class="text-muted">
                                {{ old('title', $testimonial->title ?? 'Title') }}{{ old('company', $testimonial->company ?? '') ? ' at ' . old('company', $testimonial->company ?? '') : '' }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pf-actions">
            <a href="{{ route('admin.testimonials.index') }}" class="pf-back">Cancel</a>
            <x-admin.button type="submit">{{ isset($testimonial) ? 'Update' : 'Create' }} testimonial</x-admin.button>
        </div>
    </form>
</div>
@endsection
