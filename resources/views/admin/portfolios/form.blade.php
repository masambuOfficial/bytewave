@extends('layouts.admin')

@section('title', isset($portfolio) ? 'Edit Portfolio Project' : 'Create Portfolio Project')

@section('content')
<div class="container-fluid pf">
    <div class="pf-head">
        <div>
            <h1>{{ isset($portfolio) ? 'Edit project' : 'New project' }}</h1>
            <p>{{ isset($portfolio) ? 'Update how this project appears on the public portfolio.' : 'Add a project to the public portfolio.' }}</p>
        </div>
        <a href="{{ route('admin.portfolios.index') }}" class="pf-back">&larr; All projects</a>
    </div>

    <form action="{{ isset($portfolio) ? route('admin.portfolios.update', $portfolio) : route('admin.portfolios.store') }}"
          method="POST"
          enctype="multipart/form-data"
          id="portfolioForm">
        @csrf
        @if(isset($portfolio))
            @method('PUT')
        @endif

        <div class="row g-4">
            <div class="col-lg-8">

                <!-- Basics -->
                <div class="pf-panel">
                    <h2 class="pf-panel__title">Basics</h2>

                    <div class="mb-field">
                        <label for="title" class="form-label">Project title <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title', $portfolio->title ?? '') }}"
                               placeholder="e.g. HESFB 8 Years Impact Magazine"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-field">
                        <label for="project_type" class="form-label">Project type</label>
                        <select class="form-select @error('project_type') is-invalid @enderror" id="project_type" name="project_type">
                            @foreach(\App\Models\Portfolio::TYPES as $value => $label)
                                <option value="{{ $value }}" {{ old('project_type', $portfolio->project_type ?? 'ict') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <span class="hint">Multimedia projects lead with the gallery and relabel technologies as tools &amp; equipment.</span>
                        @error('project_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-field">
                        <label for="description" class="form-label">Summary <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="A short overview of the project"
                                  required>{{ old('description', $portfolio->description ?? '') }}</textarea>
                        <span class="hint">Shown on the portfolio cards and as the intro on the project page. The full story goes in the case study.</span>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Project details -->
                <div class="pf-panel">
                    <h2 class="pf-panel__title">Details</h2>
                    <div class="row g-3 mb-field">
                        <div class="col-md-6">
                            <label for="client" class="form-label">Client</label>
                            @php $currentClient = old('client', $portfolio->client ?? ''); @endphp
                            <select class="form-select @error('client') is-invalid @enderror" id="client" name="client">
                                <option value="">Confidential / none</option>
                                @if($currentClient !== '' && !$clients->contains($currentClient))
                                    <option value="{{ $currentClient }}" selected>{{ $currentClient }} (not in clients)</option>
                                @endif
                                @foreach($clients as $clientName)
                                    <option value="{{ $clientName }}" {{ $currentClient === $clientName ? 'selected' : '' }}>{{ $clientName }}</option>
                                @endforeach
                            </select>
                            @error('client')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="completion_date" class="form-label">Completion date</label>
                            <input type="date"
                                   class="form-control @error('completion_date') is-invalid @enderror"
                                   id="completion_date"
                                   name="completion_date"
                                   placeholder="Select date"
                                   value="{{ old('completion_date', isset($portfolio) && $portfolio->completion_date ? $portfolio->completion_date->format('Y-m-d') : '') }}">
                            @error('completion_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-field">
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

                <!-- Case Study -->
                @php
                    $highlights = old('highlights', $portfolio->highlights ?? []);
                    $steps = old('process_steps', $portfolio->process_steps ?? []);
                    $csFilled = collect([
                        old('challenge', $portfolio->challenge ?? ''),
                        old('solution', $portfolio->solution ?? ''),
                        old('results', $portfolio->results ?? ''),
                        old('testimonial', $portfolio->testimonial ?? ''),
                    ])->filter()->count() + (int) !empty($highlights) + (int) !empty($steps);
                @endphp
                <div class="pf-panel">
                    <h2 class="pf-panel__title">
                        <span>Case study</span>
                        <span class="badge rounded-pill" id="caseStudyCount">{{ $csFilled }} of 6 sections filled</span>
                    </h2>
                    <div id="caseStudyFields">
                        <p class="hint mb-3 mt-0">Fill in at least the <strong>Challenge</strong> and <strong>Solution</strong> to publish this as a full case study. Empty sections are hidden on the public page.</p>

                        <div class="pf-sub">
                            <label for="challenge" class="form-label">The challenge</label>
                            <textarea class="form-control cs-field" id="challenge" name="challenge" rows="3"
                                      placeholder="What problem or need did the client have? Why did it matter?">{{ old('challenge', $portfolio->challenge ?? '') }}</textarea>
                        </div>

                        <div class="pf-sub">
                            <label for="solution" class="form-label">Our solution</label>
                            <textarea class="form-control cs-field" id="solution" name="solution" rows="3"
                                      placeholder="How did we approach and solve it?">{{ old('solution', $portfolio->solution ?? '') }}</textarea>
                        </div>

                        <div class="pf-sub">
                            <div class="pf-sub__head">
                                <label class="form-label">Key highlights</label>
                                <button type="button" id="addHighlight" class="pf-link-btn">+ Add highlight</button>
                            </div>
                            <span class="hint mb-2 mt-0">Short facts shown as a stat strip, e.g. value "UGX 28bn", label "National infrastructure investment".</span>
                            <div id="highlightRows">
                                @foreach($highlights as $i => $h)
                                    <div class="input-group mb-2 repeat-row">
                                        <input type="text" class="form-control" style="max-width: 10rem" name="highlights[{{ $i }}][value]" value="{{ $h['value'] ?? '' }}" placeholder="Value" maxlength="50">
                                        <input type="text" class="form-control" name="highlights[{{ $i }}][label]" value="{{ $h['label'] ?? '' }}" placeholder="Label" maxlength="100">
                                        <button type="button" class="btn btn-outline-secondary remove-row" aria-label="Remove">&times;</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pf-sub">
                            <div class="pf-sub__head">
                                <label class="form-label">How we did it</label>
                                <button type="button" id="addStep" class="pf-link-btn">+ Add step</button>
                            </div>
                            <span class="hint mb-2 mt-0">One row per step, in order. Each step has a short <strong>name</strong> and a one- or two-sentence <strong>description</strong>; the public page shows them as a numbered timeline. Example: <em>Planning</em> &mdash; Met the client's team on 6 January to agree the programme.</span>
                            <div id="stepRows">
                                @foreach($steps as $i => $step)
                                    <div class="border rounded p-2 mb-2 repeat-row">
                                        <div class="input-group mb-2">
                                            <span class="input-group-text step-num">{{ $loop->iteration }}</span>
                                            <input type="text" class="form-control" name="process_steps[{{ $i }}][title]" value="{{ $step['title'] ?? '' }}" placeholder="Step name, e.g. Planning" maxlength="150">
                                            <button type="button" class="btn btn-outline-secondary remove-row" aria-label="Remove step">&times;</button>
                                        </div>
                                        <textarea class="form-control" name="process_steps[{{ $i }}][description]" rows="2" placeholder="Short description, e.g. Met the client's team to agree the programme and what the stream must show.">{{ $step['description'] ?? '' }}</textarea>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pf-sub">
                            <label for="results" class="form-label">Results</label>
                            <textarea class="form-control cs-field" id="results" name="results" rows="3"
                                      placeholder="What changed for the client? Use real numbers only where we have them.">{{ old('results', $portfolio->results ?? '') }}</textarea>
                        </div>

                        <div class="pf-sub">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="testimonial" class="form-label">Client quote</label>
                                    <textarea class="form-control cs-field" id="testimonial" name="testimonial" rows="2">{{ old('testimonial', $portfolio->testimonial ?? '') }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="testimonial_author" class="form-label">Quote author</label>
                                    <input type="text" class="form-control" id="testimonial_author" name="testimonial_author" value="{{ old('testimonial_author', $portfolio->testimonial_author ?? '') }}" placeholder="Name, role">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <details class="pf-panel pf-details" {{ $errors->has('meta_description') || old('meta_description', $portfolio->meta_description ?? '') ? 'open' : '' }}>
                    <summary class="pf-panel__title mb-0">
                        <span>SEO <span style="text-transform:none;letter-spacing:0;font-weight:500;color:#546270">(optional)</span></span>
                    </summary>
                    <div class="mt-3">
                        <label for="meta_description" class="form-label">Meta description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                  id="meta_description"
                                  name="meta_description"
                                  rows="2"
                                  maxlength="320"
                                  placeholder="Shown in Google search results. Aim for 120-160 characters. Leave blank to use the start of the summary.">{{ old('meta_description', $portfolio->meta_description ?? '') }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </details>
            </div>

            <div class="col-lg-4">
                <div class="pf-side">

                    <!-- Media -->
                    <div class="pf-panel">
                        <h2 class="pf-panel__title">Media</h2>

                        @php
                            $selectedType = old('primary_media_type', $portfolio->primary_media_type ?? 'image');
                            $primaryType = isset($portfolio) ? ($portfolio->primary_media_type ?? null) : null;
                            $primaryPath = isset($portfolio) ? ($portfolio->getRawOriginal('primary_media_path') ?? null) : null;
                            $legacyPath = isset($portfolio) ? ($portfolio->getRawOriginal('image_url') ?? null) : null;
                            $imageToShow = $primaryType === 'image' && $primaryPath ? ('storage/' . $primaryPath) : ($legacyPath ? ('storage/' . $legacyPath) : null);
                        @endphp

                        <div class="mb-field">
                            <label for="primary_media_type" class="form-label">Main media</label>
                            <select class="form-select mb-2 @error('primary_media_type') is-invalid @enderror" id="primary_media_type" name="primary_media_type">
                                <option value="image" {{ $selectedType === 'image' ? 'selected' : '' }}>Image upload</option>
                                <option value="video" {{ $selectedType === 'video' ? 'selected' : '' }}>Video upload</option>
                                <option value="embed" {{ $selectedType === 'embed' ? 'selected' : '' }}>Embed (YouTube/Vimeo/iframe)</option>
                            </select>
                            @error('primary_media_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="preview-wrapper mb-2" id="primaryImagePreviewWrapper">
                                @if(isset($portfolio) && $imageToShow)
                                    <img src="{{ asset($imageToShow) }}"
                                         alt="Project Media Preview"
                                         class="image-preview"
                                         id="imagePreview">
                                @else
                                    <div class="text-center" id="placeholderText">
                                        <i class="fas fa-image mb-2"></i>
                                        <p class="mb-0 small">No media selected</p>
                                    </div>
                                    <img src=""
                                         alt="Project Media Preview"
                                         class="image-preview d-none"
                                         id="imagePreview">
                                @endif
                                <div class="preview-overlay">
                                    <x-admin.button type="button" id="primaryUploadButton" variant="secondary">Change media</x-admin.button>
                                </div>
                            </div>

                            <input type="file" class="form-control d-none @error('primary_image') is-invalid @enderror" id="primary_image" name="primary_image" accept="image/*">
                            @error('primary_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="file" class="form-control d-none @error('primary_video') is-invalid @enderror" id="primary_video" name="primary_video" accept="video/mp4,video/webm,video/quicktime">
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

                            <span class="hint" id="primaryHelpText">Image max size: 2MB. Video max size: 50MB.</span>
                        </div>

                        <div class="mb-field">
                            <label for="gallery_uploads" class="form-label">Gallery <span class="text-muted fw-normal">(optional)</span></label>
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
                                      rows="3"
                                      placeholder="Embed URLs or iframes, one per line">{{ old('gallery_embeds') }}</textarea>
                            @error('gallery_embeds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Organise -->
                    <div class="pf-panel">
                        <h2 class="pf-panel__title">Organise</h2>

                        <div class="mb-field">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror"
                                    id="category"
                                    name="category">
                                <option value="">Select category</option>
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

                        <div class="mb-field">
                            <label for="technologyInput" class="form-label" id="technologiesLabel">Technologies used</label>
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       id="technologyInput"
                                       placeholder="Add technology">
                                <button class="btn btn-primary"
                                        type="button"
                                        id="addTechnology"
                                        aria-label="Add">
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
            </div>
        </div>

        <div class="pf-actions">
            <a href="{{ route('admin.portfolios.index') }}" class="pf-back">Cancel</a>
            <x-admin.button type="submit">{{ isset($portfolio) ? 'Update' : 'Create' }} project</x-admin.button>
        </div>
    </form>
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

    // Project type relabels technologies
    const typeSelect = document.getElementById('project_type');
    const techLabel = document.getElementById('technologiesLabel');
    function applyProjectType() {
        const multimedia = typeSelect.value === 'multimedia';
        techLabel.textContent = multimedia ? 'Tools & Equipment' : 'Technologies Used';
        techInput.placeholder = multimedia ? 'Add tool or equipment' : 'Add technology';
    }
    typeSelect.addEventListener('change', applyProjectType);
    applyProjectType();

    // Repeatable highlight / step rows
    const caseStudyFields = document.getElementById('caseStudyFields');
    const highlightRows = document.getElementById('highlightRows');
    const stepRows = document.getElementById('stepRows');
    let rowIndex = Date.now();

    function updateCaseStudyCount() {
        let filled = 0;
        document.querySelectorAll('.cs-field').forEach(function(el) { if (el.value.trim()) filled++; });
        if ([...highlightRows.querySelectorAll('input')].some(i => i.value.trim())) filled++;
        if ([...stepRows.querySelectorAll('input, textarea')].some(i => i.value.trim())) filled++;
        document.getElementById('caseStudyCount').textContent = filled + ' of 6 sections filled';
    }

    document.getElementById('addHighlight').addEventListener('click', function() {
        const i = rowIndex++;
        highlightRows.insertAdjacentHTML('beforeend', `
            <div class="input-group mb-2 repeat-row">
                <input type="text" class="form-control" style="max-width: 10rem" name="highlights[${i}][value]" placeholder="Value" maxlength="50">
                <input type="text" class="form-control" name="highlights[${i}][label]" placeholder="Label" maxlength="100">
                <button type="button" class="btn btn-outline-secondary remove-row" aria-label="Remove">&times;</button>
            </div>`);
    });

    function numberSteps() {
        stepRows.querySelectorAll('.step-num').forEach((el, n) => { el.textContent = n + 1; });
    }

    document.getElementById('addStep').addEventListener('click', function() {
        const i = rowIndex++;
        stepRows.insertAdjacentHTML('beforeend', `
            <div class="border rounded p-2 mb-2 repeat-row">
                <div class="input-group mb-2">
                    <span class="input-group-text step-num"></span>
                    <input type="text" class="form-control" name="process_steps[${i}][title]" placeholder="Step name, e.g. Planning" maxlength="150">
                    <button type="button" class="btn btn-outline-secondary remove-row" aria-label="Remove step">&times;</button>
                </div>
                <textarea class="form-control" name="process_steps[${i}][description]" rows="2" placeholder="Short description, e.g. Met the client's team to agree the programme and what the stream must show."></textarea>
            </div>`);
        numberSteps();
    });

    caseStudyFields.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-row');
        if (btn) {
            btn.closest('.repeat-row').remove();
            numberSteps();
            updateCaseStudyCount();
        }
    });
    caseStudyFields.addEventListener('input', updateCaseStudyCount);

    // Add remove handlers for existing technology tags
    document.querySelectorAll('.technology-tag .remove').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
});
</script>
@endpush