@extends('layouts.admin')

@section('title', 'Products')

@push('styles')
<style>
    .products-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .products-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .products-header p {
        color: #6B7A85;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-product {
        background: var(--bytewave-blue);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        white-space: nowrap;
    }

    .btn-add-product:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1.5rem;
    }

    .product-card {
        background: #fff;
        border: 1px solid #EEF1F4;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .product-card:hover {
        box-shadow: 0 12px 28px rgba(4, 69, 110, 0.1);
        transform: translateY(-3px);
    }

    .product-media {
        position: relative;
    }

    .product-image {
        height: 190px;
        width: 100%;
        object-fit: cover;
        display: block;
    }

    .product-image-placeholder {
        height: 190px;
        background: var(--bytewave-blue-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image-placeholder i {
        font-size: 2.25rem;
        color: var(--bytewave-blue);
        opacity: 0.5;
    }

    .price-tag {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--bytewave-gold);
        color: #4A3300;
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 6px 16px rgba(251, 177, 69, 0.35);
    }

    .billing-badge {
        position: absolute;
        top: 52px;
        right: 12px;
        background: rgba(255, 255, 255, 0.92);
        color: var(--bytewave-blue-dark);
        padding: 0.3rem 0.65rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .product-card-body {
        padding: 1.25rem 1.35rem 1.1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-card-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.5rem;
        margin-bottom: 0.4rem;
    }

    .product-card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: #1F2A33;
    }

    .product-card-category {
        color: #8A97A0;
        font-size: 0.78rem;
        font-weight: 600;
        white-space: nowrap;
        margin-top: 0.15rem;
    }

    .product-card-text {
        color: #6B7A85;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1.1rem;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .low-stock-banner {
        background: rgba(251, 177, 69, 0.12);
        color: #92600C;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.6rem 1.35rem;
        border-top: 1px solid rgba(251, 177, 69, 0.25);
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .product-card-actions {
        display: flex;
        gap: 0.5rem;
        border-top: 1px solid #F1F3F5;
        padding-top: 0.9rem;
        margin-top: auto;
    }

    .product-action-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        border: none;
        border-radius: 9px;
        padding: 0.5rem 0.75rem;
        font-size: 0.82rem;
        font-weight: 600;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .product-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .product-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .product-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .product-action-btn.delete:hover {
        background: #E74C3C;
        color: #fff;
    }

    .product-action-form {
        flex: 1;
        display: flex;
    }

    .products-empty {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border: 1px dashed #DCE3E8;
        border-radius: 16px;
    }

    .products-empty i {
        font-size: 2.75rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .products-empty p {
        color: #6B7A85;
        margin-bottom: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="products-header">
        <div>
            <h1>Products</h1>
            <p>Manage the products available on your website.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-add-product">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    @if($products->isEmpty())
        <div class="products-empty">
            <i class="fas fa-box-open"></i>
            <p>No products found.</p>
            <a href="{{ route('admin.products.create') }}" class="btn-add-product">
                Add your first product
            </a>
        </div>
    @else
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-media">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="product-image">
                        @else
                            <div class="product-image-placeholder">
                                <i class="fas fa-box"></i>
                            </div>
                        @endif

                        <div class="price-tag">{{ $product->formatted_price }}</div>
                        <div class="billing-badge">{{ $product->billing_cycle_label }}</div>
                    </div>

                    <div class="product-card-body">
                        <div class="product-card-title-row">
                            <h5 class="product-card-title">{{ $product->name }}</h5>
                            <span class="product-card-category">{{ $product->category }}</span>
                        </div>
                        <p class="product-card-text">
                            {{ Str::limit($product->description, 110) }}
                        </p>

                        <div class="product-card-actions">
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="product-action-btn edit"
                               title="Edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}"
                                  method="POST"
                                  class="product-action-form"
                                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="product-action-btn delete"
                                        title="Delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    @if($product->stock < 10)
                        <div class="low-stock-banner">
                            <i class="fas fa-exclamation-triangle"></i> Low stock: {{ $product->stock }} left
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
