@extends('layouts.app')

@section('title', 'Reset Password - BYTEWAVE')

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

    <!-- Reset Password Start -->
    <div class="relative isolate bg-bytewave-blue/5 py-12 md:py-20">
        <x-bg-art layout="tint" flip />
        <div class="max-w-md mx-auto px-4 sm:px-6">
            <div class="rounded-2xl border border-bytewave-blue/20 bg-white p-8 shadow-xl">
                <div class="text-center mb-8">
                    <p class="text-bytewave-blue font-semibold text-sm uppercase tracking-wider mb-2">Create new password</p>
                    <h2 class="text-3xl font-bold text-bytewave-ink mb-3">Set Your New Password</h2>
                    <p class="text-bytewave-ink/70">Please create a strong password that you haven't used before.</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <label for="email" class="block text-sm font-medium text-bytewave-ink mb-1.5">Email Address</label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $request->email) }}"
                               required
                               readonly
                               class="w-full px-4 py-2.5 border border-bytewave-ink/50 rounded-lg bg-bytewave-blue/5 text-bytewave-ink @error('email') border-bytewave-danger @enderror">
                        @error('email')
                            <p class="mt-1.5 text-xs text-bytewave-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-bytewave-ink mb-1.5">New Password</label>
                        <div class="relative">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Enter a new password"
                                   required
                                   class="w-full px-4 py-2.5 pr-12 border border-bytewave-ink/50 rounded-lg text-bytewave-ink placeholder-bytewave-ink/70 focus:outline-none focus:ring-2 focus:ring-bytewave-blue/20 focus:border-bytewave-blue transition-colors @error('password') border-bytewave-danger @enderror">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-bytewave-blue hover:text-bytewave-ink" onclick="togglePassword('password', this)" aria-label="Show or hide password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-bytewave-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-bytewave-ink mb-1.5">Confirm Password</label>
                        <div class="relative">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Repeat the new password"
                                   required
                                   class="w-full px-4 py-2.5 pr-12 border border-bytewave-ink/50 rounded-lg text-bytewave-ink placeholder-bytewave-ink/70 focus:outline-none focus:ring-2 focus:ring-bytewave-blue/20 focus:border-bytewave-blue transition-colors">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-bytewave-blue hover:text-bytewave-ink" onclick="togglePassword('password_confirmation', this)" aria-label="Show or hide password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <x-cta-button type="submit" text="Reset Password" full-width />
                </form>
            </div>
        </div>
    </div>
    <!-- Reset Password End -->
@endsection

@section('scripts')
<script>
    function togglePassword(fieldId, button) {
        const field = document.getElementById(fieldId);
        const icon = button.querySelector('i');
        const showing = field.type === 'text';
        field.type = showing ? 'password' : 'text';
        icon.classList.toggle('fa-eye', showing);
        icon.classList.toggle('fa-eye-slash', !showing);
    }
</script>
@endsection
