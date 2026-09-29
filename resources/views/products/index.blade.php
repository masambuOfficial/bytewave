@extends('layouts.app')

@section('title', 'Software Products – SACCO, Healthcare & POS Systems | ByteWave')
@section('meta_description', 'Discover ByteWave software products including FinSphere SACCO management, FinHealth healthcare management and FinPOS point-of-sale systems built for African businesses.')

@push('schema')
    <x-breadcrumb-schema :items="['Home' => route('home'), 'Products' => url()->current()]" />
@endpush

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <p class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fadeInDown">Our Products</p>
           <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline transition-colors">Home</a></li>
                    <li class="text-white/50">/</li>
                    <li class="text-white" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Products Start -->
    <div class="py-12 relative isolate bg-bytewave-blue/5">
        <x-bg-art layout="tint" flip />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <!-- Section Header with Animation -->
            <div class="text-center mx-auto pb-12 max-w-2xl animate-fadeIn">
                <div class="inline-block mb-4">
                    <span class="bg-bytewave-blue/5 text-bytewave-blue px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wide">Our Products</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-bytewave-ink mb-4">
                    Quality Products for 
                    <span class="text-bytewave-blue relative">
                        Your Business
                        <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5.5C50 2.5 150 2.5 199 5.5" stroke="#0773B9" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h1>
                <p class="text-bytewave-ink/70 mt-4 text-lg">Innovative solutions tailored to drive your business forward</p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="product-card animate-fadeIn hover:transform hover:-translate-y-2 transition-all duration-500">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 h-full relative overflow-hidden group border border-bytewave-blue/20 flex flex-col">
                            <!-- Animated Border Gradient -->
                            <div class="absolute inset-0 bg-bytewave-blue opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl" style="padding: 2px;">
                                <div class="bg-white h-full w-full rounded-2xl"></div>
                            </div>
                            
                            <!-- Blue Overlay on Hover -->
                            <div class="absolute inset-0 bg-bytewave-blue opacity-0 group-hover:opacity-95 transition-opacity duration-500 z-10 rounded-2xl"></div>
                            
                            <!-- Decorative Corner Element -->
                            <div class="absolute top-0 right-0 w-20 h-20 bg-bytewave-blue/10 rounded-bl-full transform translate-x-10 -translate-y-10 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform duration-500"></div>
                            
                            <!-- Image Section - Top Half -->
                            <div class="relative h-64 overflow-hidden rounded-t-2xl">
                                <img loading="lazy" decoding="async" src="{{ asset('storage/' . $product->image_url) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     alt="{{ $product->name }}">
                                <div class="absolute inset-0 bg-bytewave-blue/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                @if($product->stock > 0)
                                    <div class="absolute top-4 right-4 bg-bytewave-success text-white px-3 py-2 text-sm font-semibold rounded-full shadow-lg z-20">
                                        In Stock
                                    </div>
                                @else
                                    <div class="absolute top-4 right-4 bg-bytewave-danger text-white px-3 py-2 text-sm font-semibold rounded-full shadow-lg z-20">
                                        Out of Stock
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content Section - Bottom Half -->
                            <div class="p-8 text-center relative z-20 flex flex-col flex-1">
                                <!-- Product Name & Price -->
                                <div class="w-full mb-4 text-left">
                                    <h5 class="text-xl font-bold text-bytewave-ink group-hover:text-white transition-colors duration-300">{{ $product->name }}</h5>
                                    <div class="mt-2">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="inline-block whitespace-nowrap text-bytewave-blue group-hover:text-white font-bold text-lg transition-colors duration-300">{{ $product->formatted_price }}</span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-bytewave-blue/5 text-bytewave-blue group-hover:bg-white/15 group-hover:text-white transition-colors duration-300">
                                                {{ $product->billing_cycle_label }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <p class="text-bytewave-ink/70 group-hover:text-white/90 transition-colors duration-300 leading-relaxed mb-6 text-left">{{ Str::limit($product->description, 100) }}</p>
                                
                                <!-- CTA Button with Arrow -->
                                <div class="mt-auto pt-2 flex justify-center">
                                    {{-- The card turns blue on hover, so the button turns white to stay visible --}}
                                    <x-cta-button :href="route('products.show', $product->slug)" text="View Details" size="sm"
                                        bgColor="bg-bytewave-blue group-hover:bg-white"
                                        hoverBgColor=""
                                        textColor="text-white group-hover:text-bytewave-blue"
                                        arrowBgColor="bg-white group-hover:bg-bytewave-blue"
                                        arrowColor="text-bytewave-blue group-hover:text-white" />
                                </div>
                            </div>

                            <!-- Bottom Accent Line -->
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-bytewave-blue transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-xl text-bytewave-ink/70">No products available at the moment.</p>
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
    <section class="py-12 md:py-20" aria-labelledby="products-cta-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-bytewave-blue/20 bg-bytewave-blue/5 px-6 py-10 md:px-12 md:py-14 flex flex-col md:flex-row md:items-center md:justify-between gap-8 text-center md:text-left">
                <div class="max-w-2xl">
                    <p class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-3 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Our Products</p>
                    <h2 id="products-cta-heading" class="text-3xl md:text-4xl font-bold text-bytewave-ink mb-3">Interested in our products?</h2>
                    <p class="text-lg text-bytewave-ink/70">Contact us to learn more about our product offerings and how they can benefit your business.</p>
                </div>
                <div class="flex-shrink-0 flex justify-center">
                    <x-cta-button :href="route('contact')" text="Contact Us" />
                </div>
            </div>
        </div>
    </section>
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

</style>
@endsection
