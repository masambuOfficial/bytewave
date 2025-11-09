@extends('layouts.app')

@section('title', $service->name . ' - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20 mb-12" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">{{ $service->name }}</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:text-bytewave-gold transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:text-bytewave-gold transition-colors" href="{{ route('services.index') }}">Services</a></li>
                    <li class="before:content-['/'] before:mx-2">{{ $service->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Service Details -->
            <div class="lg:col-span-2">
                <div class="mb-12">
                    @if($service->image)
                        <div class="mb-6">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->name }}" 
                                 class="w-full h-auto rounded-lg shadow-lg">
                        </div>
                    @endif
                    <h2 class="text-3xl font-bold mb-4 text-gray-800">Overview</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">{{ $service->description }}</p>
                </div>
            </div>

            <!-- Contact Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg sticky top-24">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Get Started</h3>
                    <p class="text-gray-600 mb-6">Interested in our {{ $service->name }} service? Contact us to learn more about how we can help your business.</p>
                    <div class="mt-6">
                        <a href="{{ route('contact') }}" 
                           class="block w-full text-center bg-bytewave-blue hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <a href="{{ route('services.index') }}" 
               class="inline-flex items-center text-bytewave-blue hover:text-blue-700 font-semibold transition-colors duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Back to Services
            </a>
        </div>
    </div>
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
</style>
@endsection
