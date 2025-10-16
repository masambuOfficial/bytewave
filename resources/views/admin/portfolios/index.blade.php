@extends('layouts.admin')

@section('title', 'Portfolio')

@push('styles')
<style>
    .portfolio-card {
        transition: transform 0.2s;
    }
    .portfolio-card:hover {
        transform: translateY(-5px);
    }
    .portfolio-image {
        height: 250px;
        object-fit: cover;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }
    .action-buttons {
        transition: opacity 0.2s;
        opacity: 0;
    }
    .portfolio-card:hover .action-buttons {
        opacity: 1;
    }
    .category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.875rem;
    }
    .technology-badge {
        display: inline-block;
        background: #e9ecef;
        padding: 2px 8px;
        margin: 2px;
        border-radius: 12px;
        font-size: 0.75rem;
    }
    .portfolio-preview {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: background 0.2s;
    }
    .portfolio-preview:hover {
        background: rgba(0, 0, 0, 0.9);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Portfolio</h1>
        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Project
        </a>
    </div>

    @if($portfolios->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-project-diagram fa-4x text-muted mb-3"></i>
            <p class="text-muted">No portfolio projects found.</p>
            <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
                Add your first project
            </a>
        </div>
    @else
        <div class="row">
            @foreach($portfolios as $portfolio)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow portfolio-card h-100">
                        <div class="position-relative">
                            @if($portfolio->hasImage())
                                <img src="{{ asset($portfolio->image_url) }}" 
                                     alt="{{ $portfolio->title }}" 
                                     class="portfolio-image w-100">
                            @else
                                <div class="portfolio-image bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-project-diagram fa-3x text-muted"></i>
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
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $portfolio->title }}</h5>
                                <div class="dropdown">
                                    <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown">
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

                            <p class="card-text text-muted mb-3">
                                {{ Str::limit($portfolio->description, 100) }}
                            </p>
                            
                            @if($portfolio->technologies)
                                <div class="mb-3">
                                    @foreach($portfolio->technologies as $tech)
                                        <span class="technology-badge">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-3 pt-3 border-top">
                                @if($portfolio->client)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-building text-muted fa-fw me-2"></i>
                                        <span class="text-muted">{{ $portfolio->client }}</span>
                                    </div>
                                @endif
                                @if($portfolio->completion_date)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-muted fa-fw me-2"></i>
                                        <span class="text-muted">{{ $portfolio->completion_date->format('F Y') }}</span>
                                    </div>
                                @endif
                            </div>
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