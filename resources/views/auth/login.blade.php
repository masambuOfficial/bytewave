@extends('layouts.auth')

@section('title', 'Login - BYTEWAVE')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">

    <a href="{{ url('/') }}" class="mb-8 text-gray-400 hover:text-blue-600 transition-colors text-sm font-medium inline-flex items-center gap-2">
        <i class="fas fa-arrow-left text-xs"></i> Back to website
    </a>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <!-- Brand Header -->
        <div class="bg-blue-600 py-8 px-8 text-center">
            <img src="{{ asset('css/img/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="BYTEWAVE" class="h-7 mx-auto mb-3">
            <p class="text-blue-100 text-sm">Sign in to manage your account</p>
        </div>

        <!-- Form -->
        <div class="p-8">
            @if ($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-100 text-red-700 text-sm rounded-lg px-4 py-3 mb-6">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition-colors @error('email') border-red-400 @enderror"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required
                        autofocus>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-5">
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700">Forgot password?</a>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-500 transition-colors @error('password') border-red-400 @enderror"
                        placeholder="••••••••"
                        required>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-2 mb-6">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember" class="text-sm text-gray-600">Remember me for 30 days</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                    Sign In <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </form>
        </div>
    </div>

    <p class="mt-8 text-xs text-gray-400 text-center">&copy; {{ date('Y') }} {{ config('company.name', 'ByteWave Investments') }}. All rights reserved.</p>
</div>
@endsection
