@extends('layouts.app')

@section('title', 'Help Center – ByteWave Investments')
@section('meta_description', 'Find help and support for ByteWave Investments services and products, including how to get started, request a quote and contact our team.')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Help Center</h1>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li class="text-white" aria-current="page">Help</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Help Center Start -->
    <div class="relative isolate py-12 md:py-20">
        <x-bg-art layout="tint" />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Quick help -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                @php
                    $help = [
                        ['icon' => 'fa-headset', 'title' => 'Live Support', 'text' => 'Get immediate assistance from our expert support team during business hours.', 'button' => 'Start Chat', 'href' => '#', 'onclick' => 'initLiveChat()'],
                        ['icon' => 'fa-ticket-alt', 'title' => 'Support Ticket', 'text' => 'Create a support ticket for technical issues or complex inquiries.', 'button' => 'Submit Ticket', 'href' => url('/contact'), 'onclick' => null],
                        ['icon' => 'fa-book', 'title' => 'Knowledge Base', 'text' => 'Browse our extensive collection of guides, tutorials, and FAQs.', 'button' => 'Browse Articles', 'href' => url('/faqs'), 'onclick' => null],
                    ];
                @endphp
                @foreach ($help as $card)
                    <div class="flex flex-col rounded-xl border border-bytewave-blue/20 bg-white p-6 transition-transform duration-300 hover:-translate-y-1">
                        <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-bytewave-blue/10 text-bytewave-blue">
                            <i class="fas {{ $card['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-bytewave-ink mb-2">{{ $card['title'] }}</h3>
                        <p class="text-bytewave-ink/70 mb-6">{{ $card['text'] }}</p>
                        <div class="mt-auto">
                            @if ($card['onclick'])
                                <x-cta-button href="{{ $card['href'] }}" onclick="{{ $card['onclick'] }}" text="{{ $card['button'] }}" size="sm" />
                            @else
                                <x-cta-button href="{{ $card['href'] }}" text="{{ $card['button'] }}" size="sm" />
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14">

                <!-- Popular topics -->
                <div>
                    <p class="text-bytewave-blue font-semibold text-sm uppercase tracking-wider mb-2 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Quick answers</p>
                    <h2 class="text-3xl font-bold text-bytewave-ink mb-6">Popular Topics</h2>
                    <div class="space-y-4">
                        @php
                            $topics = [
                                'Getting Started' => ['How to request a quote', 'Project development process', 'Payment methods', 'Service level agreements'],
                                'Technical Support' => ['Website maintenance', 'Mobile app updates', 'Cloud hosting services', 'Security measures'],
                            ];
                        @endphp
                        @foreach ($topics as $heading => $items)
                            <div class="rounded-xl border border-bytewave-blue/20 bg-white p-6">
                                <h3 class="font-bold text-bytewave-ink mb-3">{{ $heading }}</h3>
                                <ul class="space-y-2">
                                    @foreach ($items as $item)
                                        <li>
                                            <a href="#" class="inline-flex items-center text-bytewave-ink/70 transition-colors hover:text-bytewave-blue">
                                                <i class="fas fa-angle-right text-bytewave-blue mr-2"></i>{{ $item }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Contact information -->
                <div>
                    <p class="text-bytewave-blue font-semibold text-sm uppercase tracking-wider mb-2 before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Talk to us</p>
                    <h2 class="text-3xl font-bold text-bytewave-ink mb-6">Contact Information</h2>
                    <div class="rounded-xl border border-bytewave-blue/20 bg-white p-6 space-y-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-bytewave-blue text-white"><i class="fas fa-phone"></i></div>
                            <div>
                                <h3 class="font-bold text-bytewave-ink">Phone</h3>
                                <p class="text-bytewave-ink">{{ config('company.phone') }}</p>
                                <p class="text-sm text-bytewave-ink/70">Monday - Friday, 9:00 AM - 5:00 PM EAT</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-bytewave-blue text-white"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h3 class="font-bold text-bytewave-ink">Email</h3>
                                <p class="text-bytewave-ink break-all">{{ config('company.email') }}</p>
                                <p class="text-sm text-bytewave-ink/70">We usually respond within 24 hours</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-bytewave-blue text-white"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h3 class="font-bold text-bytewave-ink">Office</h3>
                                <p class="text-bytewave-ink">{{ config('company.address2') }}</p>
                                <p class="text-sm text-bytewave-ink/70">{{ config('company.address3') }}, {{ config('company.address') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Help Center End -->
@endsection

@section('scripts')
<script>
    function initLiveChat() {
        // Initialize live chat functionality
        alert('Live chat feature coming soon!');
    }
</script>
@endsection
