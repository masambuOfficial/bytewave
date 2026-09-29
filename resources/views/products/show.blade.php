@extends('layouts.app')

@section('title', $product->name . ' - BYTEWAVE')
@section('meta_description', $product->meta_description ?: Str::limit(strip_tags($product->description), 160))
@section('og_type', 'website')
@section('og_image', asset($product->image_url))

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Product",
    "name": @json($product->name),
    "description": @json($product->description),
    "image": @json(asset($product->image_url)),
    "offers": {
        "@type": "Offer",
        "price": @json((float) $product->price),
        "priceCurrency": @json(strtoupper($product->currency ?? 'USD')),
        "availability": "https://schema.org/InStock"
    }
}
</script>
    <x-breadcrumb-schema :items="[
        'Home' => route('home'),
        'Products' => route('products.index'),
        $product->name => url()->current(),
    ]" />
@endpush

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20 mb-12" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fadeInDown">{{ $product->name }}</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:underline transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:underline transition-colors" href="{{ route('products.index') }}">Products</a></li>
                    <li class="before:content-['/'] before:mx-2">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Details Start -->
    <div class="relative isolate py-12 my-12">
        <x-bg-art layout="white" />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div class="animate-fadeIn">
                    <div class="bg-bytewave-blue/5 p-6 rounded-2xl shadow-lg">
                        <img src="{{ asset($product->image_url) }}" 
                             class="w-full h-auto max-h-[500px] object-contain rounded-xl" 
                             alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="animate-fadeIn">
                    <div class="h-full">
                        <h2 class="text-4xl font-bold text-bytewave-ink mb-4">{{ $product->name }}</h2>
                        <p class="text-xl text-bytewave-ink mb-6 leading-relaxed">{{ $product->description }}</p>

                        <div class="flex items-center gap-4 mb-6">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h3 class="text-3xl font-bold text-bytewave-blue">{{ $product->formatted_price }}</h3>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-bytewave-blue/5 text-bytewave-blue">
                                    {{ $product->billing_cycle_label }}
                                </span>
                            </div>
                            @if($product->stock > 0)
                                <span class="bg-bytewave-success text-white px-4 py-2 rounded-full text-sm font-semibold">In Stock</span>
                            @else
                                <span class="bg-bytewave-danger text-white px-4 py-2 rounded-full text-sm font-semibold">Out of Stock</span>
                            @endif
                        </div>

                        @if($product->category)
                            <p class="text-bytewave-ink mb-6 text-lg">
                                <strong class="font-semibold">Category:</strong> {{ $product->category }}
                            </p>
                        @endif

                        <div class="mt-8 bg-bytewave-blue/5 p-6 rounded-xl">
                            <h4 class="text-2xl font-bold text-bytewave-ink mb-3">Interested in this product?</h4>
                            <p class="text-bytewave-ink/70 mb-6">Contact us to learn more about pricing, specifications, and how this product can benefit your business.</p>
                            <x-cta-button :href="route('contact')" text="Contact Us" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Products -->
            <div class="mt-12">
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-bytewave-blue hover:text-bytewave-ink font-semibold transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Products
                </a>
            </div>
        </div>
    </div>
    <!-- Product Details End -->

    @if($relatedProducts->isNotEmpty())
    <!-- Related Products Start -->
    <div class="relative isolate py-12 bg-bytewave-blue/5">
        <x-bg-art layout="tint" flip />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mx-auto pb-12 max-w-2xl animate-fadeIn">
                <h5 class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Our Products</h5>
                <h2 class="text-3xl md:text-4xl font-bold text-bytewave-blue">Other Products You Might Like</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="animate-fadeIn hover:transform hover:-translate-y-2 transition-all duration-500">
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 h-full overflow-hidden">
                            <div class="relative">
                                <img loading="lazy" decoding="async" src="{{ asset($relatedProduct->image_url) }}" 
                                     class="w-full h-64 object-cover"
                                     alt="{{ $relatedProduct->name }}">
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h5 class="text-xl font-bold text-bytewave-ink">{{ $relatedProduct->name }}</h5>
                                    <span class="text-bytewave-blue font-bold text-lg">${{ number_format($relatedProduct->price, 2) }}</span>
                                </div>
                                <p class="text-bytewave-ink/70 mb-6">{{ Str::limit($relatedProduct->description, 100) }}</p>
                                <x-cta-button :href="route('products.show', $relatedProduct->slug)" text="View Details" size="sm" />
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
