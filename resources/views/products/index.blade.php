@extends('layouts.app')

@section('title', 'Products - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">Our Products</h1>
           <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:text-bytewave-gold transition-colors">Home</a></li>
                    <li class="text-white/50">/</li>
                    <li class="text-bytewave-gold" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Products Start -->
    <div class="py-12 relative overflow-hidden bg-gradient-to-br from-gray-50 via-white to-blue-50">
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
                    <span class="bg-bytewave-blue/10 text-bytewave-blue px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wide">Our Products</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Quality Products for 
                    <span class="text-bytewave-gold relative">
                        Your Business
                        <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5.5C50 2.5 150 2.5 199 5.5" stroke="#F59E0B" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h1>
                <p class="text-gray-600 mt-4 text-lg">Innovative solutions tailored to drive your business forward</p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="product-card animate-fadeIn hover:transform hover:-translate-y-2 transition-all duration-500">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 h-full relative overflow-hidden group border border-gray-100 flex flex-col">
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
                                <img src="{{ asset('storage/' . $product->image_url) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     alt="{{ $product->name }}">
                                <div class="absolute inset-0 bg-bytewave-blue/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                @if($product->stock > 0)
                                    <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-2 text-sm font-semibold rounded-full shadow-lg z-20">
                                        In Stock
                                    </div>
                                @else
                                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-2 text-sm font-semibold rounded-full shadow-lg z-20">
                                        Out of Stock
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content Section - Bottom Half -->
                            <div class="p-8 text-center relative z-20 flex flex-col flex-1">
                                <!-- Product Name & Price -->
                                <div class="w-full mb-4 text-left">
                                    <h5 class="text-xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $product->name }}</h5>
                                    <div class="mt-2">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="inline-block whitespace-nowrap text-bytewave-blue group-hover:text-white font-bold text-lg transition-colors duration-300">{{ $product->formatted_price }}</span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-bytewave-blue/10 text-bytewave-blue group-hover:bg-white/15 group-hover:text-white transition-colors duration-300">
                                                {{ $product->billing_cycle_label }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <p class="text-gray-600 group-hover:text-white/90 transition-colors duration-300 leading-relaxed mb-6 text-left">{{ Str::limit($product->description, 100) }}</p>
                                
                                <!-- CTA Button with Arrow -->
                                <div class="mt-auto pt-2 flex justify-center">
                                    <a href="{{ route('products.show', $product->slug) }}" 
                                       class="inline-flex items-center gap-2 bg-bytewave-gold hover:bg-yellow-600 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 group-hover:gap-4 group-hover:shadow-lg">
                                        View Details
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
                        <p class="text-xl text-gray-600">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Call to Action Start -->
    <div class="bg-bytewave-gold py-12 relative overflow-hidden">
        <!-- Particles Container -->
        <div class="particles-container absolute inset-2 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Interested in our products?</h1>
                    <p class="text-white text-lg">Contact us to learn more about our product offerings and how they can benefit your business.</p>
                </div>
                <div class="lg:text-right">
                    <a href="{{ route('contact') }}" class="inline-block bg-white text-bytewave-blue font-semibold px-8 py-4 rounded-full hover:bg-bytewave-gold hover:text-white transition-all duration-300 hover:scale-105 shadow-lg">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->
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
    
    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out;
    }
    
    .animate-fadeIn {
        animation: fadeInDown 0.8s ease-out;
    }

    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        100% {
            transform: translate(0px, 0px) scale(1);
        }
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

    /* Staggered fade-in for product cards */
    .product-card:nth-child(1) {
        animation-delay: 0.1s;
    }
    
    .product-card:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .product-card:nth-child(3) {
        animation-delay: 0.3s;
    }
    
    .product-card:nth-child(4) {
        animation-delay: 0.4s;
    }
    
    .product-card:nth-child(5) {
        animation-delay: 0.5s;
    }
    
    .product-card:nth-child(6) {
        animation-delay: 0.6s;
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Particles Animation */
    .particles-container {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
        animation: float 15s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(50px);
            opacity: 0;
        }
    }

    .particle:nth-child(2n) {
        animation-duration: 20s;
        animation-delay: 2s;
    }

    .particle:nth-child(3n) {
        animation-duration: 18s;
        animation-delay: 4s;
    }

    .particle:nth-child(4n) {
        animation-duration: 22s;
        animation-delay: 1s;
    }
</style>
@endsection

@section('scripts')
<script>
    // Generate particles for CTA section
    document.addEventListener('DOMContentLoaded', function() {
        const particlesContainer = document.querySelector('.particles-container');
        const particleCount = 30;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random size between 2px and 8px
            const size = Math.random() * 6 + 2;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Random horizontal position
            particle.style.left = `${Math.random() * 100}%`;
            
            // Random delay
            particle.style.animationDelay = `${Math.random() * 15}s`;
            
            particlesContainer.appendChild(particle);
        }
    });
</script>
@endsection
