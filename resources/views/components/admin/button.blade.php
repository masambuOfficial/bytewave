{{--
    The ByteWave button for the admin panel: the same format as the public <x-cta-button> (asymmetric corner,
    label that slides up on hover, arrow square that swaps). Plain CSS (.bw-btn, defined in layouts/admin.blade.php)
    because the admin loads Bootstrap, not Tailwind. See BRAND.md 6.1.

    <x-admin.button href="{{ route('...') }}">Add Client</x-admin.button>
    <x-admin.button type="submit">Save</x-admin.button>
    <x-admin.button href="..." variant="secondary">Back to List</x-admin.button>     outlined, for cancel / back
    <x-admin.button ... variant="danger" size="sm">Delete</x-admin.button>

    Extra attributes (id, data-bs-*, target, onclick) pass straight through.
--}}
@props([
    'href' => null,
    'type' => null,
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $tag = $type ? 'button' : 'a';
    $classes = 'bw-btn bw-btn--' . $variant . ($size === 'sm' ? ' bw-btn--sm' : '');
@endphp

<{{ $tag }} @if($type) type="{{ $type }}" @else href="{{ $href }}" @endif {{ $attributes->merge(['class' => $classes]) }}>
    <span class="bw-btn__label"><span>{{ $slot }}</span><span aria-hidden="true">{{ $slot }}</span></span>
    <span class="bw-btn__arrow" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </span>
</{{ $tag }}>
