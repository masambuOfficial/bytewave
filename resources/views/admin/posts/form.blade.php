@extends('layouts.admin')

@section('title', isset($post) ? 'Edit Blog Post' : 'Write New Blog Post')

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
    .ck-editor__editable {
        min-height: 300px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($post) ? 'Edit Blog Post' : 'Write New Blog Post' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ isset($post) ? route('admin.posts.update', $post) : route('admin.posts.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($post))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $post->title ?? '') }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug', $post->slug ?? '') }}" 
                                               required>
                                        <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">The slug will be used in the URL of your post</small>
                                </div>

                                <!-- Excerpt -->
                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" 
                                              name="excerpt" 
                                              rows="3">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" 
                                              name="content">{{ old('content', $post->content ?? '') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Image -->
                                <div class="mb-3">
                                    <label class="form-label">Featured Image</label>
                                    <div class="preview-wrapper mb-2">
                                        @if(isset($post) && $post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" 
                                                 alt="Featured Image Preview" 
                                                 class="image-preview" 
                                                 id="imagePreview">
                                        @else
                                            <div class="text-center text-muted" id="placeholderText">
                                                <i class="fas fa-image fa-3x mb-2"></i>
                                                <p class="mb-0">No image selected</p>
                                            </div>
                                            <img src="" 
                                                 alt="Featured Image Preview" 
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

                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                            id="category" 
                                            name="category">
                                        <option value="">Select Category</option>
                                        @foreach(['Technology', 'Business', 'Development', 'Security', 'Industry News', 'Tips & Tricks'] as $category)
                                            <option value="{{ $category }}" 
                                                {{ old('category', $post->category ?? '') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" 
                                           class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" 
                                           name="tags" 
                                           value="{{ old('tags', isset($post) && $post->tags ? $post->tags->pluck('name')->implode(', ') : '') }}"
                                           placeholder="Enter tags separated by commas">
                                    <small class="text-muted">Separate tags with commas (e.g., Technology, Web Development, Laravel)</small>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="status" 
                                               id="statusDraft" 
                                               value="draft" 
                                               {{ old('status', $post->status ?? 'draft') == 'draft' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusDraft">Draft</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="status" 
                                               id="statusPublished" 
                                               value="published" 
                                               {{ old('status', $post->status ?? 'draft') == 'published' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="statusPublished">Published</label>
                                    </div>
                                </div>

                                <!-- Meta Description -->
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" 
                                              name="meta_description" 
                                              rows="3"
                                              placeholder="Brief description for search engines">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <div>
                                @if(isset($post) && $post->status == 'draft')
                                    <button type="submit" 
                                            name="action" 
                                            value="save_draft" 
                                            class="btn btn-secondary me-2">
                                        <i class="fas fa-save"></i> Save Draft
                                    </button>
                                @endif
                                <button type="submit" 
                                        name="action" 
                                        value="publish" 
                                        class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> {{ isset($post) ? 'Update' : 'Publish' }} Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    // Slug Generation Function
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function(e) {
        if (!document.getElementById('slug').value) { // Only update if slug is empty
            document.getElementById('slug').value = generateSlug(e.target.value);
        }
    });

    // Manual slug generation button
    document.getElementById('generateSlug').addEventListener('click', function() {
        const title = document.getElementById('title').value;
        document.getElementById('slug').value = generateSlug(title);
    });

    // CKEditor
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'],
        })
        .then(editor => {
            window.editor = editor;

            // Handle form submission
            document.querySelector('form').addEventListener('submit', function(event) {
                // Get CKEditor content
                const content = editor.getData();
                
                // Update hidden textarea with content
                document.querySelector('#content').value = content;
                
                // Validate required fields
                const title = document.getElementById('title').value.trim();
                const slug = document.getElementById('slug').value.trim();
                
                if (!title || !slug || !content.trim()) {
                    event.preventDefault();
                    alert('Please fill in all required fields (Title, Slug, and Content)');
                }
            });
        })
        .catch(error => {
            console.error(error);
        });

    // Image Preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('d-none');
                document.getElementById('placeholderText').classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush