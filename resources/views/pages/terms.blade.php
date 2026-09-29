@extends('layouts.app')

@section('title', 'Terms of Service – ByteWave Investments')
@section('meta_description', 'Read the terms of service for using the ByteWave Investments website, products and services.')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Terms of Service</h1>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li class="text-white" aria-current="page">Terms of Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Terms Start -->
    <div class="relative isolate py-12 md:py-20">
        <x-bg-art layout="white" />
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Agreement to Terms</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">By accessing or using BYTEWAVE's services, you agree to be bound by these Terms of Service. If you disagree with any part of the terms, you may not access our services.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Our Services</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">BYTEWAVE provides the following digital services:</p>
                <ul class="mt-4 space-y-2 text-bytewave-ink">
                    @foreach (['Web Development & Design', 'Mobile App Development', 'Cloud Solutions', 'Digital Marketing', 'IT Consulting'] as $item)
                        <li class="flex items-start gap-3"><i class="fas fa-check text-bytewave-blue mt-1.5 text-sm"></i><span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Intellectual Property</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">The service and its original content, features, and functionality are owned by BYTEWAVE and are protected by international copyright, trademark, patent, trade secret, and other intellectual property laws.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">User Responsibilities</h2>
                <div class="rounded-xl border border-bytewave-blue/20 bg-bytewave-blue/5 p-6">
                    <h3 class="font-bold text-bytewave-ink mb-3">You agree to:</h3>
                    <ul class="space-y-2 text-bytewave-ink">
                        @foreach (['Provide accurate and complete information', 'Maintain the security of your account', 'Use services in compliance with applicable laws', 'Respect intellectual property rights'] as $item)
                            <li class="flex items-start gap-3"><i class="fas fa-check text-bytewave-blue mt-1.5 text-sm"></i><span>{{ $item }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Payment Terms</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">For services requiring payment:</p>
                <ul class="mt-4 space-y-2 text-bytewave-ink">
                    @foreach (['Payments are due as specified in service agreements', 'All fees are non-refundable unless stated otherwise', 'Late payments may incur additional charges'] as $item)
                        <li class="flex items-start gap-3"><i class="fas fa-check text-bytewave-blue mt-1.5 text-sm"></i><span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Limitation of Liability</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">BYTEWAVE shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Changes to Terms</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">We reserve the right to modify these terms at any time. We will notify users of any material changes via email or through our website.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Contact Information</h2>
                <div class="rounded-xl border border-bytewave-blue/20 bg-bytewave-blue/5 p-6 space-y-3 text-bytewave-ink">
                    <p>For questions about these Terms, please contact us:</p>
                    <p class="flex items-start gap-3"><i class="fas fa-envelope text-bytewave-blue mt-1"></i><span>Email: {{ config('company.email') }}</span></p>
                    <p class="flex items-start gap-3"><i class="fas fa-phone text-bytewave-blue mt-1"></i><span>Phone: {{ config('company.phone') }}</span></p>
                    <p class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-bytewave-blue mt-1"></i><span>Address: {{ config('company.address2') }}, {{ config('company.address3') }}, {{ config('company.address') }}</span></p>
                </div>
            </section>

        </div>
    </div>
    <!-- Terms End -->
@endsection
