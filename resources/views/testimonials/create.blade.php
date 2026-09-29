@extends('layouts.app')

@section('title', 'Share Your Experience - ByteWave')
@section('robots', 'noindex, nofollow')
@section('minimal', true)

@section('styles')
<style>[x-cloak]{display:none !important}</style>
@endsection

@section('content')
@php
    $field = 'w-full rounded-xl border border-bytewave-blue/20 bg-white px-4 py-3 text-base text-bytewave-ink placeholder-bytewave-ink/70 focus:border-bytewave-blue focus:outline-none focus:ring-4 focus:ring-bytewave-blue/10';
    $label = 'mb-1 block text-sm font-semibold text-bytewave-ink';
@endphp

{{-- Fits the screen; only scrolls internally if the device is too short to fit the form --}}
<div class="relative flex h-dvh flex-col overflow-y-auto bg-bytewave-blue">
    {{-- Decorative background --}}
    <div class="pointer-events-none fixed inset-0" aria-hidden="true">
        <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-white/5"></div>
        <div class="absolute top-1/3 -right-40 h-[28rem] w-[28rem] rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-40 left-1/4 h-96 w-96 rounded-full bg-white/5"></div>
    </div>

    {{-- Logo --}}
    <header class="relative mx-auto flex w-full max-w-7xl shrink-0 justify-center px-4 pt-4 sm:px-6 lg:justify-start lg:px-8 lg:pt-6">
        <a href="{{ url('/') }}" aria-label="ByteWave home">
            <img src="{{ asset('images/BYTEWAVE_INVESTMENTS-LOGO.png') }}" alt="ByteWave Investments" class="h-8 w-auto sm:h-10">
        </a>
    </header>

    <div class="relative mx-auto grid w-full max-w-7xl flex-1 content-center items-center gap-4 px-4 py-3 sm:gap-6 sm:px-6 lg:grid-cols-5 lg:gap-16 lg:px-8">

        {{-- Hero --}}
        <section class="text-center lg:col-span-2 lg:text-left">
            <span class="hidden items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white/90 sm:inline-flex">
                <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                Your voice matters
            </span>

            <h1 class="text-2xl font-bold leading-tight tracking-tight text-white sm:mt-4 sm:text-4xl lg:text-5xl xl:text-6xl">
                Share your <span class="text-white">experience</span><span class="hidden sm:inline"> with ByteWave</span>
            </h1>

            <p class="mx-auto mt-1 max-w-xl text-sm text-white/80 sm:mt-4 sm:text-lg lg:mx-0">
                A few kind words from you help small businesses find a partner they can trust.
            </p>

            <ul class="mt-8 hidden space-y-4 text-left lg:block">
                @foreach([
                    ['fa-regular fa-clock', 'Takes about a minute', 'Just a rating and a few sentences.'],
                    ['fa-regular fa-eye', 'Reviewed before publishing', 'Nothing goes live without our approval.'],
                    ['fa-regular fa-heart', 'Every word counts', 'Your feedback helps us keep improving.'],
                ] as [$icon, $heading, $text])
                    <li class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-white">
                            <i class="{{ $icon }}"></i>
                        </span>
                        <span>
                            <span class="block font-semibold text-white">{{ $heading }}</span>
                            <span class="block text-sm text-white/70">{{ $text }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </section>

        {{-- Form / thank-you card --}}
        <section class="mx-auto w-full max-w-xl lg:col-span-3 lg:max-w-none">
            @if(session('success'))
                <div class="rounded-3xl bg-white p-8 text-center shadow-2xl shadow-black/20 sm:p-12">
                    <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-bytewave-blue/5 text-bytewave-blue">
                        <i class="fa-solid fa-check text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-bytewave-ink sm:text-3xl">Thank you!</h2>
                    <p class="mx-auto mt-3 max-w-sm text-bytewave-ink/70">
                        Your testimonial has been received. We really appreciate you taking the time.
                    </p>
                    <div class="mt-8 flex justify-center">
                        <x-cta-button :href="url('/')" text="Back to ByteWave" />
                    </div>
                </div>
            @else
                <form
                    action="{{ route('testimonials.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4 rounded-3xl bg-white p-5 shadow-2xl shadow-black/20 sm:space-y-4 sm:p-6 lg:p-8"
                    x-data="{ rating: {{ (int) old('rating', 5) }}, count: {{ mb_strlen(old('testimonial', '')) }}, sending: false, fileName: '' }"
                    @submit="sending = true"
                >
                    @csrf

                    {{-- Honeypot --}}
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                    {{-- Rating --}}
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sm font-semibold text-bytewave-ink">How was your experience?</span>
                        <div class="flex items-center" role="radiogroup" aria-label="Rating">
                            @for($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    @click="rating = {{ $i }}"
                                    role="radio"
                                    :aria-checked="rating === {{ $i }}"
                                    aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
                                    class="flex h-10 w-8 items-center justify-center rounded-lg text-3xl leading-none transition active:scale-90 focus:outline-none focus-visible:ring-4 focus-visible:ring-bytewave-blue/20 sm:w-10"
                                    :class="rating >= {{ $i }} ? 'text-bytewave-blue' : 'text-bytewave-blue/20'"
                                >★</button>
                            @endfor
                            <input type="hidden" name="rating" :value="rating">
                        </div>
                    </div>
                    @error('rating')<p class="text-sm text-bytewave-danger">{{ $message }}</p>@enderror

                    {{-- Testimonial --}}
                    <div>
                        <label for="testimonial" class="{{ $label }}">Your testimonial</label>
                        <textarea
                            id="testimonial"
                            name="testimonial"
                            rows="4"
                            maxlength="1000"
                            required
                            placeholder="What was it like working with ByteWave?"
                            class="{{ $field }} resize-none @error('testimonial') border-bytewave-danger @enderror"
                            @input="count = $event.target.value.length"
                        >{{ old('testimonial') }}</textarea>
                        <div class="mt-1 flex justify-between text-xs text-bytewave-ink/70">
                            <span>@error('testimonial')<span class="text-bytewave-danger">{{ $message }}</span>@else Minimum 10 characters @enderror</span>
                            <span x-text="count + ' / 1000'"></span>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div>
                        <label for="name" class="{{ $label }}">Your name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required
                            class="{{ $field }} @error('name') border-bytewave-danger @enderror"
                        >
                        @error('name')<p class="mt-1 text-sm text-bytewave-danger">{{ $message }}</p>@enderror
                    </div>

                    {{-- Role + Company: stacked on phones, side by side from tablet up --}}
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-3">
                        <div>
                            <label for="title" class="{{ $label }}">
                                Role <span class="font-normal text-bytewave-ink/70">(optional)</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Friend, Client"
                                class="{{ $field }} @error('title') border-bytewave-danger @enderror"
                            >
                            @error('title')<p class="mt-1 text-sm text-bytewave-danger">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="company" class="{{ $label }}">
                                Company <span class="font-normal text-bytewave-ink/70">(optional)</span>
                            </label>
                            <input
                                type="text"
                                id="company"
                                name="company"
                                value="{{ old('company') }}"
                                autocomplete="organization"
                                class="{{ $field }} @error('company') border-bytewave-danger @enderror"
                            >
                            @error('company')<p class="mt-1 text-sm text-bytewave-danger">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Photo + Submit on one row --}}
                    <div>
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-stretch">
                            <label
                                for="avatar"
                                class="flex min-w-0 cursor-pointer items-center justify-center gap-2 rounded-xl border border-dashed border-bytewave-ink/50 px-4 py-3 text-bytewave-ink/70 transition hover:border-bytewave-blue hover:text-bytewave-blue sm:min-w-[9rem]"
                                :class="fileName ? 'border-bytewave-blue text-bytewave-blue' : ''"
                                title="Add a photo (optional)"
                            >
                                <i class="fa-regular fa-image text-lg"></i>
                                <span class="max-w-[12rem] truncate text-sm sm:max-w-[7rem]" x-text="fileName || 'Add a photo'"></span>
                            </label>
                            <input
                                type="file"
                                id="avatar"
                                name="avatar"
                                accept="image/*"
                                class="sr-only"
                                @change="fileName = $event.target.files[0]?.name || ''"
                            >

                            <x-cta-button type="submit" x-bind:disabled="sending" class="flex-1 justify-between focus:outline-none focus-visible:ring-4 focus-visible:ring-bytewave-blue/30">
                                <span x-show="!sending">Submit testimonial</span>
                                <span x-show="sending" x-cloak>Sending…</span>
                            </x-cta-button>
                        </div>
                        @error('avatar')<p class="mt-1 text-sm text-bytewave-danger">{{ $message }}</p>@enderror
                        <p class="mt-2 text-center text-xs text-bytewave-ink/70">
                            Photo is optional (JPG, PNG or GIF, up to 2MB). Testimonials are reviewed before publishing.
                        </p>
                    </div>
                </form>
            @endif
        </section>
    </div>

    <footer class="relative shrink-0 px-4 pb-3 text-center text-xs text-white/60">
        &copy; {{ date('Y') }} ByteWave Investments
    </footer>
</div>
@endsection
