@extends('layouts.admin')

@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($testimonial) ? 'Edit' : 'Create' }} Testimonial</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($testimonial))
                            @method('PUT')
                        @endif

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $testimonial->name ?? '') }}" 
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title/Position -->
                        <div class="form-group">
                            <label for="title">Title/Position <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('title') is-invalid @enderror" 
                                id="title" 
                                name="title" 
                                value="{{ old('title', $testimonial->title ?? '') }}" 
                                placeholder="e.g., Project Manager"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input 
                                type="text" 
                                class="form-control @error('company') is-invalid @enderror" 
                                id="company" 
                                name="company" 
                                value="{{ old('company', $testimonial->company ?? '') }}" 
                                placeholder="e.g., Stellar Industries"
                            >
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div class="form-group">
                            <label for="rating">Rating <span class="text-danger">*</span></label>
                            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Testimonial -->
                        <div class="form-group">
                            <label for="testimonial">Testimonial <span class="text-danger">*</span></label>
                            <textarea 
                                class="form-control @error('testimonial') is-invalid @enderror" 
                                id="testimonial" 
                                name="testimonial" 
                                rows="6" 
                                required
                            >{{ old('testimonial', $testimonial->testimonial ?? '') }}</textarea>
                            @error('testimonial')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avatar Upload -->
                        <div class="form-group">
                            <label for="avatar">Profile Photo</label>
                            @if(isset($testimonial) && $testimonial->avatar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Current avatar" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                            <input 
                                type="file" 
                                class="form-control-file @error('avatar') is-invalid @enderror" 
                                id="avatar" 
                                name="avatar" 
                                accept="image/*"
                            >
                            <small class="form-text text-muted">JPG, PNG, or GIF. Max size: 2MB</small>
                            @error('avatar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $testimonial->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $testimonial->status ?? '') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $testimonial->status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Is Featured -->
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input 
                                    type="checkbox" 
                                    class="custom-control-input" 
                                    id="is_featured" 
                                    name="is_featured" 
                                    value="1"
                                    {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }}
                                >
                                <label class="custom-control-label" for="is_featured">
                                    Feature this testimonial
                                </label>
                            </div>
                            <small class="form-text text-muted">Featured testimonials may be highlighted on the website</small>
                        </div>

                        <!-- Order -->
                        <div class="form-group">
                            <label for="order">Display Order</label>
                            <input 
                                type="number" 
                                class="form-control @error('order') is-invalid @enderror" 
                                id="order" 
                                name="order" 
                                value="{{ old('order', $testimonial->order ?? 0) }}" 
                                min="0"
                            >
                            <small class="form-text text-muted">Lower numbers appear first (0 = default)</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($testimonial) ? 'Update' : 'Create' }} Testimonial
                            </button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
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
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if(isset($testimonial) && $testimonial->avatar)
                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Avatar" class="rounded-circle" width="80" height="80">
                        @else
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                                {{ isset($testimonial) ? substr($testimonial->name, 0, 1) : '?' }}
                            </div>
                        @endif
                    </div>
                    <div class="text-center mb-2">
                        <div class="text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= (old('rating', $testimonial->rating ?? 5)))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p class="text-muted small">
                        {{ old('testimonial', $testimonial->testimonial ?? 'Your testimonial will appear here...') }}
                    </p>
                    <div class="text-center">
                        <strong>{{ old('name', $testimonial->name ?? 'Client Name') }}</strong><br>
                        <small class="text-muted">
                            {{ old('title', $testimonial->title ?? 'Title') }}{{ old('company', $testimonial->company ?? '') ? ' at ' . old('company', $testimonial->company ?? '') : '' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
