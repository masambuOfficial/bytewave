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
                    </div>
                    <div style="position:relative;">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        style="padding-right:3rem;" class="w-full pl-4 py-2.5 border border-bytewave-ink/50 rounded-lg text-bytewave-ink placeholder-bytewave-ink/70 focus:outline-none focus:ring-2 focus:ring-bytewave-blue/20 focus:border-bytewave-blue transition-colors @error('password') border-bytewave-danger @enderror"
                        placeholder="••••••••"
                        required>
                        <button type="button" id="togglePassword" style="position:absolute;top:0;bottom:0;right:0;display:flex;align-items:center;padding:0 .85rem;background:none;border:0;cursor:pointer;color:#546270;" class="hover:text-bytewave-blue focus:outline-none focus-visible:ring-2 focus-visible:ring-bytewave-blue/40 rounded-r-lg" aria-label="Show password" aria-pressed="false">
                            <svg id="eyeShow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg id="eyeHide" width="20" height="20" style="display:none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.9 17.9A10.4 10.4 0 0 1 12 19c-6.4 0-10-7-10-7a17.6 17.6 0 0 1 4.1-4.9M9.9 5.2A9.7 9.7 0 0 1 12 5c6.4 0 10 7 10 7a17.7 17.7 0 0 1-2.1 3M3 3l18 18M9.9 9.9a3 3 0 0 0 4.2 4.2"/></svg>
                        </button>
                    </div>
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

@section('scripts')
<script>
    (function () {
        var btn = document.getElementById('togglePassword');
        var input = document.getElementById('password');
        if (!btn || !input) return;
        btn.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            document.getElementById('eyeShow').style.display = show ? 'none' : '';
            document.getElementById('eyeHide').style.display = show ? '' : 'none';
        });
    })();
</script>
@endsection
