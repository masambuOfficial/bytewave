@extends('layouts.app')

@section('title', 'BYTEWAVE - Innovative IT Solutions')

@section('content')

    <!-- Hero Section with Background Slideshow -->
    <div x-data="{
        currentSlide: 0,
        slides: [
            '{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}',
            '{{ asset('css/img/gavin_in_the_field-01.jpg') }}'
        ],
        phrases: [
            'innovative ideas',
            'creative concepts'
        ],
        autoplayInterval: null,
        init() {
            this.startAutoplay();
        },
        startAutoplay() {
            this.autoplayInterval = setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            }, 5000);
        },
        stopAutoplay() {
            clearInterval(this.autoplayInterval);
        }
    }" 
    class="relative overflow-hidden h-screen min-h-[600px]">
        
        <!-- Background Image Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index"
                 x-transition:enter="transition ease-in-out duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in-out duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0">
                <div class="absolute inset-0 bg-cover bg-center" :style="`background-image: url('${slide}')`"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
            </div>
        </template>
        
        <!-- Static Overlay Content -->
        <div class="relative h-full flex items-center z-10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-[7fr_3fr] gap-8 lg:gap-12 items-center">
                    <!-- Left Column (Wider) -->
                    <div class="max-w-[900px]">
                        <!-- Badge -->
                        <div class="inline-flex items-center gap-2 mb-6 bg-white px-4 py-2" style="border-radius: 6px 6px 16px 6px;">
                            <span class="w-2 h-2 bg-red-500 rounded-sm"></span>
                            <span class="text-blue-500 text-sm md:text-base font-medium tracking-wide">Your Trusted ICT & Multimedia Partner</span>
                        </div>
                        
                        <!-- Main Heading -->
                        <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight">
                            From <span class="text-blue-500 whitespace-nowrap inline-block relative">
                                <!-- Invisible placeholder to maintain height -->
                                <span class="invisible">innovative ideas</span>
                                <!-- Phrases synced with slides (instant cut, no transition) -->
                                <template x-for="(phrase, index) in phrases" :key="index">
                                    <span x-show="currentSlide === index"
                                          class="absolute left-0 top-0"
                                          x-text="phrase"></span>
                                </template>
                            </span><br>
                            to finished solutions
                        </h1>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="text-bytewave-gold text-sm md:text-base font-semibold">
                            <p>// SINCE 2020 //</p>
                        </div>
                        
                        <p class="text-white/90 text-base md:text-lg leading-relaxed">
                            We deliver end-to-end ICT and multimedia solutions from concept to deployment, engineered for quality, efficiency, and on-time delivery.
                        </p>
                        
                        <!-- CTA Button -->
                        <x-cta-button 
                            href="{{ url('/services') }}" 
                            text="Explore our capabilities" 
                            bgColor="bg-blue-500" 
                            hoverBgColor="hover:bg-blue-600"
                            arrowBgColor="bg-white"
                            arrowColor="text-blue-500"
                        />
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide Indicators -->
        <div class="absolute bottom-24 left-1/2 -translate-x-1/2 flex gap-3 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="currentSlide = index" 
                        :class="currentSlide === index ? 'w-12 bg-bytewave-gold' : 'w-3 bg-white hover:bg-white/75'"
                        class="h-3 rounded-full transition-all duration-300">
                </button>
            </template>
        </div>
        
        <!-- Bottom Info Bar -->
        <div class="absolute bottom-0 left-0 right-0 z-20 border-t border-white/20">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-6 gap-4 text-white/90 text-sm">
                    <!-- Left: Location (hidden on mobile) -->
                    <div class="hidden md:flex items-center gap-2">
                        <span class="font-medium">Based in:</span>
                        <span>Kampala, Uganda</span>
                    </div>
                    
                    <!-- Center: Scroll Down (centered on mobile) -->
                    <a href="#why-choose-us" class="flex flex-col items-center gap-2 hover:text-white transition-colors group mx-auto md:mx-0">
                        <span class="uppercase tracking-wider text-xs">Scroll Down</span>
                        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                    
                    <!-- Right: Coordinates (hidden on mobile) -->
                    <div class="hidden md:block text-right">
                        <span>0.3476° N, 32.5825° E</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <section id="why-choose-us" class="py-12 md:py-20 bg-gray-50">
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

    <!-- Scalable Capabilities Section -->
    <section class="py-16 md:py-24 bg-white" x-data="{ 
        services: [
            {
                icon: 'computer',
                image: '{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}',
                title: 'ICT Solutions & Support',
                features: [
                    'Computer repair & maintenance',
                    'Network setup & management',
                    'IT infrastructure consulting',
                    'Hardware & software installation'
                ]
            },
            {
                icon: 'video',
                image: '{{ asset('css/img/bytewave_livestreaming.jpg') }}',
                title: 'Multimedia Production',
                features: [
                    'Live streaming services',
                    'Video production & editing',
                    'Audio recording & mixing',
                    'Photography & graphic design'
                ]
            },
            {
                icon: 'code',
                image: '{{ asset('css/img/gavin_in_the_field-01.jpg') }}',
                title: 'Web & Software Development',
                features: [
                    'Custom web applications',
                    'E-commerce solutions',
                    'Mobile app development',
                    'API integration & automation'
                ]
            },
            {
                icon: 'chart',
                image: '{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}',
                title: 'Digital Marketing',
                features: [
                    'Social media management',
                    'SEO & content marketing',
                    'Brand strategy & design',
                    'Analytics & reporting'
                ]
            }
        ]
    }">
        <div class="w-full px-6 sm:px-8 md:px-12 lg:px-16 xl:px-24 2xl:px-32">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-12 md:mb-16 gap-6">
                <div class="max-w-2xl">
                    <span class="inline-block text-bytewave-blue font-semibold mb-3 uppercase tracking-wider text-sm">What we do</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900">
                        Scalable <span class="text-blue-600">capabilities</span><br>
                        for every challenge
                    </h2>
                </div>
                <x-cta-button 
                    href="{{ url('/services') }}" 
                    text="Explore all capabilities"
                    bgColor="bg-blue-500"
                    hoverBgColor="hover:bg-blue-600"
                    arrowBgColor="bg-white"
                    arrowColor="text-blue-500"
                />
            </div>

            <!-- Services Grid with Sticky Scroll -->
            <div class="relative">
                <template x-for="(service, index) in services" :key="index">
                    <div class="sticky" :style="`top: ${index * 150}px; z-index: ${index + 1}`">
                        <div class="group bg-white border-y border-gray-200 py-8">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                                <!-- Icon -->
                                <div class="lg:col-span-1 flex justify-center lg:justify-start">
                                    <div class="w-14 h-14 flex items-center justify-center">
                                        <!-- Computer Icon -->
                                        <svg x-show="service.icon === 'computer'" class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <!-- Video Icon -->
                                        <svg x-show="service.icon === 'video'" class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                        <!-- Code Icon -->
                                        <svg x-show="service.icon === 'code'" class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                        <!-- Chart Icon -->
                                        <svg x-show="service.icon === 'chart'" class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="lg:col-span-4">
                                    <div class="relative overflow-hidden rounded-lg aspect-video">
                                        <img :src="service.image" :alt="service.title" 
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    </div>
                                </div>

                                <!-- Service Title -->
                                <div class="lg:col-span-2">
                                    <h3 class="text-xl md:text-2xl font-bold text-gray-900" x-text="service.title"></h3>
                                </div>

                                <!-- Features -->
                                <div class="lg:col-span-4">
                                    <div class="space-y-2">
                                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Features</p>
                                        <template x-for="(feature, fIndex) in service.features" :key="fIndex">
                                            <div class="flex items-start gap-2">
                                                <svg class="w-5 h-5 text-bytewave-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-gray-700" x-text="feature"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Arrow Button -->
                                <div class="lg:col-span-1 flex justify-center lg:justify-end">
                                    <a href="{{ url('/services') }}" 
                                       class="w-12 h-12 rounded-md bg-blue-600 hover:bg-blue-700 flex items-center justify-center transition-all duration-300 hover:scale-110 group-hover:translate-x-2">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                
                <!-- CTA Section - Last Cascading Element -->
                <div class="sticky" :style="`top: ${((services.length - 1) * 150) + 80}px; z-index: ${services.length + 1}`">
                    <div class="bg-transparent overflow-hidden mt-8">
                        <div class="relative px-8 py-12 md:px-12 md:py-16 flex flex-col md:flex-row items-center justify-between gap-6">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
                            </div>
                            
                            <!-- Title -->
                            <div class="relative z-10">
                                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white">
                                    <!-- Ready to start<br>your next project? -->
                                </h2>
                            </div>
                            
                            <!-- CTA Button -->
                            <div class="relative z-10">
                                <!-- <a href="{{ url('/contact') }}" 
                                   class="inline-flex items-center gap-3 bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 group">
                                    <span>Schedule consultation</span>
                                    <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded flex items-center justify-center transition-transform group-hover:translate-x-1">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA with Why Choose Us width -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-lg overflow-hidden">
                    <div class="relative px-8 py-12 md:px-12 md:py-16 flex flex-col md:flex-row items-center justify-between gap-6">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
                            </div>
                            
                            <!-- Title -->
                            <div class="relative z-10">
                                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white">
                                    Ready to start<br>your next project?
                                </h2>
                            </div>
                            
                            <!-- CTA Button -->
                            <div class="relative z-10">
                                <x-cta-button 
                                    href="{{ url('/contact') }}" 
                                    text="Schedule consultation"
                                    bgColor="bg-white"
                                    hoverBgColor="hover:bg-gray-100"
                                    textColor="text-blue-600"
                                    arrowBgColor="bg-blue-600"
                                    arrowColor="text-white"
                                />
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="py-16 md:py-24 bg-white" x-data="{ 
        currentIndex: 0,
        portfolios: {{ json_encode($latestPortfolios ?? []) }},
        get currentPortfolio() {
            return this.portfolios[this.currentIndex] || {};
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.portfolios.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.portfolios.length) % this.portfolios.length;
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header with Navigation -->
            <div class="flex items-start justify-between mb-12 md:mb-16 gap-8">
                <div class="flex-1">
                    <span class="inline-block text-sm font-semibold mb-4 uppercase tracking-wider text-bytewave-gold">Real-world success</span>
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Real <span class="text-blue-600">results</span> from real projects
                    </h2>
                </div>
                
                <!-- Navigation Arrows -->
                <div class="flex gap-2">
                    <button @click="prev" class="w-12 h-12 rounded-md border-2 border-gray-300 hover:border-blue-600 hover:bg-blue-50 flex items-center justify-center transition-all duration-300 group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button @click="next" class="w-12 h-12 rounded-md border-2 border-gray-300 hover:border-blue-600 hover:bg-blue-50 flex items-center justify-center transition-all duration-300 group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Carousel Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-lg overflow-hidden shadow-xl">
                <!-- Left Column - Dark Background with Project Info -->
                <div class="p-8 md:p-12 lg:p-12 flex flex-col justify-between min-h-[400px] lg:min-h-[450px]" style="background: linear-gradient(135deg, #0773B8 0%, #04456E 100%);">
                    <!-- Category Badge -->
                    <div>
                        <span class="inline-block px-4 py-1 bg-white/10 text-white text-sm font-semibold rounded-full mb-6" x-text="currentPortfolio.category"></span>
                        
                        <!-- Project Title -->
                        <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4" x-text="currentPortfolio.title"></h3>
                        
                        <!-- Project Description -->
                        <p class="text-gray-300 text-base md:text-lg leading-relaxed mb-8" x-text="currentPortfolio.description ? currentPortfolio.description.substring(0, 120) + '...' : ''"></p>
                    </div>
                    
                    <!-- Stats & CTA -->
                    <div class="flex items-center justify-between gap-8">
                        <!-- Placeholder Stats (will be dynamic when DB field is added) -->
                        <div class="flex-shrink-0">
                            <div class="text-4xl md:text-5xl font-bold text-white mb-1">100%</div>
                            <div class="text-gray-400 text-xs uppercase tracking-wider">Client Satisfaction</div>
                        </div>
                        
                        <!-- View Case Button -->
                        <div class="flex-shrink-0">
                            <a :href="`/portfolios/${currentPortfolio.slug}`" class="inline-flex items-center gap-2 bg-white text-gray-900 font-semibold transition-all duration-300 group overflow-hidden" style="height: 48px; padding: 6px 6px 6px 18px; border-radius: 6px 6px 16px 6px;">
                                <span class="text-sm whitespace-nowrap relative overflow-hidden inline-block" style="height: 20px;">
                                    <span class="inline-block transition-transform duration-300 group-hover:-translate-y-full">View case</span>
                                    <span class="inline-block absolute left-0 top-full transition-transform duration-300 group-hover:-translate-y-full">View case</span>
                                </span>
                                <div class="bg-gray-900 rounded-md flex items-center justify-center relative overflow-hidden flex-shrink-0" style="width: 36px; height: 36px;">
                                    <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300 group-hover:translate-x-full">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                    <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300 -translate-x-full group-hover:translate-x-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Image/Video -->
                <div class="relative bg-gray-100 min-h-[400px] lg:min-h-[450px]">
                    @foreach($latestPortfolios ?? [] as $index => $portfolio)
                        @php
                            $type = $portfolio->getPrimaryMediaType();
                            $src = $portfolio->primaryMediaPublicUrl();
                            $embedSrc = $portfolio->primaryEmbedSrc();
                        @endphp
                        <div x-show="currentIndex === {{ $index }}" x-transition class="absolute inset-0">
                            @if($type === 'video' && $src)
                                <video class="w-full h-full object-cover" muted playsinline preload="metadata">
                                    <source src="{{ $src }}" type="video/mp4">
                                </video>
                            @elseif($type === 'embed' && $embedSrc)
                                <iframe class="w-full h-full" src="{{ $embedSrc }}" title="{{ $portfolio->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe>
                            @else
                                <img src="{{ $src ? $src : asset($portfolio->image_url) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                    @endforeach
                    
                    <!-- Client Logo Overlay (if applicable) -->
                    <div class="absolute top-8 right-8 bg-white/90 backdrop-blur-sm px-6 py-3 rounded-lg z-10">
                        <span class="text-gray-900 font-semibold" x-text="currentPortfolio.client || 'Client Name'"></span>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA Section - "Open a conversation" -->
            <div class="mt-16 bg-blue-500 rounded-lg p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <!-- Avatar Images -->
                    <div class="flex -space-x-3">
                        <img src="{{ asset('hhiqAWN8uopSow2Pn5F5PWR0lNM.avif') }}" alt="Team member" class="w-12 h-12 rounded-full border-2 border-white object-cover">
                        <img src="{{ asset('0jxLgyu1KT3iisfQG2TUjYiR02E.avif') }}" alt="Team member" class="w-12 h-12 rounded-full border-2 border-white object-cover">
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-white">Open a conversation</h4>
                        <p class="text-blue-100">Contact us to explore solutions tailored to your needs.</p>
                    </div>
                </div>
                
                <!-- Contact Button -->
                <x-cta-button 
                    href="{{ url('/contact') }}" 
                    text="Contact us now"
                    bgColor="bg-white"
                    hoverBgColor="hover:bg-gray-100"
                    textColor="text-blue-600"
                    arrowBgColor="bg-blue-600"
                    arrowColor="text-white"
                />
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <section class="py-12 md:py-20 bg-white" x-data="{
        currentTestimonial: 0,
        testimonials: [
            @foreach($testimonials as $testimonial)
            {
                name: '{{ $testimonial->name }}',
                title: '{{ $testimonial->title }}',
                company: '{{ $testimonial->company }}',
                image: '{{ $testimonial->avatar ? asset('storage/' . $testimonial->avatar) : asset('0jxLgyu1KT3iisfQG2TUjYiR02E.avif') }}',
                rating: {{ $testimonial->rating }},
                text: '{{ addslashes($testimonial->testimonial) }}'
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ],
        autoSlide() {
            setInterval(() => {
                this.currentTestimonial = (this.currentTestimonial + 1) % this.testimonials.length;
            }, 5000);
        }
    }" x-init="autoSlide()">
        <div class="w-full px-6 sm:px-8 md:px-12 lg:px-16 xl:px-24 2xl:px-32">
            <!-- Section Header -->
            <div class="text-center mb-12 md:mb-16">
                <div class="inline-flex items-center gap-2 bg-white border border-gray-200 rounded-full px-4 py-2 mb-4">
                    <div class="w-2 h-2 bg-blue-500 rounded-sm"></div>
                    <span class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Build on trust</span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Trusted by <span class="text-blue-500">clients</span>, proven by results
                </h2>
            </div>

            <!-- Three Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Column 1: Testimonials -->
                <div class="bg-gray-900 rounded-lg p-6 flex gap-4">
                    <!-- Avatar Stack -->
                    <div class="flex flex-col gap-3 flex-shrink-0">
                        <template x-for="(testimonial, index) in testimonials" :key="index">
                            <button 
                                @click="currentTestimonial = index"
                                class="w-12 h-12 rounded-full border-2 transition-all duration-300"
                                :class="currentTestimonial === index ? 'border-orange-500 opacity-100' : 'border-white opacity-40'"
                            >
                                <img :src="testimonial.image" :alt="testimonial.name" class="w-full h-full rounded-full object-cover">
                            </button>
                        </template>
                    </div>

                    <!-- Testimonial Content -->
                    <div class="flex-1 bg-gray-100 rounded-lg p-6">
                        <!-- Star Rating -->
                        <div class="flex gap-1 mb-4">
                            <template x-for="i in 5" :key="i">
                                <svg class="w-5 h-5" :class="i <= testimonials[currentTestimonial].rating ? 'text-orange-500' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </template>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-700 mb-6 leading-relaxed" x-text="testimonials[currentTestimonial].text"></p>

                        <!-- Client Info -->
                        <div>
                            <h4 class="text-lg font-bold text-gray-900" x-text="testimonials[currentTestimonial].name"></h4>
                            <p class="text-sm text-gray-600" x-text="testimonials[currentTestimonial].title"></p>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Two Stacked Cards -->
                <div class="flex flex-col gap-6">
                    <!-- Top Card: Company Logo with Background -->
                    <div class="relative bg-gray-900 rounded-lg overflow-hidden" style="min-height: 280px;">
                        <div class="absolute inset-0 opacity-30">
                            <img src="{{ asset('css/img/bytewave_livestreaming.jpg') }}" alt="Background" class="w-full h-full object-cover">
                        </div>
                        <div class="relative z-10 flex flex-col items-center justify-center h-full p-8">
                            <p class="text-white text-sm mb-4">// 2024-2026 //</p>
                            <img src="{{ asset('css/img/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="ByteWave Logo" class="h-12">
                        </div>
                    </div>

                    <!-- Bottom Card: Stats -->
                    <div class="bg-gradient-to-br from-bytewave-gold to-yellow-500 rounded-lg p-6 grid grid-cols-2 gap-6">
                        <div>
                            <div class="text-4xl md:text-5xl font-bold text-white mb-2">98%</div>
                            <p class="text-white text-sm">On-Time delivery rate</p>
                        </div>
                        <div>
                            <div class="text-4xl md:text-5xl font-bold text-white mb-2">50+</div>
                            <p class="text-white text-sm">Skilled professionals</p>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Support Content -->
                <div class="relative bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg p-8 flex flex-col justify-between overflow-hidden">
                    <!-- Background Shadow -->
                    <div class="absolute bottom-0 right-0 w-64 h-64 opacity-10">
                        <svg viewBox="0 0 200 200" fill="white">
                            <circle cx="100" cy="100" r="100"/>
                        </svg>
                    </div>

                    <div class="relative z-10 flex flex-col justify-between h-full">
                        <!-- Icon -->
                        <div class="w-16 h-16">
                            <img src="{{ asset('contact.svg') }}" alt="Contact Icon" class="w-full h-full">
                        </div>

                        <!-- Content -->
                        <div>
                            <h4 class="text-2xl font-bold text-white mb-4">Need help choosing the right product?</h4>
                            <p class="text-blue-100">Always ready with guidance, product details, and after-sales support.</p>
                        </div>

                        <!-- Button -->
                        <div>
                            <x-cta-button 
                                href="{{ url('/contact') }}" 
                                text="Contact Support"
                                bgColor="bg-white"
                                hoverBgColor="hover:bg-gray-100"
                                textColor="text-blue-600"
                                arrowBgColor="bg-blue-600"
                                arrowColor="text-white"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Client Logos Section -->
    <section class="py-12 bg-blue-500 overflow-hidden">
        <div class="w-full px-6 sm:px-8 md:px-12 lg:px-16 xl:px-24 2xl:px-32">
            <!-- Section Title -->
            <h3 class="text-2xl md:text-3xl font-bold text-white text-center mb-8">Trusted by Leading Organizations</h3>
            
            <!-- Horizontal Scrolling Logos -->
            <div class="relative overflow-hidden">
                <div class="logo-ticker">
                    <div class="logo-track">
                        <!-- Client 1 - 11AEW9AEC -->
                        <div class="logo-item">
                            <img src="{{ asset('clients/11AEW9AEC_2025-logo.png') }}" alt="11AEW9AEC" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 2 - Flourish Hub -->
                        <div class="logo-item">
                            <img src="{{ asset('clients/Flourish_Hub-logo.png') }}" alt="Flourish Hub" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 3 - HESFB -->
                        <div class="logo-item">
                            <img src="{{ asset('clients/HESFB_logo.png') }}" alt="HESFB" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 4 - Kafu Prime Cuts -->
                        <div class="logo-item">
                            <img src="{{ asset('clients/Kafu_Prime_Cuts-logo.png') }}" alt="Kafu Prime Cuts" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 5 - Modiac -->
                        <div class="logo-item">
                            <img src="{{ asset('clients/Modiac-logo.png') }}" alt="Modiac" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 6 - IGAD -->
                        <div class="logo-item">
                            <img src="https://africa-knowledge-platform.ec.europa.eu/sites/default/files/styles/max_325x325/public/2024-01/IGAD_LOGO-01_pWTr1XF.png?itok=mFgrjoCu" alt="IGAD" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 7 - UIPE -->
                        <div class="logo-item">
                            <img src="https://uipe.co.ug/wp-content/uploads/2022/08/cropped-UIPE-logo-1.jpg" alt="UIPE" class="w-full h-full object-contain">
                        </div>

                        <!-- Client 8 - UVTAB -->
                        <div class="logo-item">
                            <img src="https://uvtab.go.ug/static/media/uvtab-logo.b50d6a6eb1c4f6887a4c.png" alt="UVTAB" class="w-full h-full object-contain">
                        </div>

                        <!-- Duplicate logos for seamless loop -->
                        <div class="logo-item">
                            <img src="{{ asset('clients/11AEW9AEC_2025-logo.png') }}" alt="11AEW9AEC" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="{{ asset('clients/Flourish_Hub-logo.png') }}" alt="Flourish Hub" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="{{ asset('clients/HESFB_logo.png') }}" alt="HESFB" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="{{ asset('clients/Kafu_Prime_Cuts-logo.png') }}" alt="Kafu Prime Cuts" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="{{ asset('clients/Modiac-logo.png') }}" alt="Modiac" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="https://africa-knowledge-platform.ec.europa.eu/sites/default/files/styles/max_325x325/public/2024-01/IGAD_LOGO-01_pWTr1XF.png?itok=mFgrjoCu" alt="IGAD" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="https://uipe.co.ug/wp-content/uploads/2022/08/cropped-UIPE-logo-1.jpg" alt="UIPE" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-item">
                            <img src="https://uvtab.go.ug/static/media/uvtab-logo.b50d6a6eb1c4f6887a4c.png" alt="UVTAB" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News & Articles Section -->
    @if($recentArticles->isNotEmpty())
    <section class="bg-gray-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 max-w-3xl mx-auto">
                <span class="inline-block text-bytewave-blue font-semibold mb-4 uppercase tracking-wider text-base">Stay Updated</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest News & Articles</h2>
                <p class="text-gray-600">Discover the latest insights, trends, and updates from the tech world</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($recentArticles as $article)
                    <x-blog.article-card :article="$article" />
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('blog.index') }}" class="inline-block bg-bytewave-gold text-white font-semibold px-8 py-3 rounded-full hover:bg-bytewave-gold-600 transition-all duration-300 hover:scale-105 shadow-lg">
                    View All Articles →
                </a>
            </div>
        </div>
    </section>
    @endif
    
    
        </div>
    </section>

    <style>
        /* Clients Grid Styling */
        .clients-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .client-card {
            width: 100%;
        }

        .client-logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .client-logo-container {
            width: 100%;
            aspect-ratio: 4 / 3;
            padding: 12px;
            background-color: #f0f9ff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .client-logo {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        .client-logo-wrapper:hover .client-logo-container {
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            border-color: rgba(59, 130, 246, 0.2);
            transform: scale(1.08);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .client-logo-container {
                padding: 10px;
            }

            .client-logo {
                max-width: 85%;
                max-height: 85%;
            }
        }

        @media (max-width: 640px) {
            .client-logo-container {
                padding: 8px;
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
                            <h3 class="text-white text-2xl md:text-3xl font-bold">{{ config('company.phone') }}</h3>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                            <i class="fas fa-envelope-open text-bytewave-blue text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-white/90 text-sm mb-1">Mail Us Now</p>
                            <a href="mailto:info@bytewaveinvestments.com" class="text-white text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl font-bold hover:text-bytewave-gold transition-colors duration-300 break-all">info@bytewaveinvestments.com</a>
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