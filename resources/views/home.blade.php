@extends('layouts.app')

@section('title', 'BYTEWAVE - Innovative IT Solutions')

@section('content')

    <!-- Hero Carousel - Alpine.js + Tailwind CSS -->
    <div x-data="{
        currentSlide: 0,
        slides: [
            {
                image: '{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}',
                subtitle: 'Best IT Solutions',
                title: 'An Innovative IT Solutions Agency',
                description: 'We deliver cutting-edge IT solutions tailored to your unique needs, driving innovation and growth.',
                buttons: [
                    { text: 'Our Services', url: '{{ url('services') }}', primary: true },
                    { text: 'Contact Us', url: '{{ url('contact') }}', primary: false }
                ]
            },
            {
                image: '{{ asset('css/img/gavin_in_the_field-01.jpg') }}',
                subtitle: 'Quality Digital Services',
                title: 'Driving Your Business Forward with Digital Excellence!',
                description: 'Experience digital services that transform your business, enhance efficiency, and unlock new opportunities.',
                buttons: [
                    { text: 'Our products', url: '{{ url('products') }}', primary: true },
                    { text: 'Our portfolio', url: '{{ url('portfolio') }}', primary: false }
                ]
            }
        ],
        autoplayInterval: null,
        init() {
            this.startAutoplay();
        },
        startAutoplay() {
            this.autoplayInterval = setInterval(() => {
                this.next();
            }, 8000);
        },
        stopAutoplay() {
            clearInterval(this.autoplayInterval);
        },
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        prev() {
            this.currentSlide = this.currentSlide === 0 ? this.slides.length - 1 : this.currentSlide - 1;
        },
        goToSlide(index) {
            this.currentSlide = index;
            this.stopAutoplay();
            this.startAutoplay();
        }
    }" 
    @mouseenter="stopAutoplay()" 
    @mouseleave="startAutoplay()"
    class="relative overflow-hidden h-screen min-h-[500px]">
        
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index"
                 x-transition:enter="transition ease-in-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in-out duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0">
                
                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center" :style="`background-image: url('${slide.image}')`"></div>
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-black/60"></div>
                
                <!-- Content -->
                <div class="relative h-full flex flex-col justify-center items-center text-center z-10">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <span class="inline-block text-bytewave-gold text-lg md:text-xl font-semibold uppercase mb-4 tracking-wide" x-text="slide.subtitle"></span>
                        <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white mb-6 leading-tight" x-text="slide.title"></h1>
                        <p class="text-lg md:text-xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed" x-text="slide.description"></p>
                        
                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                            <template x-for="(button, btnIndex) in slide.buttons" :key="btnIndex">
                                <a :href="button.url" 
                                   :class="button.primary ? 
                                       'bg-bytewave-gold text-white hover:bg-bytewave-gold-600' : 
                                       'bg-white text-bytewave-blue hover:bg-bytewave-blue hover:text-white'"
                                   class="inline-block font-semibold px-8 py-3 rounded-full transition-all duration-300 hover:scale-105 shadow-lg"
                                   x-text="button.text">
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
        <!-- Indicators (Vertical on Right) -->
        <div class="absolute right-8 top-1/2 -translate-y-1/2 flex flex-col gap-3 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goToSlide(index)" 
                        :class="currentSlide === index ? 'h-12 bg-bytewave-gold' : 'h-3 bg-white/50 hover:bg-white/75'"
                        class="w-3 rounded-full transition-all duration-300">
                </button>
            </template>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="lg:pr-8">
                    <span class="inline-block text-bytewave-blue font-semibold mb-4 uppercase tracking-wider text-base">Why Choose Us</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">We're Here To Grow Your Business Exponentially</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">We combine technical expertise with business acumen to deliver solutions that drive real results. Our team of experts is passionate about helping businesses succeed in the digital age.</p>
                    
                    <div class="space-y-6">
                        <div class="skill-item">
                            <div class="flex justify-between mb-2">
                                <span class="font-medium text-gray-700">Digital Strategy</span>
                                <span class="font-semibold text-bytewave-blue">95%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="progress-bar bg-bytewave-blue h-full rounded-full transition-all duration-1000 ease-out" style="width: 0" data-width="95%"></div>
                            </div>
                        </div>
                        
                        <div class="skill-item">
                            <div class="flex justify-between mb-2">
                                <span class="font-medium text-gray-700">Technical Excellence</span>
                                <span class="font-semibold text-bytewave-blue">90%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="progress-bar bg-bytewave-blue h-full rounded-full transition-all duration-1000 ease-out" style="width: 0" data-width="90%"></div>
                            </div>
                        </div>
                        
                        <div class="skill-item">
                            <div class="flex justify-between mb-2">
                                <span class="font-medium text-gray-700">Project Success Rate</span>
                                <span class="font-semibold text-bytewave-blue">95%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="progress-bar bg-bytewave-blue h-full rounded-full transition-all duration-1000 ease-out" style="width: 0" data-width="95%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="relative rounded-lg overflow-hidden shadow-2xl">
                        <img src="{{ asset('css/img/bytewave_livestreaming.jpg') }}" alt="Why Choose Us" class="w-full h-auto rounded-lg">
                        <div class="absolute inset-0 bg-gradient-to-b from-bytewave-blue/10 to-bytewave-blue/30"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 max-w-3xl mx-auto">
                <span class="inline-block text-bytewave-blue font-semibold mb-4 uppercase tracking-wider text-base">Latest Projects</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Explore Our Recent Work</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($latestPortfolios ?? [] as $portfolio)
                <div class="group">
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 h-full">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset($portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-bytewave-blue/80 flex items-center justify-center gap-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ asset($portfolio->image_url) }}" class="w-12 h-12 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-gray-900 hover:text-white transition-colors duration-300" data-lightbox="portfolio">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('portfolios.show', $portfolio->slug) }}" class="w-12 h-12 bg-white text-bytewave-blue rounded-full flex items-center justify-center hover:bg-gray-900 hover:text-white transition-colors duration-300">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block text-bytewave-blue text-sm font-semibold mb-2">{{ $portfolio->category }}</span>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">{{ $portfolio->title }}</h4>
                            <p class="text-gray-600 leading-relaxed">{{ Str::limit($portfolio->description, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('portfolios.index') }}" class="inline-block bg-bytewave-gold text-white font-semibold px-8 py-3 rounded-full hover:bg-bytewave-gold-600 transition-all duration-300 hover:scale-105 shadow-lg">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- Latest News & Articles Section -->
    @if($heroArticle || $latestPosts->count() > 0)
    <section class="bg-gray-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 max-w-3xl mx-auto">
                <span class="inline-block text-bytewave-blue font-semibold mb-4 uppercase tracking-wider text-base">Stay Updated</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest News & Articles</h2>
                <p class="text-gray-600">Discover the latest insights, trends, and updates from the tech world</p>
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
                                    <h4 class="font-semibold text-gray-900 group-hover:text-bytewave-blue transition-colors line-clamp-2 text-sm">
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
                <a href="{{ route('blog.index') }}" class="inline-block bg-bytewave-gold text-white font-semibold px-8 py-3 rounded-full hover:bg-bytewave-gold-600 transition-all duration-300 hover:scale-105 shadow-lg">
                    View All Articles →
                </a>
            </div>
        </div>
    </section>
    @endif
    
    <!-- Our Clients Section -->
    <section class="clients-section py-12 md:py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Trusted by Leading Organizations</h2>
                <p class="text-lg text-gray-600">Proud to partner with innovative companies across industries</p>
            </div>
            
            <div class="clients-slider-wrapper">
                <div class="clients-slider">
                    <!-- First set of logos -->
                    <div class="client-logo">
                        <img src="{{ asset('clients/11AEW9AEC_2025-logo.png') }}" alt="11AEW9AEC Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/Flourish_Hub-logo.png') }}" alt="Flourish Hub Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/HESFB_logo.png') }}" alt="HESFB Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/Kafu_Prime_Cuts-logo.png') }}" alt="Kafu Prime Cuts Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/Modiac-logo.png') }}" alt="Modiac Client Logo">
                    </div>
                    
                    <!-- Duplicate set for seamless loop -->
                    <div class="client-logo">
                        <img src="{{ asset('clients/11AEW9AEC_2025-logo.png') }}" alt="11AEW9AEC Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/Flourish_Hub-logo.png') }}" alt="Flourish Hub Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/HESFB_logo.png') }}" alt="HESFB Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/Kafu_Prime_Cuts-logo.png') }}" alt="Kafu Prime Cuts Client Logo">
                    </div>
                    <div class="client-logo">
                        <img src="{{ asset('clients/Modiac-logo.png') }}" alt="Modiac Client Logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .clients-section {
            overflow: hidden;
        }

        .clients-slider-wrapper {
            overflow: hidden;
            padding: 20px 0;
            position: relative;
        }

        .clients-slider {
            display: flex;
            gap: 60px;
            animation: scroll 30s linear infinite;
            width: fit-content;
        }

        .client-logo {
            flex-shrink: 0;
            width: 180px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .client-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .client-logo:hover img {
            filter: grayscale(0%);
            opacity: 1;
        }

        .client-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Pause animation on hover */
        .clients-slider-wrapper:hover .clients-slider {
            animation-play-state: paused;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .client-logo {
                width: 140px;
                height: 80px;
            }

            .clients-slider {
                gap: 40px;
                animation: scroll 20s linear infinite;
            }
        }
    </style>
    
    <!-- Call to Action -->
    <section class="py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-bytewave-blue to-bytewave-blue-700 rounded-2xl p-8 md:p-12 shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="fas fa-phone-alt text-bytewave-blue text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-white/90 text-sm mb-1">Call Us Now</p>
                            <h3 class="text-white text-2xl md:text-3xl font-bold">0773448069</h3>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="fas fa-envelope-open text-bytewave-blue text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-white/90 text-sm mb-1">Mail Us Now</p>
                            <h3 class="text-white text-xl md:text-2xl font-bold"><a href="mailto:info@bytewaveinvestments.com" class="hover:text-bytewave-gold transition-colors duration-300">info@bytewaveinvestments.com</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    /* No custom carousel styles needed - using Alpine.js + Tailwind CSS */
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