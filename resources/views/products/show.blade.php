@extends('layouts.app')

@section('title', $product->name . ' - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20 mb-12" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">{{ $product->name }}</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:text-bytewave-gold transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:text-bytewave-gold transition-colors" href="{{ route('products.index') }}">Products</a></li>
                    <li class="before:content-['/'] before:mx-2">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Details Start -->
    <div class="py-12 my-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div class="animate-fadeIn">
                    <div class="bg-gray-50 p-6 rounded-2xl shadow-lg">
                        <img src="{{ asset($product->image_url) }}" 
                             class="w-full h-auto max-h-[500px] object-contain rounded-xl" 
                             alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="animate-fadeIn">
                    <div class="h-full">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h2>
                        <p class="text-xl text-gray-700 mb-6 leading-relaxed">{{ $product->description }}</p>

                        <div class="flex items-center gap-4 mb-6">
                            <h3 class="text-3xl font-bold text-bytewave-blue">${{ number_format($product->price, 2) }}</h3>
                            @if($product->stock > 0)
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold">In Stock</span>
                            @else
                                <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold">Out of Stock</span>
                            @endif
                        </div>

                        @if($product->category)
                            <p class="text-gray-700 mb-6 text-lg">
                                <strong class="font-semibold">Category:</strong> {{ $product->category }}
                            </p>
                        @endif

                        <div class="mt-8 bg-blue-50 p-6 rounded-xl">
                            <h4 class="text-2xl font-bold text-gray-900 mb-3">Interested in this product?</h4>
                            <p class="text-gray-600 mb-6">Contact us to learn more about pricing, specifications, and how this product can benefit your business.</p>
                            <a href="{{ route('contact') }}" class="inline-block bg-bytewave-blue hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-full transition-all duration-300">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Products -->
            <div class="mt-12">
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-bytewave-blue hover:text-blue-700 font-semibold transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Products
                </a>
            </div>
        </div>
    </div>
    <!-- Product Details End -->

    @if($relatedProducts->isNotEmpty())
    <!-- Related Products Start -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mx-auto pb-12 max-w-2xl animate-fadeIn">
                <h5 class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4">Our Products</h5>
                <h1 class="text-3xl md:text-4xl font-bold text-bytewave-gold">Other Products You Might Like</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="animate-fadeIn hover:transform hover:-translate-y-2 transition-all duration-500">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 h-full overflow-hidden">
                            <div class="relative">
                                <img src="{{ asset($relatedProduct->image_url) }}" 
                                     class="w-full h-64 object-cover"
                                     alt="{{ $relatedProduct->name }}">
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h5 class="text-xl font-bold text-gray-800">{{ $relatedProduct->name }}</h5>
                                    <span class="text-bytewave-blue font-bold text-lg">${{ number_format($relatedProduct->price, 2) }}</span>
                                </div>
                                <p class="text-gray-600 mb-6">{{ Str::limit($relatedProduct->description, 100) }}</p>
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                                   class="inline-block bg-bytewave-blue hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition-all duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products End -->
    @endif
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
</style>
@endsection
