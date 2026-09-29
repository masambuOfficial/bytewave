@extends('layouts.app')

@section('title', 'Privacy Policy – ByteWave Investments')
@section('meta_description', 'How ByteWave Investments collects, uses and protects your personal information when you use our website and services.')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Privacy Policy</h1>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li class="text-white" aria-current="page">Privacy Policy</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Privacy Policy Start -->
    <div class="relative isolate py-12 md:py-20">
        <x-bg-art layout="white" flip />
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Introduction</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">At BYTEWAVE, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Information We Collect</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">We collect information that you provide directly to us when you:</p>
                <ul class="mt-4 space-y-2 text-bytewave-ink">
                    @foreach (['Fill out forms on our website', 'Subscribe to our newsletter', 'Request a quote or consultation', 'Contact us via email or phone'] as $item)
                        <li class="flex items-start gap-3"><i class="fas fa-check text-bytewave-blue mt-1.5 text-sm"></i><span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">How We Use Your Information</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">We use the information we collect to:</p>
                <ul class="mt-4 space-y-2 text-bytewave-ink">
                    @foreach (['Provide and maintain our services', 'Improve our website and services', 'Communicate with you about our services', 'Send you marketing communications (with your consent)'] as $item)
                        <li class="flex items-start gap-3"><i class="fas fa-check text-bytewave-blue mt-1.5 text-sm"></i><span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Data Security</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">We implement appropriate technical and organizational security measures to protect your personal information. However, please note that no method of transmission over the internet is 100% secure.</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Your Rights</h2>
                <p class="text-bytewave-ink/70 leading-relaxed">You have the right to:</p>
                <ul class="mt-4 space-y-2 text-bytewave-ink">
                    @foreach (['Access your personal information', 'Correct inaccurate information', 'Request deletion of your information', 'Opt-out of marketing communications'] as $item)
                        <li class="flex items-start gap-3"><i class="fas fa-check text-bytewave-blue mt-1.5 text-sm"></i><span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-bytewave-ink mb-3">Contact Us</h2>
                <p class="text-bytewave-ink/70 leading-relaxed mb-4">If you have any questions about this Privacy Policy, please contact us at:</p>
                <div class="rounded-xl border border-bytewave-blue/20 bg-bytewave-blue/5 p-6 space-y-3 text-bytewave-ink">
                    <p class="flex items-start gap-3"><i class="fas fa-envelope text-bytewave-blue mt-1"></i><span>Email: {{ config('company.email') }}</span></p>
                    <p class="flex items-start gap-3"><i class="fas fa-phone text-bytewave-blue mt-1"></i><span>Phone: {{ config('company.phone') }}</span></p>
                    <p class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-bytewave-blue mt-1"></i><span>Address: {{ config('company.address2') }}, {{ config('company.address3') }}, {{ config('company.address') }}</span></p>
                </div>
            </section>

        </div>
    </div>
    <!-- Privacy Policy End -->
@endsection
