@extends('layouts.app')

@section('title', 'Forgot Password - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Reset Password</h1>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li class="text-white" aria-current="page">Reset Password</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Forgot Password Start -->
    <div class="relative isolate bg-bytewave-blue/5 py-12 md:py-20">
        <x-bg-art layout="tint" />
        <div class="max-w-md mx-auto px-4 sm:px-6">
            <div class="rounded-2xl border border-bytewave-blue/20 bg-white p-8 shadow-xl">
                <div class="text-center mb-8">
                    <p class="text-bytewave-blue font-semibold text-sm uppercase tracking-wider mb-2">Forgot password?</p>
                    <h2 class="text-3xl font-bold text-bytewave-ink mb-3">Reset Your Password</h2>
                    <p class="text-bytewave-ink/70">Enter your email address and we'll send you a link to reset your password.</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 flex items-start gap-3 rounded-lg border border-bytewave-success/30 bg-bytewave-success-bg px-4 py-3 text-sm text-bytewave-success" role="alert">
                        <i class="fas fa-check-circle mt-0.5"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-bytewave-ink mb-1.5">Email Address</label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               required
                               autofocus
                               class="w-full px-4 py-2.5 border border-bytewave-ink/50 rounded-lg text-bytewave-ink placeholder-bytewave-ink/70 focus:outline-none focus:ring-2 focus:ring-bytewave-blue/20 focus:border-bytewave-blue transition-colors @error('email') border-bytewave-danger @enderror">
                        @error('email')
                            <p class="mt-1.5 text-xs text-bytewave-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-cta-button type="submit" text="Send Reset Link" full-width />

                    <p class="text-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-medium text-bytewave-blue hover:text-bytewave-ink transition-colors">
                            <i class="fas fa-arrow-left text-xs"></i>Back to Login
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!-- Forgot Password End -->
@endsection
