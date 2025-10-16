@extends('layouts.admin')

@section('title', 'Products')

@push('styles')
<style>
    .product-card {
        transition: transform 0.2s;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .product-image {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }
    .action-buttons {
        transition: opacity 0.2s;
        opacity: 0;
    }
    .product-card:hover .action-buttons {
        opacity: 1;
    }
    .price-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: bold;
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
                    <div class="card shadow product-card h-100">
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
                            ${{ number_format($product->price, 2) }}
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                            
                            <div class="action-buttons">
                                <hr>
                                <div class="btn-group w-100">
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
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