@extends('layouts.app')

@section('title', 'Submit Your Testimonial - ByteWave')

@section('content')
<!-- Hero Banner -->
<section class="relative bg-gradient-to-br from-bytewave-gold to-orange-500 py-20 md:py-32 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-6">
            <div class="w-2 h-2 bg-white rounded-full"></div>
            <span class="text-sm font-semibold text-white uppercase tracking-wide">Your Voice Matters</span>
        </div>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
            Share Your <span class="text-gray-900">Experience</span>
        </h1>

        <!-- Description -->
        <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto">
            We'd love to hear about your experience working with ByteWave. Your feedback helps us improve and inspires others.
        </p>

        <!-- Icon -->
        <div class="flex justify-center mb-8">
            <div class="w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
            </div>
        </div>
    </div>
</section>

<div class="min-h-screen py-12 md:py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Honeypot field (hidden from users, catches bots) -->
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                        Your Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title/Position -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                        Your Title/Position <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}"
                        placeholder="e.g., Project Manager"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                        required
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company -->
                <div class="mb-6">
                    <label for="company" class="block text-sm font-semibold text-gray-900 mb-2">
                        Company Name
                    </label>
                    <input 
                        type="text" 
                        id="company" 
                        name="company" 
                        value="{{ old('company') }}"
                        placeholder="e.g., Stellar Industries"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('company') border-red-500 @enderror"
                    >
                    @error('company')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Rating <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2" x-data="{ rating: {{ old('rating', 5) }}, hoverRating: 0 }">
                        @for($i = 1; $i <= 5; $i++)
                        <button 
                            type="button"
                            @click="rating = {{ $i }}"
                            @mouseenter="hoverRating = {{ $i }}"
                            @mouseleave="hoverRating = 0"
                            class="text-4xl transition-all duration-200 hover:scale-110 focus:outline-none"
                            :class="(hoverRating >= {{ $i }} || (hoverRating === 0 && rating >= {{ $i }})) ? 'text-yellow-400' : 'text-gray-300'"
                        >
                            ★
                        </button>
                        @endfor
                        <input type="hidden" name="rating" :value="rating">
                        <span class="ml-2 text-sm text-gray-600 self-center" x-text="rating + ' / 5'"></span>
                    </div>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Testimonial -->
                <div class="mb-6">
                    <label for="testimonial" class="block text-sm font-semibold text-gray-900 mb-2">
                        Your Testimonial <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="testimonial" 
                        name="testimonial" 
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('testimonial') border-red-500 @enderror"
                        placeholder="Share your experience working with ByteWave..."
                        required
                    >{{ old('testimonial') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Minimum 10 characters, maximum 1000 characters</p>
                    @error('testimonial')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Avatar Upload -->
                <div class="mb-8">
                    <label for="avatar" class="block text-sm font-semibold text-gray-900 mb-2">
                        Profile Photo (Optional)
                    </label>
                    <input 
                        type="file" 
                        id="avatar" 
                        name="avatar" 
                        accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('avatar') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-sm text-gray-500">JPG, PNG, or GIF. Max size: 2MB</p>
                    @error('avatar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button 
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl"
                    >
                        Submit Testimonial
                    </button>
                </div>
            </form>
        </div>

        <!-- Privacy Note -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Your testimonial will be reviewed by our team before being published on our website.
        </p>
    </div>
</div>
@endsection
