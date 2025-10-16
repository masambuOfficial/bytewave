@extends('layouts.app')

@section('title', $portfolio->title . ' - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">{{ $portfolio->title }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('portfolios.index') }}">Portfolio</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ $portfolio->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Details Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Project Image -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="position-relative">
                        <img src="{{ asset($portfolio->image_url) }}" 
                             class="img-fluid w-100 rounded" 
                             alt="{{ $portfolio->title }}"
                             style="max-height: 500px; object-fit: cover;">
                        @if($portfolio->project_url)
                            <a href="{{ $portfolio->project_url }}" 
                               target="_blank" 
                               class="btn btn-warning text-white position-absolute top-0 end-0 m-3 px-4 py-2 rounded-pill">
                                <i class="fas fa-external-link-alt me-2"></i>Visit Project
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Project Details -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <div class="h-100">
                        <h2 class="display-6 mb-4">{{ $portfolio->title }}</h2>
                        
                        <div class="row mb-4">
                            <div class="col-sm-6 mb-3">
                                <h6 class="text-primary">Client</h6>
                                <p class="mb-0">{{ $portfolio->client ?? 'Confidential' }}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <h6 class="text-primary">Completion Date</h6>
                                <p class="mb-0">{{ $portfolio->completion_date->format('F Y') }}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <h6 class="text-primary">Category</h6>
                                <p class="mb-0">{{ $portfolio->category }}</p>
                            </div>
                            @if($portfolio->technologies)
                            <div class="col-sm-6 mb-3">
                                <h6 class="text-primary">Technologies Used</h6>
                                <div class="technologies">
                                    @foreach($portfolio->technologies as $tech)
                                        <span class="badge bg-primary me-1 mb-1">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <h5 class="text-primary mb-3">Project Overview</h5>
                            <p class="lead mb-4">{{ $portfolio->description }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-primary mb-3">Work Done</h5>
                            <p>{{ $portfolio->work_done }}</p>
                        </div>

                        <div class="mt-5">
                            <h4 class="mb-3">Start Your Project with Us</h4>
                            <p class="text-muted">Interested in working with us? Let's discuss your project and create something amazing together.</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary text-white px-5 py-3 rounded-pill">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($relatedPortfolios->isNotEmpty())
            <!-- Related Projects Start -->
            <div class="related-projects mt-5 pt-5 border-top">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">More Projects</h5>
                    <h1 class="text-warning">Similar Projects</h1>
                </div>
                <div class="row g-4">
                    @foreach($relatedPortfolios as $relatedPortfolio)
                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".3s">
                            <div class="portfolio-wrap">
                                <div class="portfolio-img position-relative overflow-hidden">
                                    <img src="{{ asset($relatedPortfolio->image_url) }}" 
                                         class="img-fluid w-100" 
                                         alt="{{ $relatedPortfolio->title }}"
                                         style="height: 250px; object-fit: cover;">
                                    <div class="portfolio-overlay">
                                        <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                            <h5 class="text-white mb-2">{{ $relatedPortfolio->title }}</h5>
                                            <p class="text-white-50 mb-3">{{ $relatedPortfolio->category }}</p>
                                            <a href="{{ route('portfolios.show', $relatedPortfolio->slug) }}" 
                                               class="btn btn-warning text-white px-4 py-2 rounded-pill">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Related Projects End -->
            @endif

            <!-- Back to Portfolio -->
            <div class="text-center mt-5">
                <a href="{{ route('portfolios.index') }}" class="text-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Portfolio
                </a>
            </div>
        </div>
    </div>
    <!-- Portfolio Details End -->
@endsection

@section('styles')
<style>
    .page-header {
        background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat;
        background-size: cover;
    }
    .page-header .breadcrumb-item + .breadcrumb-item::before {
        color: var(--bs-white);
    }
    .portfolio-wrap {
        transition: all 0.3s ease;
    }
    .portfolio-wrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }
    .portfolio-img:hover .portfolio-overlay {
        opacity: 1;
    }
    .technologies .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.75em;
    }
</style>
@endsection
