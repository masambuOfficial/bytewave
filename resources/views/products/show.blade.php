@extends('layouts.app')

@section('title', $product->name . ' - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">{{ $product->name }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Details Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Product Image -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                    <div class="product-image-container bg-light p-4 rounded">
                        <img src="{{ asset($product->image_url) }}" 
                             class="img-fluid rounded" 
                             alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                    <div class="h-100">
                        <h2 class="display-6 mb-4">{{ $product->name }}</h2>
                        <p class="lead mb-4">{{ $product->description }}</p>

                        <div class="d-flex align-items-center mb-4">
                            <h3 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h3>
                            @if($product->stock > 0)
                                <span class="badge bg-success ms-3">In Stock</span>
                            @else
                                <span class="badge bg-danger ms-3">Out of Stock</span>
                            @endif
                        </div>

                        @if($product->category)
                            <p class="mb-4">
                                <strong>Category:</strong> {{ $product->category }}
                            </p>
                        @endif

                        <div class="mt-5">
                            <h4 class="mb-3">Interested in this product?</h4>
                            <p class="text-muted">Contact us to learn more about pricing, specifications, and how this product can benefit your business.</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary text-white px-5 py-3 rounded-pill">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Products -->
            <div class="mt-5">
                <a href="{{ route('products.index') }}" class="text-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Products
                </a>
            </div>
        </div>
    </div>
    <!-- Product Details End -->

    @if($relatedProducts->isNotEmpty())
    <!-- Related Products Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Products</h5>
                <h1 class="text-warning">Other Products You Might Like</h1>
            </div>
            <div class="row g-4">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="product-item bg-white h-100">
                            <div class="position-relative">
                                <img src="{{ asset($relatedProduct->image_url) }}" 
                                     class="img-fluid w-100"
                                     alt="{{ $relatedProduct->name }}"
                                     style="height: 250px; object-fit: cover;">
                            </div>
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{ $relatedProduct->name }}</h5>
                                    <span class="text-primary fw-bold">${{ number_format($relatedProduct->price, 2) }}</span>
                                </div>
                                <p class="mb-4">{{ Str::limit($relatedProduct->description, 100) }}</p>
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" 
                                   class="btn btn-primary text-white px-4 py-2 rounded-pill">
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
    .page-header {
        background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat;
        background-size: cover;
    }
    .page-header .breadcrumb-item + .breadcrumb-item::before {
        color: var(--bs-white);
    }
    .product-image-container img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: contain;
    }
    .product-item {
        transition: all 0.3s ease;
    }
    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
@endsection
