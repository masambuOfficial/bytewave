@extends('layouts.app')

@section('title', 'Services - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Services Start -->
    <div class="container-fluid services py-5 my-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Services</h5>
                <h1 class="text-warning">Services Built Specifically For Your Business</h1>
            </div>
            <div class="row g-4 services-inner">
                @forelse($services as $service)
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" 
                                             alt="{{ $service->name }}" 
                                             class="img-fluid mb-4 rounded"
                                             style="max-height: 200px; width: auto;">
                                    @else
                                        <i class="fa {{ $service->icon ?? 'fa-cogs' }} fa-3x mb-4 text-primary"></i>
                                    @endif
                                    <h4 class="mb-3">{{ $service->name }}</h4>
                                    <p class="mb-4">{{ Str::limit($service->description, 150) }}</p>
                                    <a href="{{ route('services.show', $service->id) }}"
                                       class="btn btn-warning text-white px-5 py-3 rounded-pill">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="lead">No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Services End -->


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
</style>
@endsection
