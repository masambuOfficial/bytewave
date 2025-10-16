@extends('layouts.app')

@section('title', 'Products - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Our Products</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Products Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Products</h5>
                <h1 class="text-warning">Quality Products for Your Business</h1>
            </div>
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="product-item bg-light h-100">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $product->image_url) }}" 
     class="img-fluid w-100"
     alt="{{ $product->name }}"
     style="height: 250px; object-fit: cover;">
                                @if($product->stock > 0)
                                    <div class="position-absolute top-0 end-0 p-2 bg-success text-white">
                                        In Stock
                                    </div>
                                @else
                                    <div class="position-absolute top-0 end-0 p-2 bg-danger text-white">
                                        Out of Stock
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{ $product->name }}</h5>
                                    <span class="text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <p class="mb-4">{{ Str::limit($product->description, 100) }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="btn btn-primary text-white px-4 py-2 rounded-pill">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <!-- Products End -->

    <!-- Call to Action Start -->
    <div class="container-fluid bg-primary py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <h1 class="mb-4 text-white">Interested in our products?</h1>
                    <p class="text-white mb-4">Contact us to learn more about our product offerings and how they can benefit your business.</p>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('contact') }}" class="btn btn-light text-primary px-5 py-3 rounded-pill">Contact Us</a>
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
    .product-item {
        transition: all 0.3s ease;
    }
    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>
@endsection
