@extends('layouts.app')

@section('title', 'BYTEWAVE - Innovative IT Solutions')

@section('content')

    <!-- Hero Carousel -->
    <div class="hero-carousel-container">
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-image-container">
                        <img src="{{ asset('css/img/bg-1.jpg') }}" class="d-block w-100" alt="IT Solutions">
                        <div class="carousel-overlay"></div>
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center">
                        <div class="container">
                            <span class="carousel-subtitle">Best IT Solutions</span>
                            <h1 class="carousel-title">An Innovative IT Solutions Agency</h1>
                            <p class="carousel-text">We deliver cutting-edge IT solutions tailored to your unique needs, driving innovation and growth.</p>
                            <div class="carousel-buttons">
                                <a href="{{ url('services') }}" class="btn btn-warning btn-lg me-2">Our Services</a>
                                <a href="{{ url('contact') }}" class="btn btn-primary btn-lg ms-2">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-image-container">
                    <img src="{{ asset('css/img/bg-2.jpg') }}" class="d-block w-100" alt="Digital Services">
                        <div class="carousel-overlay"></div>
                    </div>
                    <div class="carousel-caption d-flex flex-column justify-content-center">
                        <div class="container">
                            <span class="carousel-subtitle">Quality Digital Services</span>
                            <h1 class="carousel-title">Driving Your Business Forward with Digital Excellence!</h1>
                            <p class="carousel-text">Experience digital services that transform your business, enhance efficiency, and unlock new opportunities.</p>
                            <div class="carousel-buttons">
                                <a href="{{ url('products') }}" class="btn btn-warning btn-lg me-2">Our products</a>
                                <a href="{{ url('portfolio') }}" class="btn btn-primary btn-lg ms-2">Our portfolio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="pe-lg-4">
                        <span class="section-subtitle">Why Choose Us</span>
                        <h2 class="section-title mb-4">We're Here To Grow Your Business Exponentially</h2>
                        <p class="mb-4">We combine technical expertise with business acumen to deliver solutions that drive real results. Our team of experts is passionate about helping businesses succeed in the digital age.</p>
                        
                        <div class="skill-item mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Digital Strategy</span>
                                <span>95%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0" data-width="95%"></div>
                            </div>
                        </div>
                        
                        <div class="skill-item mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Technical Excellence</span>
                                <span>90%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0" data-width="90%"></div>
                            </div>
                        </div>
                        
                        <div class="skill-item">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Project Success Rate</span>
                                <span>95%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0" data-width="95%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image-container position-relative">
                        <img src="{{ asset('css/img/20210430_151808.jpg') }}" alt="Why Choose Us" class="img-fluid rounded">
                        <div class="about-image-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="section-subtitle">Latest Projects</span>
                <h2 class="section-title">Explore Our Recent Work</h2>
            </div>
            <div class="row g-4">
                @foreach($latestPortfolios ?? [] as $portfolio)
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-card">
                        <div class="portfolio-image-container">
                            <img src="{{ asset($portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="img-fluid">
                            <div class="portfolio-overlay">
                                <a href="{{ asset($portfolio->image_url) }}" class="portfolio-icon" data-lightbox="portfolio">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('portfolios.show', $portfolio->slug) }}" class="portfolio-icon">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portfolio-content">
                            <span class="portfolio-category">{{ $portfolio->category }}</span>
                            <h4 class="portfolio-title">{{ $portfolio->title }}</h4>
                            <p class="portfolio-description">{{ Str::limit($portfolio->description, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('portfolios.index') }}" class="btn btn-warning btn-lg px-4 py-2">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- Latest News & Articles Section -->
    @if($heroArticle || $latestPosts->count() > 0)
    <section class="bg-gray-50 py-5">
        <div class="container mx-auto px-4">
            <div class="section-header text-center mb-5">
                <span class="section-subtitle">Stay Updated</span>
                <h2 class="section-title">Latest News & Articles</h2>
                <p class="text-gray-600 mt-2">Discover the latest insights, trends, and updates from the tech world</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                @if($heroArticle)
                <div class="lg:col-span-2">
                    <x-blog.hero-article :article="$heroArticle" />
                </div>
                @endif
                
                @if($latestPosts->count() > 0)
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Latest Posts</h3>
                    @foreach($latestPosts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="block group">
                            <div class="flex space-x-3 bg-white p-3 rounded-lg hover:shadow-md transition-shadow">
                                <img 
                                    src="{{ $post->cover_image }}" 
                                    alt="{{ $post->title }}"
                                    class="w-24 h-24 object-cover rounded-lg flex-shrink-0"
                                >
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 text-sm">
                                        {{ $post->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $post->published_at?->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
            
            <div class="text-center">
                <a href="{{ route('blog.index') }}" class="btn btn-warning btn-lg px-4 py-2">
                    View All Articles →
                </a>
            </div>
        </div>
    </section>
    @endif
    
    <!-- Call to Action -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="cta-container bg-primary rounded p-4 p-lg-5">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="cta-item d-flex align-items-center">
                            <div class="cta-icon bg-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-phone-alt text-primary"></i>
                            </div>
                            <div class="cta-content ms-4">
                                <p class="mb-1 text-white">Call Us Now</p>
                                <h3 class="mb-0 text-white">0773448069</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cta-item d-flex align-items-center">
                            <div class="cta-icon bg-white rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fas fa-envelope-open text-primary"></i>
                            </div>
                            <div class="cta-content ms-4">
                                <p class="mb-1 text-white">Mail Us Now</p>
                                <h3 class="mb-0"><a href="mailto:info@bytewaveinvestments.com" class="text-white text-decoration-none">info@bytewaveinvestments.com</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    /* Variables */
    :root {
        --primary: #0d6efd;
        --secondary: #6c757d;
        --warning: #ffc107;
        --dark: #212529;
        --light: #f8f9fa;
        --transition: all 0.3s ease;
    }

    /* Base Styles */
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    h1, h2, h3, h4, h5, h6 {
        font-weight: 700;
        line-height: 1.2;
    }

    .section-header {
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .section-subtitle {
        display: inline-block;
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--dark);
        position: relative;
    }

    /* Hero Carousel */
    .hero-carousel-container {
        position: relative;
        overflow: hidden;
    }

    .carousel-image-container {
        position: relative;
        height: 100vh;
        min-height: 500px;
    }

    .carousel-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }

    .carousel-caption {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        padding: 0;
    }

    .carousel-subtitle {
        display: block;
        color: var(--warning);
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    .carousel-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: white;
        line-height: 1.2;
    }

    .carousel-text {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .carousel-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .carousel-buttons .btn {
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: var(--transition);
    }

    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 8px;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        transition: var(--transition);
    }

    .carousel-indicators .active {
        background-color: var(--warning);
        width: 30px;
        border-radius: 6px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        top: 80%;
        transform: translateY(-50%);
        opacity: 1;
        transition: var(--transition);
    }

    .carousel-control-prev {
        left: 20px;
    }

    .carousel-control-next {
        right: 20px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: var(--primary);
    }

    /* Services Section */
    .services-section {
        background-color: white;
    }

    .service-card {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .service-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: white;
        font-size: 1.75rem;
    }

    .service-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--dark);
    }

    .service-description {
        color: #666;
        margin-bottom: 1.5rem;
    }

    .service-link {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--transition);
    }

    .service-link:hover {
        color: var(--dark);
    }

    /* Why Choose Us Section */
    .why-choose-us {
        background-color: var(--light);
    }

    .about-image-container {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .about-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(13, 110, 253, 0.1), rgba(13, 110, 253, 0.3));
    }

    .skill-item {
        margin-bottom: 1.5rem;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
        background-color: rgba(13, 110, 253, 0.1);
    }

    .progress-bar {
        border-radius: 4px;
        transition: width 1.5s ease;
    }

    /* Portfolio Section */
    .portfolio-card {
        border-radius: 10px;
        overflow: hidden;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        height: 100%;
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .portfolio-image-container {
        position: relative;
        overflow: hidden;
    }

    .portfolio-image-container img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: var(--transition);
    }

    .portfolio-card:hover .portfolio-image-container img {
        transform: scale(1.05);
    }

    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(13, 110, 253, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }

    .portfolio-icon {
        width: 45px;
        height: 45px;
        background: white;
        color: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 10px;
        transition: var(--transition);
    }

    .portfolio-icon:hover {
        background: var(--dark);
        color: white;
    }

    .portfolio-content {
        padding: 1.5rem;
    }

    .portfolio-category {
        display: inline-block;
        color: var(--primary);
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .portfolio-title {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: var(--dark);
    }

    .portfolio-description {
        color: #666;
        margin-bottom: 0;
    }

    /* CTA Section */
    .cta-container {
        background: linear-gradient(135deg, var(--primary), #0b5ed7);
        color: white;
    }

    .cta-item {
        padding: 1rem;
    }

    .cta-icon {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
    }

    .cta-content p {
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .cta-content h3 {
        font-size: 1.5rem;
        margin-bottom: 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 1199.98px) {
        .carousel-title {
            font-size: 3rem;
        }
    }

    @media (max-width: 991.98px) {
        .carousel-title {
            font-size: 2.5rem;
        }
        
        .carousel-text {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 767.98px) {
        .carousel-image-container {
            min-height: 400px;
        }
        
        .carousel-title {
            font-size: 2rem;
        }
        
        .carousel-text {
            font-size: 1rem;
        }
        
        .carousel-buttons .btn {
            padding: 0.5rem 1.5rem;
            font-size: 0.875rem;
        }
        
        .section-title {
            font-size: 1.75rem;
        }
        
        .cta-content h3 {
            font-size: 1.25rem;
        }
        
        .portfolio-image-container img {
            height: 200px;
        }
    }

    @media (max-width: 575.98px) {
        .carousel-title {
            font-size: 1.75rem;
        }
        
        .carousel-subtitle {
            font-size: 1rem;
        }
        
        .carousel-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .carousel-buttons .btn {
            width: 100%;
            max-width: 250px;
        }
        
        .cta-item {
            flex-direction: column;
            text-align: center;
        }
        
        .cta-icon {
            margin-bottom: 1rem;
            margin-right: 0;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars when scrolled into view
        const animateProgressBars = () => {
            const progressBars = document.querySelectorAll('.progress-bar');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const width = entry.target.getAttribute('data-width');
                        entry.target.style.width = width;
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            progressBars.forEach(bar => observer.observe(bar));
        };
        
        // Initialize lightbox for portfolio images
        const initLightbox = () => {
            if (typeof lightbox !== 'undefined') {
                lightbox.option({
                    'resizeDuration': 200,
                    'wrapAround': true,
                    'showImageNumberLabel': false
                });
            }
        };
        
        // Smooth scrolling for anchor links
        const smoothScroll = () => {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        };
        
        // Initialize all functions
        animateProgressBars();
        initLightbox();
        smoothScroll();
        
        // Add animation to elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.service-card, .portfolio-card, .cta-container');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            elements.forEach(el => observer.observe(el));
        };
        
        animateOnScroll();
    });
</script>
@endsection