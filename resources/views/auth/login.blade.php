@extends('layouts.auth')

@section('title', 'Login - BYTEWAVE')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">

    <a href="{{ url('/') }}" class="mb-8 text-bytewave-ink/70 hover:text-bytewave-blue transition-colors text-sm font-medium inline-flex items-center gap-2">
        <i class="fas fa-arrow-left text-xs"></i> Back to website
    </a>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-bytewave-blue/20 overflow-hidden">
        <!-- Brand Header -->
        <div class="bg-bytewave-blue py-8 px-8 text-center">
            <img src="{{ asset('images/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE" class="h-7 mx-auto mb-3">
            <p class="text-white text-sm">Sign in to manage your account</p>
        </div>

        <!-- Form -->
        <div class="p-8">
            @if ($errors->any())
                <div class="flex items-start gap-3 bg-bytewave-danger-bg border border-bytewave-danger/20 text-bytewave-danger text-sm rounded-lg px-4 py-3 mb-6">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-bytewave-ink mb-1.5">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full px-4 py-2.5 border border-bytewave-ink/50 rounded-lg text-bytewave-ink placeholder-bytewave-ink/70 focus:outline-none focus:ring-2 focus:ring-bytewave-blue/20 focus:border-bytewave-blue transition-colors @error('email') border-bytewave-danger @enderror"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required
                        autofocus>
                    @error('email')
                        <p class="mt-1.5 text-xs text-bytewave-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-medium text-bytewave-ink">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-bytewave-blue hover:text-bytewave-ink">Forgot password?</a>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2.5 border border-bytewave-ink/50 rounded-lg text-bytewave-ink placeholder-bytewave-ink/70 focus:outline-none focus:ring-2 focus:ring-bytewave-blue/20 focus:border-bytewave-blue transition-colors @error('password') border-bytewave-danger @enderror"
                        placeholder="••••••••"
                        required>
                    @error('password')
                        <p class="mt-1.5 text-xs text-bytewave-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-2 mb-6">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-bytewave-ink/50 text-bytewave-blue focus:ring-bytewave-blue">
                    <label for="remember" class="text-sm text-bytewave-ink/70">Remember me for 30 days</label>
                </div>

                <!-- Submit Button -->
                <x-cta-button type="submit" text="Sign In" full-width />
            </form>
        </div>
    </div>

    <p class="mt-8 text-xs text-bytewave-ink/70 text-center">&copy; {{ date('Y') }} {{ config('company.name', 'ByteWave Investments') }}. All rights reserved.</p>
</div>
@endsection
