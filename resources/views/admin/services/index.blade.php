@extends('layouts.admin')

@section('title', 'Services')

@push('styles')
<style>
    .services-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .services-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .services-header p {
        color: #6B7A85;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-service {
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

    .btn-add-service:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .service-card {
        background: #fff;
        border: 1px solid #EEF1F4;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .service-card:hover {
        box-shadow: 0 12px 28px rgba(4, 69, 110, 0.1);
        transform: translateY(-3px);
    }

    .service-image {
        height: 180px;
        object-fit: cover;
        width: 100%;
        display: block;
    }

    .service-image-placeholder {
        height: 180px;
        background: var(--bytewave-blue-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-image-placeholder i {
        font-size: 2.25rem;
        color: var(--bytewave-blue);
        opacity: 0.5;
    }

    .service-card-body {
        padding: 1.25rem 1.35rem 1.1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .service-card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: #1F2A33;
        margin-bottom: 0.4rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .service-card-text {
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

    .service-card-actions {
        display: flex;
        gap: 0.5rem;
        border-top: 1px solid #F1F3F5;
        padding-top: 0.9rem;
        margin-top: auto;
    }

    .service-action-btn {
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

    .service-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .service-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .service-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .service-action-btn.delete:hover {
        background: #E74C3C;
        color: #fff;
    }

    .service-action-form {
        flex: 1;
        display: flex;
    }

    .services-empty {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border: 1px dashed #DCE3E8;
        border-radius: 16px;
    }

    .services-empty i {
        font-size: 2.75rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .services-empty p {
        color: #6B7A85;
        margin-bottom: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="services-header">
        <div>
            <h1>Website Services</h1>
            <p>Manage the services displayed on your public website.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn-add-service">
            <i class="fas fa-plus"></i> Add New Service
        </a>
    </div>

    @if($services->isEmpty())
        <div class="services-empty">
            <i class="fas fa-cogs"></i>
            <p>No services found.</p>
            <a href="{{ route('admin.services.create') }}" class="btn-add-service">
                Add your first service
            </a>
        </div>
    @else
        <div class="services-grid">
            @foreach($services as $service)
                <div class="service-card">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}"
                             alt="{{ $service->name }}"
                             class="service-image">
                    @else
                        <div class="service-image-placeholder">
                            <i class="fas fa-cog"></i>
                        </div>
                    @endif

                    <div class="service-card-body">
                        <h5 class="service-card-title">{{ $service->name }}</h5>
                        <p class="service-card-text">
                            {{ Str::limit($service->description, 100) }}
                        </p>

                        <div class="service-card-actions">
                            <a href="{{ route('admin.services.edit', $service) }}"
                               class="service-action-btn edit"
                               title="Edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}"
                                  method="POST"
                                  class="service-action-form"
                                  onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="service-action-btn delete"
                                        title="Delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
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
