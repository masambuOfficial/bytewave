@extends('layouts.admin')

@section('title', 'Products')

@push('styles')
<style>
    .product-card {
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        background: #fff;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.10);
        border-color: rgba(29, 78, 216, 0.18);
    }
    .product-image {
        height: 210px;
        width: 100%;
        object-fit: cover;
        display: block;
    }
    .price-tag {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(245, 158, 11, 0.95);
        color: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 10px 22px rgba(245, 158, 11, 0.25);
    }
    .product-meta {
        color: #6b7280;
        font-size: 0.85rem;
    }
    .action-bar {
        display: flex;
        gap: 8px;
        margin-top: 16px;
    }
    .btn-min {
        border-radius: 999px;
        padding: 8px 12px;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .btn-bytewave {
        background: rgba(29, 78, 216, 0.08);
        border: 1px solid rgba(29, 78, 216, 0.22);
        color: #1d4ed8;
    }
    .btn-bytewave:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <p class="text-muted">No products found.</p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                Add your first product
            </a>
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="product-card h-100">
                        <div class="position-relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-image">
                            @else
                                <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-box fa-3x text-muted"></i>
                                </div>
                            @endif

                            <div class="price-tag">
                                {{ $product->formatted_price }}
                            </div>
                            <div style="position:absolute; top: 52px; right: 12px;">
                                <span class="badge rounded-pill" style="background: rgba(29, 78, 216, 0.10); color: #1d4ed8; border: 1px solid rgba(29, 78, 216, 0.18); font-weight: 700;">
                                    {{ $product->billing_cycle_label }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4 d-flex flex-column" style="min-height: 220px;">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <h5 class="mb-1" style="font-weight: 700; letter-spacing: -0.02em;">{{ $product->name }}</h5>
                                <span class="product-meta">{{ $product->category }}</span>
                            </div>
                            <p class="text-muted mb-0" style="line-height: 1.55;">
                                {{ Str::limit($product->description, 110) }}
                            </p>

                            <div class="action-bar mt-auto">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-min btn-bytewave flex-grow-1"
                                   title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}"
                                      method="POST"
                                      class="m-0 flex-grow-1"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-min btn-outline-danger w-100"
                                            title="Delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if($product->stock < 10)
                            <div class="card-footer bg-warning text-dark">
                                <small><i class="fas fa-exclamation-triangle"></i> Low stock: {{ $product->stock }} left</small>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection