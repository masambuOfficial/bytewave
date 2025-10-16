@extends('layouts.app')

@section('title', $service->name . ' - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">{{ $service->name }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('services.index') }}">Services</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">{{ $service->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container py-5">
        <div class="row">
            <!-- Service Details -->
            <div class="col-lg-8">
                <div class="mb-5">
                    @if($service->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="img-fluid rounded">
                        </div>
                    @endif
                    <h2 class="text-2xl font-weight-bold mb-3">Overview</h2>
                    <p class="lead">{{ $service->description }}</p>
                </div>
            </div>

            <!-- Contact Sidebar -->
            <div class="col-lg-4">
                <div class="bg-light p-4 rounded">
                    <h3 class="text-lg font-weight-bold mb-3">Get Started</h3>
                    <p>Interested in our {{ $service->name }} service? Contact us to learn more about how we can help your business.</p>
                    <div class="mt-4">
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-block">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a href="{{ route('services.index') }}" class="text-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Services
            </a>
        </div>
    </div>
@endsection
