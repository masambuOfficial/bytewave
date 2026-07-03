@props(['href', 'text' => 'Get a quote', 'bgColor' => 'bg-bytewave-blue', 'hoverBgColor' => 'hover:bg-blue-700', 'textColor' => 'text-white', 'fullWidthMobile' => false, 'arrowBgColor' => 'bg-bytewave-gold', 'arrowColor' => 'text-white'])

<a href="{{ $href }}" class="{{ $bgColor }} {{ $hoverBgColor }} {{ $textColor }} font-semibold transition-all duration-300 {{ $fullWidthMobile ? 'flex md:inline-flex w-full md:w-auto' : 'inline-flex' }} items-center gap-3 group overflow-hidden" style="height: 60px; padding: 8px 8px 8px 24px; border-radius: 8px 8px 20px 8px;">
    <span class="text-base whitespace-nowrap relative overflow-hidden inline-block" style="height: 24px;">
        <span class="inline-block transition-transform duration-300 group-hover:-translate-y-full">{{ $text }}</span>
        <span class="inline-block absolute left-0 top-full transition-transform duration-300 group-hover:-translate-y-full">{{ $text }}</span>
    </span>
    <div class="{{ $arrowBgColor }} rounded-md flex items-center justify-center relative overflow-hidden flex-shrink-0" style="width: 44px; height: 44px;">
        <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300 group-hover:translate-x-full">
            <svg class="w-4 h-4 {{ $arrowColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </span>
        <span class="absolute inset-0 flex items-center justify-center transition-transform duration-300 -translate-x-full group-hover:translate-x-0">
            <svg class="w-4 h-4 {{ $arrowColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </span>
    </div>
</a>
