@extends('layouts.app')

@section('title', 'Contact Us - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20 mb-12" style="background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('{{ asset('css/img/bytewave_computer_repair_and_maintenance.jpg') }}') center center no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-bytewave-gold mb-6 animate-fadeInDown">Contact Us</h1>
            <nav aria-label="breadcrumb" class="animate-fadeInDown">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:text-bytewave-gold transition-colors">Home</a></li>
                    <li class="text-white/50">/</li>
                    <li class="text-bytewave-gold" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mx-auto max-w-2xl mb-12">
                <h5 class="text-bytewave-blue font-semibold text-base uppercase tracking-wider mb-4">Get In Touch</h5>
                <h1 class="text-3xl md:text-4xl font-bold text-bytewave-gold mb-6">Contact Us for Any Query</h1>
                <p class="text-gray-600 text-lg">Have questions about our services? Need technical support? Want to discuss a project? We're here to help!</p>
            </div>

            <!-- Contact Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-8 text-center rounded-xl shadow-lg hover:-translate-y-2 transition-all duration-500 h-full">
                    <div class="w-16 h-16 bg-bytewave-blue rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Our Location</h4>
                    <p class="text-gray-600 mb-2">Kampala, Uganda</p>
                    <a href="https://goo.gl/maps/yourlink" target="_blank" class="text-bytewave-blue hover:text-bytewave-gold transition-colors inline-flex items-center">
                        Get Directions <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <div class="bg-white p-8 text-center rounded-xl shadow-lg hover:-translate-y-2 transition-all duration-500 h-full">
                    <div class="w-16 h-16 bg-bytewave-blue rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone-alt text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Call Us</h4>
                    <p class="text-gray-600 mb-2">24/7 Support Line</p>
                    <a href="tel:+256773448069" class="text-bytewave-blue hover:text-bytewave-gold transition-colors">+256773448069/+256782440907</a>
                </div>
                <div class="bg-white p-8 text-center rounded-xl shadow-lg hover:-translate-y-2 transition-all duration-500 h-full">
                    <div class="w-16 h-16 bg-bytewave-blue rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-4">Email Us</h4>
                    <p class="text-gray-600 mb-2">For General Inquiries</p>
                    <a href="mailto:info@bytewave.com" class="text-bytewave-blue hover:text-bytewave-gold transition-colors">info@bytewave.com</a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                <!-- Map -->
                <div class="animate-fadeIn flex">
                    <div class="w-full">
                        <div class="rounded-xl overflow-hidden shadow-lg h-full min-h-[450px]">
                            <iframe class="w-full h-full"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7538176143337!2d32.58561661475455!3d0.3152859997438399!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb0932c4cd25%3A0x2f4c1fb25bc80b73!2sKampala%2C%20Uganda!5e0!3m2!1sen!2sus!4v1675946338901!5m2!1sen!2sus"
                                style="border: 0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="animate-fadeIn">
                    <div>
                        @if(session('success'))
                            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg flex items-center justify-between" role="alert" x-data="{ show: true }" x-show="show">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                                    <span>{{ session('success') }}</span>
                                </div>
                                <button @click="show = false" class="text-green-700 hover:text-green-900">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg flex items-center justify-between" role="alert" x-data="{ show: true }" x-show="show">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                                    <span>{{ session('error') }}</span>
                                </div>
                                <button @click="show = false" class="text-red-700 hover:text-red-900">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                                    <input type="text" 
                                           class="w-full px-4 py-3 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-bytewave-blue focus:border-transparent transition-all" 
                                           id="name" name="name" placeholder="Your Name" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Your Email</label>
                                    <input type="email" 
                                           class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-bytewave-blue focus:border-transparent transition-all" 
                                           id="email" name="email" placeholder="Your Email"
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border @error('subject') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-bytewave-blue focus:border-transparent transition-all" 
                                       id="subject" name="subject" placeholder="Subject"
                                       value="{{ old('subject') }}" required>
                                @error('subject')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea 
                                    class="w-full px-4 py-3 border @error('message') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-bytewave-blue focus:border-transparent transition-all" 
                                    id="message" name="message" placeholder="Leave a message here" 
                                    rows="6" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button class="bg-bytewave-gold text-white font-semibold py-3 px-8 rounded-full hover:bg-bytewave-gold-600 transition-all duration-300 hover:scale-105 shadow-lg inline-flex items-center" type="submit">
                                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('styles')
<style>
    /* Fade in animation */
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
    
    .animate-fadeIn {
        animation: fadeInDown 0.8s ease-out;
    }
</style>
@endsection