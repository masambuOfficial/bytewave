@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Create Service')

@push('styles')
<style>
    .image-preview {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 0.375rem;
    }
    .preview-wrapper {
        position: relative;
        width: 100%;
        height: 200px;
        border: 2px dashed #dee2e6;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .preview-wrapper:hover .preview-overlay {
        opacity: 1;
    }
    .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($service) ? 'Edit Service' : 'Create New Service' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($service))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Name -->
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

                                <!-- Description -->
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

                                <!-- Price -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               id="price" 
                                               name="price" 
                                               step="0.01" 
                                               value="{{ old('price', $service->price ?? '') }}" 
                                               required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Image -->
                                <div class="mb-3">
                                    <label class="form-label">Service Image</label>
                                    <div class="preview-wrapper mb-2">
                                        @if(isset($service) && $service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" 
                                                 alt="Service Image Preview" 
                                                 class="image-preview" 
                                                 id="imagePreview">
                                        @else
                                            <div class="text-center text-muted" id="placeholderText">
                                                <i class="fas fa-image fa-3x mb-2"></i>
                                                <p class="mb-0">No image selected</p>
                                            </div>
                                            <img src="" 
                                                 alt="Service Image Preview" 
                                                 class="image-preview d-none" 
                                                 id="imagePreview">
                                        @endif
                                        <div class="preview-overlay">
                                            <button type="button" 
                                                    class="btn btn-light" 
                                                    onclick="document.getElementById('image').click()">
                                                <i class="fas fa-upload"></i> Change Image
                                            </button>
                                        </div>
                                    </div>
                                    <input type="file" 
                                           class="form-control d-none @error('image') is-invalid @enderror" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const placeholderText = document.getElementById('placeholderText');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
                if (placeholderText) {
                    placeholderText.classList.add('d-none');
                }
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
@endpush