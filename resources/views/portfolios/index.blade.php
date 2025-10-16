@extends('layouts.app')

@section('title', 'Portfolio ')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Our Portfolio</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Portfolio</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Portfolio Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Work</h5>
                <h1 class="text-warning">Featured Projects & Success Stories</h1>
            </div>

            <!-- Portfolio Categories -->
            @if($portfolios->isNotEmpty() && $portfolios->pluck('category')->unique()->count() > 1)
            <div class="text-center mb-5">
                <div class="btn-group" role="group" aria-label="Portfolio categories">
                    <button type="button" class="btn btn-outline-primary active" data-filter="*">All</button>
                    @foreach($portfolios->pluck('category')->unique() as $category)
                        <button type="button" class="btn btn-outline-primary" data-filter=".{{ Str::slug($category) }}">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Portfolio Grid -->
            <div class="row g-4 portfolio-container">
                @forelse($portfolios as $portfolio)
                    <div class="col-lg-4 col-md-6 portfolio-item {{ Str::slug($portfolio->category) }} wow fadeIn" data-wow-delay=".3s">
                        <div class="portfolio-wrap">
                            <div class="portfolio-img position-relative overflow-hidden">
                                <img src="{{ asset($portfolio->image_url) }}" 
                                     class="img-fluid w-100" 
                                     alt="{{ $portfolio->title }}"
                                     style="height: 250px; object-fit: cover;">
                                <div class="portfolio-overlay">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <h5 class="text-white mb-2">{{ $portfolio->title }}</h5>
                                        <p class="text-white-50 mb-3">{{ $portfolio->category }}</p>
                                        <a href="{{ route('portfolios.show', $portfolio->slug) }}" 
                                           class="btn btn-warning text-white px-4 py-2 rounded-pill">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content p-4 bg-light">
                                <h4 class="mb-2">{{ $portfolio->title }}</h4>
                                <p class="mb-3">{{ Str::limit($portfolio->description, 100) }}</p>
                                @if($portfolio->technologies)
                                    <div class="technologies mb-3">
                                        @foreach($portfolio->technologies as $tech)
                                            <span class="badge bg-primary me-1">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $portfolio->completion_date->format('M Y') }}
                                    </span>
                                    <a href="{{ route('portfolios.show', $portfolio->slug) }}" class="text-primary">
                                        Learn More <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead">No portfolio items available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div>
    <!-- Portfolio End -->

    <!-- Call to Action Start -->
    <div class="container-fluid bg-primary py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <h1 class="mb-4 text-white">Ready to Start Your Project?</h1>
                    <p class="text-white mb-4">Let's discuss how we can help bring your vision to life. Our team is ready to deliver exceptional results for your business.</p>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('contact') }}" class="btn btn-light text-primary px-5 py-3 rounded-pill">Get Started</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->
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
    .btn-group .btn {
        border-radius: 30px;
        margin: 0 5px;
        padding: 8px 20px;
    }
    .technologies .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.75em;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize isotope for filtering
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });

    // Handle filter button clicks
    $('.btn-group .btn').on('click', function() {
        $('.btn-group .btn').removeClass('active');
        $(this).addClass('active');

        portfolioIsotope.isotope({
            filter: $(this).data('filter')
        });
    });
});
</script>
@endsection