@extends('layouts.app')

@section('title', 'Services - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <p class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">Services</p>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:text-bytewave-gold transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Services Start -->
    <div class="py-12 relative overflow-hidden bg-bytewave-blue-50 via-white to-blue-50">
        <!-- Animated Background Shapes -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-10 w-72 h-72 bg-bytewave-blue opacity-5 rounded-full blur-3xl animate-blob"></div>
            <div class="absolute top-40 right-20 w-96 h-96 bg-bytewave-gold opacity-5 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-blue-400 opacity-5 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <!-- Section Header with Animation -->
            <div class="text-center mx-auto pb-12 max-w-2xl animate-fadeIn">
                <div class="inline-block mb-4">
                    <span class="bg-bytewave-blue/10 text-bytewave-blue px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wide">Our Services</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Services Built Specifically For 
                    <span class="text-bytewave-gold relative">
                        Your Business
                        <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5.5C50 2.5 150 2.5 199 5.5" stroke="#F59E0B" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </span>
                </h1>
                <p class="text-gray-600 mt-4 text-lg">Innovative solutions tailored to drive your business forward</p>
            </div>

            <!-- Services by Category with Accordion -->
            @php
                $servicesByCategory = $services->groupBy('category');
            @endphp
            
            <div class="space-y-4" x-data="{ openCategory: '{{ $servicesByCategory->keys()->first() }}' }">
                @forelse($servicesByCategory as $category => $categoryServices)
                    <!-- Category Accordion Item -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 animate-fadeIn">
                        <!-- Accordion Header -->
                        <button 
                            @click="openCategory = openCategory === '{{ $category }}' ? null : '{{ $category }}'"
                            class="w-full px-8 py-6 flex items-center justify-between bg-gradient-to-r from-bytewave-blue to-blue-600 hover:from-bytewave-blue-600 hover:to-blue-700 transition-all duration-300"
                        >
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                    @php
                                        $iconMap = [
                                            'ICT Solutions & Support' => 'computer',
                                            'Multimedia Production' => 'video',
                                            'Web & Software Development' => 'code',
                                            'Digital Marketing' => 'chart'
                                        ];
                                        $iconName = $iconMap[$category] ?? 'computer';
                                    @endphp
                                    
                                    @if($iconName === 'computer')
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    @elseif($iconName === 'video')
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    @elseif($iconName === 'code')
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="text-left">
                                    <h3 class="text-2xl font-bold text-white">{{ $category ?? 'Uncategorized' }}</h3>
                                    <p class="text-blue-100 text-sm">{{ $categoryServices->count() }} {{ Str::plural('service', $categoryServices->count()) }}</p>
                                </div>
                            </div>
                            <svg 
                                class="w-6 h-6 text-white transition-transform duration-300"
                                :class="{ 'rotate-180': openCategory === '{{ $category }}' }"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Accordion Content -->
                        <div 
                            x-show="openCategory === '{{ $category }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0"
                            x-transition:enter-end="opacity-100 max-h-screen"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 max-h-screen"
                            x-transition:leave-end="opacity-0 max-h-0"
                            class="overflow-hidden"
                        >
                            <div class="p-8 bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($categoryServices as $service)
                                        <div class="bg-white rounded-xl shadow hover:shadow-xl transition-all duration-300 overflow-hidden group">
                                            <!-- Image -->
                                            <div class="relative h-48 overflow-hidden">
                                                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('css/img/bytewave_livestreaming.jpg') }}" 
                                                     alt="{{ $service->name }}" 
                                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="p-6">
                                                <h4 class="text-xl font-bold text-gray-900 mb-3">{{ $service->name }}</h4>
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($service->description, 120) }}</p>
                                                
                                                <a href="{{ Str::contains($service->name, 'Audio-Visual') || Str::contains($service->name, 'Audio Visual') ? route('services.audio-visual') : route('services.show', $service->id) }}"
                                                   class="inline-flex items-center gap-2 text-bytewave-blue hover:text-blue-700 font-semibold transition-colors duration-300 group/link">
                                                    Learn More
                                                    <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="inline-block p-8 bg-white rounded-2xl shadow-lg">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-xl text-gray-600">No services available at the moment.</p>
                            <p class="text-gray-500 mt-2">Check back soon for exciting new offerings!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Services End -->

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
    
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        25% {
            transform: translate(20px, -50px) scale(1.1);
        }
        50% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        75% {
            transform: translate(50px, 50px) scale(1.05);
        }
    }

    
    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out;
    }
    
    .animate-fadeIn {
        animation: fadeInDown 0.8s ease-out;
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Service Card Stagger Animation */
    .service-card:nth-child(1) {
        animation-delay: 0.1s;
    }
    
    .service-card:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .service-card:nth-child(3) {
        animation-delay: 0.3s;
    }
    
    .service-card:nth-child(4) {
        animation-delay: 0.4s;
    }
    
    .service-card:nth-child(5) {
        animation-delay: 0.5s;
    }
    
    .service-card:nth-child(6) {
        animation-delay: 0.6s;
    }
</style>
@endsection
