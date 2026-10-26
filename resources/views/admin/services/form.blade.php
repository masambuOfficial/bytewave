@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Create Service')

@section('content')
<div class="container-fluid pf">
    <div class="pf-head">
        <div>
            <h1>{{ isset($service) ? 'Edit service' : 'New service' }}</h1>
        </div>
        <a href="{{ route('admin.services.index') }}" class="pf-back">&larr; All services</a>
    </div>

    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
        @csrf
                        @if(isset($service))
                            @method('PUT')
                        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="pf-panel">
                    <h2 class="pf-panel__title">Details</h2>
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

                                <!-- Meta Description (SEO) -->
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                              id="meta_description"
                                              name="meta_description"
                                              rows="2"
                                              maxlength="320"
                                              placeholder="Shown in Google search results. Aim for 120-160 characters. Leave blank to use the start of the description.">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                                    @error('meta_description')
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
            </div>

            <div class="col-lg-4">
                <div class="pf-panel">
                    <h2 class="pf-panel__title">Image</h2>
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
                                            <x-admin.button type="button" onclick="document.getElementById('image').click()" variant="secondary">Change Image</x-admin.button>
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
        </div>

        <div class="pf-actions">
            <a href="{{ route('admin.services.index') }}" class="pf-back">Cancel</a>
            <x-admin.button type="submit">{{ isset($service) ? 'Update' : 'Create' }} service</x-admin.button>
        </div>
    </form>
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