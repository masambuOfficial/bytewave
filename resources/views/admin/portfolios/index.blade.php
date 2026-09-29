@extends('layouts.admin')

@section('title', 'Portfolio')

@push('styles')
<style>
    .portfolios-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .portfolios-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .portfolios-header p {
        color: #546270;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-portfolio {
        background: var(--bytewave-blue);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        white-space: nowrap;
    }

    .btn-add-portfolio:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .portfolios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .portfolio-card {
        background: #fff;
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .portfolio-card:hover {
        box-shadow: 0 12px 28px rgba(11, 31, 51, 0.1);
        transform: translateY(-3px);
    }

    .portfolio-media {
        position: relative;
    }

    .portfolio-image {
        height: 200px;
        width: 100%;
        object-fit: cover;
        display: block;
    }

    .portfolio-image-placeholder {
        height: 200px;
        background: var(--bytewave-blue-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .portfolio-image-placeholder.dark {
        background: #0B1F33;
    }

    .portfolio-image-placeholder i {
        font-size: 2.25rem;
        color: var(--bytewave-blue);
        opacity: 0.5;
    }

    .portfolio-image-placeholder.dark i {
        color: #fff;
        opacity: 0.6;
    }

    .category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(11, 31, 51, 0.65);
        backdrop-filter: blur(4px);
        color: #fff;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .portfolio-preview {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        color: var(--bytewave-blue-dark);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 0.8rem;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .portfolio-preview:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .portfolio-card-body {
        padding: 1.25rem 1.35rem 1.1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .portfolio-card-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .portfolio-card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: #0B1F33;
        margin: 0;
    }

    .portfolio-menu-btn {
        background: none;
        border: none;
        color: #546270;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .portfolio-menu-btn:hover {
        background: #F3F8FC;
        color: var(--bytewave-blue-dark);
    }

    .portfolio-card-text {
        color: #546270;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 0.9rem;
    }

    .technology-badge {
        display: inline-block;
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
        padding: 0.2rem 0.65rem;
        margin: 0 0.3rem 0.3rem 0;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .portfolio-meta {
        margin-top: auto;
        padding-top: 0.9rem;
        border-top: 1px solid #CDE3F1;
    }

    .portfolio-meta-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #546270;
        font-size: 0.82rem;
        margin-bottom: 0.4rem;
    }

    .portfolio-meta-row:last-child {
        margin-bottom: 0;
    }

    .portfolio-meta-row i {
        width: 16px;
        text-align: center;
        color: var(--bytewave-blue);
        opacity: 0.7;
    }

    .portfolios-empty {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border: 1px dashed #CDE3F1;
        border-radius: 16px;
    }

    .portfolios-empty i {
        font-size: 2.75rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .portfolios-empty p {
        color: #546270;
        margin-bottom: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="portfolios-header">
        <div>
            <h1>Portfolio</h1>
            <p>Manage the projects showcased on your website.</p>
        </div>
        <x-admin.button href="{{ route('admin.portfolios.create') }}">Add New Project</x-admin.button>
    </div>

    @if($portfolios->isEmpty())
        <div class="portfolios-empty">
            <i class="fas fa-project-diagram"></i>
            <p>No portfolio projects found.</p>
            <x-admin.button href="{{ route('admin.portfolios.create') }}">Add your first project</x-admin.button>
        </div>
    @else
        <div class="portfolios-grid">
            @foreach($portfolios as $portfolio)
                <div class="portfolio-card">
                    <div class="portfolio-media">
                        @php
                            $type = $portfolio->getPrimaryMediaType();
                            $src = $portfolio->primaryMediaPublicUrl();
                            $embedSrc = $portfolio->primaryEmbedSrc();
                            $embedThumb = $portfolio->primaryEmbedThumbnailUrl();
                        @endphp
                        @if($type === 'video' && $src)
                            <video class="portfolio-image" muted playsinline preload="metadata">
                                <source src="{{ $src }}" type="video/mp4">
                            </video>
                        @elseif($type === 'embed' && $embedThumb)
                            <img src="{{ $embedThumb }}" alt="{{ $portfolio->title }}" class="portfolio-image">
                        @elseif($type === 'embed' && $embedSrc)
                            <div class="portfolio-image-placeholder dark">
                                <i class="fas fa-link"></i>
                            </div>
                        @elseif($src)
                            <img src="{{ $src }}" alt="{{ $portfolio->title }}" class="portfolio-image">
                        @elseif($portfolio->hasImage())
                            <img src="{{ asset($portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="portfolio-image">
                        @else
                            <div class="portfolio-image-placeholder">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                        @endif

                        @if($portfolio->category)
                            <div class="category-badge">
                                <i class="fas fa-folder me-1"></i> {{ $portfolio->category }}
                            </div>
                        @endif

                        @if($portfolio->project_url)
                            <a href="{{ $portfolio->project_url }}"
                               target="_blank"
                               class="portfolio-preview"
                               title="View Project">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @endif
                    </div>

                    <div class="portfolio-card-body">
                        <div class="portfolio-card-title-row">
                            <h5 class="portfolio-card-title">{{ $portfolio->title }}</h5>
                            <div class="dropdown">
                                <button class="portfolio-menu-btn" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.portfolios.edit', $portfolio) }}">
                                            <i class="fas fa-edit fa-fw me-1"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('portfolios.show', $portfolio->slug) }}" target="_blank">
                                            <i class="fas fa-eye fa-fw me-1"></i> View
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.portfolios.destroy', $portfolio) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this project?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash fa-fw me-1"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <p class="portfolio-card-text">
                            {{ Str::limit($portfolio->description, 100) }}
                        </p>

                        @if($portfolio->technologies)
                            <div class="mb-2">
                                @foreach($portfolio->technologies as $tech)
                                    <span class="technology-badge">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="portfolio-meta">
                            @if($portfolio->client)
                                <div class="portfolio-meta-row">
                                    <i class="fas fa-building"></i>
                                    <span>{{ $portfolio->client }}</span>
                                </div>
                            @endif
                            @if($portfolio->completion_date)
                                <div class="portfolio-meta-row">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $portfolio->completion_date->format('F Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>
@endsection
