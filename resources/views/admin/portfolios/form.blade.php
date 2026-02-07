@extends('layouts.admin')

@section('title', isset($portfolio) ? 'Edit Portfolio Project' : 'Create Portfolio Project')

@push('styles')
<style>
    .image-preview {
        max-width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 0.375rem;
    }
    .preview-wrapper {
        position: relative;
        width: 100%;
        height: 250px;
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
    .technologies-input {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem;
        min-height: 100px;
    }
    .technology-tag {
        display: inline-block;
        background: #e9ecef;
        padding: 0.25rem 0.5rem;
        margin: 0.25rem;
        border-radius: 0.25rem;
    }
    .technology-tag .remove {
        margin-left: 0.5rem;
        cursor: pointer;
        color: #dc3545;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($portfolio) ? 'Edit Portfolio Project' : 'Create New Portfolio Project' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ isset($portfolio) ? route('admin.portfolios.update', $portfolio) : route('admin.portfolios.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="portfolioForm">
                        @csrf
                        @if(isset($portfolio))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $portfolio->title ?? '') }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="4" 
                                              required>{{ old('description', $portfolio->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Work Done -->
                                <div class="mb-3">
                                    <label for="work_done" class="form-label">Work Done</label>
                                    <textarea class="form-control @error('work_done') is-invalid @enderror" 
                                              id="work_done" 
                                              name="work_done" 
                                              rows="4">{{ old('work_done', $portfolio->work_done ?? '') }}</textarea>
                                    @error('work_done')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Client -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="client" class="form-label">Client</label>
                                            <input type="text" 
                                                   class="form-control @error('client') is-invalid @enderror" 
                                                   id="client" 
                                                   name="client" 
                                                   value="{{ old('client', $portfolio->client ?? '') }}">
                                            @error('client')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Completion Date -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="completion_date" class="form-label">Completion Date</label>
                                            <input type="date" 
                                                   class="form-control @error('completion_date') is-invalid @enderror" 
                                                   id="completion_date" 
                                                   name="completion_date" 
                                                   value="{{ old('completion_date', isset($portfolio) && $portfolio->completion_date ? $portfolio->completion_date->format('Y-m-d') : '') }}">
                                            @error('completion_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Project URL -->
                                <div class="mb-3">
                                    <label for="project_url" class="form-label">Project URL</label>
                                    <input type="url" 
                                           class="form-control @error('project_url') is-invalid @enderror" 
                                           id="project_url" 
                                           name="project_url" 
                                           value="{{ old('project_url', $portfolio->project_url ?? '') }}"
                                           placeholder="https://">
                                    @error('project_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Project Media</label>

                                    <select class="form-select mb-2 @error('primary_media_type') is-invalid @enderror" id="primary_media_type" name="primary_media_type">
                                        @php
                                            $selectedType = old('primary_media_type', $portfolio->primary_media_type ?? 'image');
                                        @endphp
                                        <option value="image" {{ $selectedType === 'image' ? 'selected' : '' }}>Image Upload</option>
                                        <option value="video" {{ $selectedType === 'video' ? 'selected' : '' }}>Video Upload</option>
                                        <option value="embed" {{ $selectedType === 'embed' ? 'selected' : '' }}>Embed (YouTube/Vimeo/iframe)</option>
                                    </select>
                                    @error('primary_media_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div class="preview-wrapper mb-2" id="primaryImagePreviewWrapper">
                                        @php
                                            $primaryType = isset($portfolio) ? ($portfolio->primary_media_type ?? null) : null;
                                            $primaryPath = isset($portfolio) ? ($portfolio->getRawOriginal('primary_media_path') ?? null) : null;
                                            $legacyPath = isset($portfolio) ? ($portfolio->getRawOriginal('image_url') ?? null) : null;
                                            $imageToShow = $primaryType === 'image' && $primaryPath ? ('storage/' . $primaryPath) : ($legacyPath ? ('storage/' . $legacyPath) : null);
                                        @endphp
                                        @if(isset($portfolio) && $imageToShow)
                                            <img src="{{ asset($imageToShow) }}"
                                                 alt="Project Media Preview"
                                                 class="image-preview"
                                                 id="imagePreview">
                                        @else
                                            <div class="text-center text-muted" id="placeholderText">
                                                <i class="fas fa-image fa-3x mb-2"></i>
                                                <p class="mb-0">No media selected</p>
                                            </div>
                                            <img src=""
                                                 alt="Project Media Preview"
                                                 class="image-preview d-none"
                                                 id="imagePreview">
                                        @endif
                                        <div class="preview-overlay">
                                            <button type="button" class="btn btn-light" id="primaryUploadButton">
                                                <i class="fas fa-upload"></i> Change Media
                                            </button>
                                        </div>
                                    </div>

                                    <input type="file"
                                           class="form-control d-none @error('primary_image') is-invalid @enderror"
                                           id="primary_image"
                                           name="primary_image"
                                           accept="image/*">
                                    @error('primary_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <input type="file"
                                           class="form-control d-none @error('primary_video') is-invalid @enderror"
                                           id="primary_video"
                                           name="primary_video"
                                           accept="video/mp4,video/webm,video/quicktime">
                                    @error('primary_video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div id="primaryEmbedWrapper" class="d-none">
                                        <textarea class="form-control @error('primary_embed') is-invalid @enderror"
                                                  id="primary_embed"
                                                  name="primary_embed"
                                                  rows="3"
                                                  placeholder="Paste a YouTube/Vimeo URL or an iframe code">{{ old('primary_embed', isset($portfolio) ? ($portfolio->primary_media_embed ?? '') : '') }}</textarea>
                                        @error('primary_embed')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <small class="text-muted" id="primaryHelpText">Image max size: 2MB. Video max size: 50MB.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Gallery Media (optional)</label>

                                    <input type="file"
                                           class="form-control @error('gallery_uploads') is-invalid @enderror"
                                           id="gallery_uploads"
                                           name="gallery_uploads[]"
                                           multiple
                                           accept="image/*,video/mp4,video/webm,video/quicktime">
                                    @error('gallery_uploads')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('gallery_uploads.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <textarea class="form-control mt-2 @error('gallery_embeds') is-invalid @enderror"
                                              id="gallery_embeds"
                                              name="gallery_embeds"
                                              rows="4"
                                              placeholder="Paste embed URLs/iframes, one per line">{{ old('gallery_embeds') }}</textarea>
                                    @error('gallery_embeds')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="text-muted">You can upload multiple images/videos and/or add embed links (one per line).</small>
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                            id="category" 
                                            name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}" 
                                                    {{ old('category', $portfolio->category ?? '') == $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                        <option value="other" 
                                                {{ !in_array(old('category', $portfolio->category ?? ''), $categories->toArray()) ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    <div id="newCategoryInput" class="mt-2 {{ !in_array(old('category', $portfolio->category ?? ''), $categories->toArray()) ? '' : 'd-none' }}">
                                        <input type="text" 
                                               class="form-control" 
                                               name="new_category"
                                               placeholder="Enter new category"
                                               value="{{ !in_array(old('category', $portfolio->category ?? ''), $categories->toArray()) ? old('category', $portfolio->category ?? '') : '' }}">
                                    </div>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Technologies -->
                                <div class="mb-3">
                                    <label for="technologies" class="form-label">Technologies Used</label>
                                    <div class="input-group mb-2">
                                        <input type="text" 
                                               class="form-control" 
                                               id="technologyInput" 
                                               placeholder="Add technology">
                                        <button class="btn btn-primary" 
                                                type="button" 
                                                id="addTechnology">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="technologies-input" id="technologiesContainer">
                                        @if(isset($portfolio) && $portfolio->technologies)
                                            @foreach($portfolio->technologies as $tech)
                                                <span class="technology-tag">
                                                    {{ $tech }}
                                                    <input type="hidden" name="technologies[]" value="{{ $tech }}">
                                                    <span class="remove">&times;</span>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('technologies')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($portfolio) ? 'Update' : 'Create' }} Project
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
    const primaryTypeSelect = document.getElementById('primary_media_type');
    const primaryImageInput = document.getElementById('primary_image');
    const primaryVideoInput = document.getElementById('primary_video');
    const primaryEmbedWrapper = document.getElementById('primaryEmbedWrapper');
    const primaryUploadButton = document.getElementById('primaryUploadButton');
    const primaryHelpText = document.getElementById('primaryHelpText');

    const imagePreview = document.getElementById('imagePreview');
    const placeholderText = document.getElementById('placeholderText');

    function setPrimaryTypeUI(type) {
        if (type === 'image') {
            primaryEmbedWrapper.classList.add('d-none');
            primaryHelpText.textContent = 'Image max size: 2MB.';
        }
        if (type === 'video') {
            primaryEmbedWrapper.classList.add('d-none');
            primaryHelpText.textContent = 'Video max size: 50MB (mp4/webm/mov).';
        }
        if (type === 'embed') {
            primaryEmbedWrapper.classList.remove('d-none');
            primaryHelpText.textContent = 'Paste a YouTube/Vimeo URL or iframe code.';
        }
    }

    function bindPrimaryPreview(inputEl) {
        inputEl.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.type && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                    if (placeholderText) {
                        placeholderText.classList.add('d-none');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }

    bindPrimaryPreview(primaryImageInput);

    primaryUploadButton.addEventListener('click', function() {
        const type = primaryTypeSelect.value;
        if (type === 'image') {
            primaryImageInput.click();
        }
        if (type === 'video') {
            primaryVideoInput.click();
        }
    });

    primaryTypeSelect.addEventListener('change', function() {
        setPrimaryTypeUI(this.value);
    });

    setPrimaryTypeUI(primaryTypeSelect.value);

    // Category Management
    const categorySelect = document.getElementById('category');
    const newCategoryInput = document.getElementById('newCategoryInput');
    const newCategoryField = newCategoryInput.querySelector('input');

    categorySelect.addEventListener('change', function() {
        if (this.value === 'other') {
            newCategoryInput.classList.remove('d-none');
            newCategoryField.focus();
        } else {
            newCategoryInput.classList.add('d-none');
            newCategoryField.value = '';
        }
    });

    // Form Submit Handler
    document.getElementById('portfolioForm').addEventListener('submit', function() {
        if (categorySelect.value === 'other' && newCategoryField.value.trim()) {
            const newValue = newCategoryField.value.trim();
            const option = new Option(newValue, newValue, true, true);
            categorySelect.add(option);
            categorySelect.value = newValue;
        }
    });

    // Technologies Management
    const techInput = document.getElementById('technologyInput');
    const addTechBtn = document.getElementById('addTechnology');
    const techContainer = document.getElementById('technologiesContainer');

    function addTechnology(value) {
        const tech = value.trim();
        if (tech) {
            const span = document.createElement('span');
            span.className = 'technology-tag';
            span.innerHTML = `
                ${tech}
                <input type="hidden" name="technologies[]" value="${tech}">
                <span class="remove">&times;</span>
            `;
            techContainer.appendChild(span);
            techInput.value = '';
            
            span.querySelector('.remove').addEventListener('click', function() {
                span.remove();
            });
        }
    }

    addTechBtn.addEventListener('click', function() {
        addTechnology(techInput.value);
    });

    techInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTechnology(this.value);
        }
    });

    // Add remove handlers for existing technology tags
    document.querySelectorAll('.technology-tag .remove').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
});
</script>
@endpush