@extends('layouts.app')

@section('title', 'Services - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">Services</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:text-bytewave-gold transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Services Start -->
    <div class="py-12 relative overflow-hidden bg-bytewave-blue-50 via-white to-blue-50">
        <!-- Animated Background Shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-10 w-72 h-72 bg-bytewave-blue opacity-5 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-bytewave-gold opacity-5 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-blue-400 opacity-5 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <!-- Section Header with Animation -->
            <div class="text-center mx-auto pb-12 max-w-2xl animate-fadeIn">
                <div class="inline-block mb-4">
                    <span class="bg-bytewave-blue/10 text-bytewave-blue px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wide">Our Services</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Services Built Specifically For 
                    <span class="text-bytewave-gold relative">
                        Your Business
                        <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5.5C50 2.5 150 2.5 199 5.5" stroke="#F59E0B" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h1>
                <p class="text-gray-600 mt-4 text-lg">Innovative solutions tailored to drive your business forward</p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="service-card animate-fadeIn hover:transform hover:-translate-y-2 transition-all duration-500">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 h-full relative overflow-hidden group border border-gray-100">
                            <!-- Animated Border Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-br from-bytewave-blue via-blue-500 to-bytewave-gold opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl" style="padding: 2px;">
                                <div class="bg-white h-full w-full rounded-2xl"></div>
                            </div>
                            
                            <!-- Blue Overlay on Hover -->
                            <div class="absolute inset-0 bg-gradient-to-br from-bytewave-blue to-blue-600 opacity-0 group-hover:opacity-95 transition-opacity duration-500 z-10 rounded-2xl"></div>
                            
                            <!-- Decorative Corner Element -->
                            <div class="absolute top-0 right-0 w-20 h-20 bg-bytewave-gold/10 rounded-bl-full transform translate-x-10 -translate-y-10 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform duration-500"></div>
                            
                            <!-- Image Section - Top Half -->
                            <div class="relative h-64 overflow-hidden rounded-t-2xl">
                                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('css/img/bytewave_livestreaming.jpg') }}" 
                                     alt="{{ $service->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-bytewave-blue/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                            
                            <!-- Content Section - Bottom Half -->
                            <div class="p-8 text-center relative z-20">
                                <div class="flex flex-col items-center">
                                    <!-- Service Name -->
                                    <h4 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-white transition-colors duration-300">
                                        {{ $service->name }}
                                    </h4>
                                    
                                    <!-- Description -->
                                    <p class="mb-6 text-gray-600 group-hover:text-white/90 transition-colors duration-300 leading-relaxed">
                                        {{ Str::limit($service->description, 150) }}
                                    </p>
                                    
                                    <!-- CTA Button with Arrow -->
                                    <a href="{{ Str::contains($service->name, 'Audio-Visual') || Str::contains($service->name, 'Audio Visual') ? route('services.audio-visual') : route('services.show', $service->id) }}"
                                       class="inline-flex items-center gap-2 bg-bytewave-gold hover:bg-yellow-600 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 group-hover:gap-4 group-hover:shadow-lg">
                                        Learn More
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Bottom Accent Line -->
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-bytewave-blue via-bytewave-gold to-bytewave-blue transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="inline-block p-8 bg-white rounded-2xl shadow-lg">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-xl text-gray-600">No services available at the moment.</p>
                            <p class="text-gray-500 mt-2">Check back soon for exciting new offerings!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Services End -->

@endsection

@section('styles')
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        25% {
            transform: translate(20px, -50px) scale(1.1);
        }
        50% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        75% {
            transform: translate(50px, 50px) scale(1.05);
        }
    }

    
    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out;
    }
    
    .animate-fadeIn {
        animation: fadeInDown 0.8s ease-out;
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Service Card Stagger Animation */
    .service-card:nth-child(1) {
        animation-delay: 0.1s;
    }
    
    .service-card:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .service-card:nth-child(3) {
        animation-delay: 0.3s;
    }
    
    .service-card:nth-child(4) {
        animation-delay: 0.4s;
    }
    
    .service-card:nth-child(5) {
        animation-delay: 0.5s;
    }
    
    .service-card:nth-child(6) {
        animation-delay: 0.6s;
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection
