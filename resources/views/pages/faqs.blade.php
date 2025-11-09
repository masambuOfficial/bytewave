@extends('layouts.app')

@section('title', 'Frequently Asked Questions - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="w-full bg-cover bg-center bg-no-repeat relative flex items-center justify-center wow fadeIn" data-wow-delay="0.1s" style="min-height: 450px; background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('css/img/bg-1.jpg') }}');">
        <div class="max-w-7xl mx-auto px-4 text-center py-20">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-yellow-400 mb-6 animated slideInDown">FAQs</h1>
            <nav aria-label="breadcrumb" class="animated slideInDown">
                <ol class="flex items-center justify-center gap-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:text-yellow-400 transition-colors duration-300">Home</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-yellow-400" aria-current="page">FAQs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- FAQs Start -->
    <div class="py-16 md:py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <div class="w-full">
                    <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="text-3xl md:text-4xl font-bold text-bytewave-blue mb-6">General Questions</h2>
                    <div class="flex flex-col gap-3">
                        <!-- Question 1 -->
                        <div x-data="{ open: true }" class="border border-gray-300 rounded-lg bg-white shadow-sm">
                            <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                                <span>What services does BYTEWAVE offer?</span>
                                <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 text-yellow-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-5 pb-5 border-t border-gray-300 bg-gray-50">
                                <p class="text-gray-800 leading-relaxed mt-4">
                                    BYTEWAVE offers a comprehensive range of digital services including web development, mobile app development, cloud solutions, digital marketing, and IT consulting. We specialize in creating custom solutions tailored to your business needs.
                                </p>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white shadow-sm">
                            <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                                <span>How long has BYTEWAVE been in business?</span>
                                <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 text-yellow-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-5 pb-5 border-t border-gray-300 bg-gray-50">
                                <p class="text-gray-800 leading-relaxed mt-4">
                                    BYTEWAVE has been providing digital solutions in Uganda and East Africa for over 5 years. Our team has extensive experience in the technology sector and has successfully delivered numerous projects across various industries.
                                </p>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white shadow-sm">
                            <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                                <span>What makes BYTEWAVE different from other companies?</span>
                                <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 text-yellow-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-5 pb-5 border-t border-gray-300 bg-gray-50">
                                <p class="text-gray-800 leading-relaxed mt-4">
                                    We stand out through our commitment to quality, innovative solutions, local expertise, and dedicated customer support. Our team stays up-to-date with the latest technologies to deliver cutting-edge solutions that drive business growth.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="w-full">
                    <!-- Technical Questions -->
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#0773B8] mb-6">Technical Questions</h2>
                    <div class="flex flex-col gap-3">
                        <!-- Question 1 -->
                        <div x-data="{ open: true }" 
                            class="border border-gray-300 rounded-lg bg-white shadow-sm">
                            <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                                <span>What technologies do you use?</span>
                                <svg :class="open ? 'rotate-180' : ''" 
                                    class="w-6 h-6 text-yellow-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition 
                                class="px-5 pb-5 border-t border-gray-300 bg-gray-50">
                                <p class="text-gray-800 leading-relaxed mt-4">
                                    We use a wide range of modern technologies including Laravel, React, Vue.js, Flutter, AWS, and more. Our technology stack is chosen based on project requirements to ensure the best possible solution for each client.
                                </p>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white shadow-sm">
                            <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                                <span>How do you ensure project security?</span>
                                <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 text-yellow-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-5 pb-5 border-t border-gray-300 bg-gray-50">
                                <p class="text-gray-800 leading-relaxed mt-4">
                                    We implement industry-standard security practices including SSL encryption, secure coding practices, regular security audits, and data encryption. We also provide security training to our team and stay updated on the latest security threats.
                                </p>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div x-data="{ open: false }" class="border border-gray-300 rounded-lg bg-white shadow-sm">
                            <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                                <span>Do you provide maintenance and support?</span>
                                <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 text-yellow-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="px-5 pb-5 border-t border-gray-300 bg-gray-50">
                                <p class="text-gray-800 leading-relaxed mt-4">
                                    Yes, we offer comprehensive maintenance and support packages. Our support team is available during business hours, and we provide emergency support for critical issues. We also offer regular updates and monitoring services.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Contact Section -->
            <div class="wow fadeInUp mt-12" data-wow-delay="0.5s">
                <div class="relative bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-2xl p-8 md:p-12 overflow-hidden shadow-2xl">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 opacity-10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-yellow-400 opacity-10 rounded-full -ml-24 -mb-24"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                        <div class="w-full md:w-1/2 md:text-left">
                            <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">Still Have Questions?</h3>
                            <p class="text-blue-100 text-lg leading-relaxed">Can't find the answer you're looking for? Please contact our friendly team and we'll be happy to help.</p>
                        </div>
                        <div class="w-full md:w-1/2 flex flex-col sm:flex-row gap-4 justify-center md:justify-end">
                            <a href="{{ url('/contact') }}" class="inline-flex items-center justify-center bg-yellow-400 text-gray-900 font-bold px-6 py-3 rounded-lg shadow-lg hover:bg-yellow-300 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                                <span>Contact Us</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                            <a href="tel:+256123456789" class="inline-flex items-center justify-center bg-white text-blue-700 font-bold px-6 py-3 rounded-lg shadow-lg hover:bg-gray-50 hover:shadow-2xl hover:scale-105 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>Call Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- FAQs End -->
@endsection
