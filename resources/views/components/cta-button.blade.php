{{--
    The ByteWave button. Every call-to-action on the site uses this component. See BRAND.md, section 6.1.

    <x-cta-button href="..." text="Get a quote" />                    link, blue (default)
    <x-cta-button type="submit" text="Send message" />                form button
    <x-cta-button href="..." text="Contact us" variant="light" />     white, for blue backgrounds
    <x-cta-button href="..." text="View" size="sm" />                 compact (cards, forms)
    <x-cta-button ... full-width />                                   fills its container

    Custom label markup can go in the slot instead of `text`.
    bgColor, hoverBgColor, textColor, arrowBgColor and arrowColor override the variant when a page needs it.
--}}
@props([
    'href' => null,
    'type' => null,
    'text' => 'Get a quote',
    'variant' => 'primary',
    'size' => 'md',
    'bgColor' => null,
    'hoverBgColor' => null,
    'textColor' => null,
    'arrowBgColor' => null,
    'arrowColor' => null,
    'fullWidthMobile' => false,
    'fullWidth' => false,
])

@php
    $variants = [
        'primary' => ['bg' => 'bg-bytewave-blue', 'hover' => 'hover:bg-bytewave-ink', 'text' => 'text-white', 'arrowBg' => 'bg-white', 'arrow' => 'text-bytewave-blue'],
        'light'   => ['bg' => 'bg-white', 'hover' => 'hover:bg-bytewave-blue/5', 'text' => 'text-bytewave-blue', 'arrowBg' => 'bg-bytewave-blue', 'arrow' => 'text-white'],
    ];
    $v = $variants[$variant] ?? $variants['primary'];

    $sizes = [
        'md' => ['height' => 60, 'padding' => '8px 8px 8px 24px', 'box' => 44, 'label' => 24, 'font' => 'text-base', 'radius' => '8px 8px 20px 8px'],
        'sm' => ['height' => 48, 'padding' => '6px 6px 6px 20px', 'box' => 36, 'label' => 20, 'font' => 'text-sm', 'radius' => '8px 8px 16px 8px'],
    ];
    $s = $sizes[$size] ?? $sizes['md'];

    $bg = $bgColor ?? $v['bg'];
    $hover = $hoverBgColor ?? $v['hover'];
    $textClass = $textColor ?? $v['text'];
    $arrowBgClass = $arrowBgColor ?? $v['arrowBg'];
    $arrowClass = $arrowColor ?? $v['arrow'];

    $layout = $fullWidth
        ? 'flex w-full justify-between'
        : ($fullWidthMobile ? 'flex md:inline-flex w-full md:w-auto' : 'inline-flex');

    $tag = $type ? 'button' : 'a';
    $classes = "{$bg} {$hover} {$textClass} font-semibold transition-all duration-300 {$layout} items-center gap-3 group/cta overflow-hidden cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed";
    $label = $slot->isEmpty() ? $text : $slot;
@endphp

<{{ $tag }} @if($type) type="{{ $type }}" @else href="{{ $href }}" @endif {{ $attributes->merge(['class' => $classes]) }} style="height: {{ $s['height'] }}px; padding: {{ $s['padding'] }}; border-radius: {{ $s['radius'] }};">
    <span class="{{ $s['font'] }} whitespace-nowrap relative overflow-hidden inline-block" style="height: {{ $s['label'] }}px; line-height: {{ $s['label'] }}px;">
        <span class="inline-block transition-transform duration-300 group-hover/cta:-translate-y-full">{{ $label }}</span>
        <span class="inline-block absolute left-0 top-full transition-transform duration-300 group-hover/cta:-translate-y-full" aria-hidden="true">{{ $label }}</span>
    </span>
    <div class="{{ $arrowBgClass }} rounded-md flex items-center justify-center relative overflow-hidden flex-shrink-0" style="width: {{ $s['box'] }}px; height: {{ $s['box'] }}px;">
        <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300 group-hover/cta:translate-x-full">
            <svg class="w-4 h-4 {{ $arrowClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </span>
        <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300 -translate-x-full group-hover/cta:translate-x-0">
            <svg class="w-4 h-4 {{ $arrowClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </span>
    </div>
</{{ $tag }}>
