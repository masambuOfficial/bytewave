@extends('layouts.app')

@section('title', 'FAQs – Web, Software & IT Services in Uganda | ByteWave')
@section('meta_description', 'Answers to common questions about BYTEWAVE\'s web development, mobile app, cloud, digital marketing, and IT consulting services in Uganda and East Africa.')

@php
    $faqCategories = [
        [
            'title' => 'General Questions',
            'color' => 'text-bytewave-blue',
            'delay' => '0.1s',
            'items' => [
                [
                    'q' => 'What services does BYTEWAVE offer?',
                    'a' => 'BYTEWAVE offers a comprehensive range of digital services including web development, mobile app development, cloud solutions, digital marketing, and IT consulting. We specialize in creating custom solutions tailored to your business needs.',
                ],
                [
                    'q' => 'How long has BYTEWAVE been in business?',
                    'a' => 'BYTEWAVE has been providing digital solutions in Uganda and East Africa for over 5 years. Our team has extensive experience in the technology sector and has successfully delivered numerous projects across various industries.',
                ],
                [
                    'q' => 'What makes BYTEWAVE different from other companies?',
                    'a' => 'We stand out through our commitment to quality, innovative solutions, local expertise, and dedicated customer support. Our team stays up-to-date with the latest technologies to deliver cutting-edge solutions that drive business growth.',
                ],
                [
                    'q' => 'Does BYTEWAVE work with clients outside Uganda?',
                    'a' => 'Yes. Our office is based in Kampala, but we work with clients both locally and internationally. Web, mobile, design, and software projects can be run fully remotely, and we also offer a hybrid model — combining remote collaboration with in-person meetings or site visits for clients who prefer it. We\'ve delivered projects for organizations across Uganda, including SACCOs, national institutions, and businesses outside the capital, and are set up to work with remote clients the same way.',
                ],
                [
                    'q' => 'How long does a typical project take?',
                    'a' => 'It depends on the size and complexity of the project — a straightforward website differs significantly from a custom software system. We provide a project timeline as part of every quotation, so you know what to expect before work begins.',
                ],
                [
                    'q' => 'What are your payment terms?',
                    'a' => 'Payment terms are agreed per project and outlined in your quotation, typically structured around project milestones rather than a single lump sum. Full details are confirmed before any work begins — see our Terms of Service for our general payment policy.',
                ],
            ],
        ],
        [
            'title' => 'Technical Questions',
            'color' => 'text-bytewave-blue',
            'delay' => '0.3s',
            'items' => [
                [
                    'q' => 'What technologies do you use?',
                    'a' => 'We use a wide range of modern technologies including Laravel, React, Vue.js, Flutter, AWS, and more. Our technology stack is chosen based on project requirements to ensure the best possible solution for each client.',
                ],
                [
                    'q' => 'How do you ensure project security?',
                    'a' => 'We implement industry-standard security practices including SSL encryption, secure coding practices, regular security audits, and data encryption. We also provide security training to our team and stay updated on the latest security threats.',
                ],
                [
                    'q' => 'Do you provide maintenance and support?',
                    'a' => 'Yes, we offer comprehensive maintenance and support packages. Our support team is available during business hours, and we provide emergency support for critical issues. We also offer regular updates and monitoring services.',
                ],
            ],
        ],
    ];
@endphp

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach($faqCategories as $category)
            @foreach($category['items'] as $item)
                {
                    "@type": "Question",
                    "name": @json($item['q']),
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": @json($item['a'])
                    }
                }@if(!$loop->last),@endif
            @endforeach{{ !$loop->last ? ',' : '' }}
        @endforeach
    ]
}
</script>
@endpush

@push('schema')
    <x-breadcrumb-schema :items="['Home' => route('home'), 'FAQs' => url()->current()]" />
@endpush

@section('content')
    <!-- Page Header Start -->
    <div class="w-full bg-cover bg-center bg-no-repeat relative flex items-center justify-center wow fadeIn" data-wow-delay="0.1s" style="min-height: 450px; background-image: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}'); background-color: #0B1F33;">
        <div class="max-w-7xl mx-auto px-4 text-center py-20">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 animated slideInDown">FAQs</h1>
            <nav aria-label="breadcrumb" class="animated slideInDown">
                <ol class="flex items-center justify-center gap-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline transition-colors duration-300">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li class="text-white" aria-current="page">FAQs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- FAQs Start -->
    <div class="relative isolate py-16 md:py-20 bg-bytewave-blue/5">
        <x-bg-art layout="tint" />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                @foreach($faqCategories as $category)
                    <div class="w-full">
                        <div class="wow fadeInUp" data-wow-delay="{{ $category['delay'] }}">
                            <h2 class="text-3xl md:text-4xl font-bold {{ $category['color'] }} mb-6">{{ $category['title'] }}</h2>
                            <div class="flex flex-col gap-3">
                                @foreach($category['items'] as $index => $item)
                                    <div x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }" class="border border-bytewave-ink/50 rounded-lg bg-white shadow-sm">
                                        <button @click="open = !open" class="w-full p-3 text-left flex items-center justify-between bg-transparent border-0 cursor-pointer text-base font-semibold text-bytewave-ink hover:bg-bytewave-blue/5 transition-colors">
                                            <span>{{ $item['q'] }}</span>
                                            <svg :class="open ? 'rotate-180' : ''" class="w-6 h-6 text-bytewave-blue transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open" x-transition class="px-5 pb-5 border-t border-bytewave-ink/50 bg-bytewave-blue/5">
                                            <p class="text-bytewave-ink leading-relaxed mt-4">
                                                {{ $item['a'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Contact Section -->
            <div class="wow fadeInUp mt-12" data-wow-delay="0.5s">
                <div class="relative bg-bytewave-blue rounded-2xl p-8 md:p-12 overflow-hidden shadow-2xl">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                        <div class="w-full md:w-1/2 md:text-left">
                            <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">Still Have Questions?</h3>
                            <p class="text-white text-lg leading-relaxed">Can't find the answer you're looking for? Please contact our friendly team and we'll be happy to help.</p>
                        </div>
                        <div class="w-full md:w-1/2 flex flex-col sm:flex-row gap-4 justify-center md:justify-end">
                            <x-cta-button :href="url('/contact')" text="Contact Us" variant="light" />
                            <x-cta-button :href="'tel:' . str_replace(' ', '', config('company.phone'))" text="Call Now" variant="light" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs End -->
@endsection
