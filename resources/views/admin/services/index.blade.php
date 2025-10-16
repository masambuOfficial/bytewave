@extends('layouts.admin')

@section('title', 'Services')

@push('styles')
<style>
    .service-card {
        transition: transform 0.2s;
    }
    .service-card:hover {
        transform: translateY(-5px);
    }
    .service-image {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }
    .action-buttons {
        transition: opacity 0.2s;
        opacity: 0;
    }
    .service-card:hover .action-buttons {
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Website Services</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Service
        </a>
    </div>

    @if($services->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-cogs fa-4x text-muted mb-3"></i>
            <p class="text-muted">No services found.</p>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                Add your first service
            </a>
        </div>
    @else
        <div class="row">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow service-card h-100">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->name }}" 
                                 class="service-image">
                        @else
                            <div class="service-image bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-cog fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($service->description, 100) }}
                            </p>
                            
                            <div class="action-buttons">
                                <hr>
                                <div class="btn-group w-100">
                                    <a href="{{ route('admin.services.edit', $service) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection