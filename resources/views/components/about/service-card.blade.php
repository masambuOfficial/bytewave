@props(['label'])

<div {{ $attributes->merge(['class' => 'reveal group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-6 flex items-center gap-4']) }}>
    <span class="flex-shrink-0 w-14 h-14 rounded-xl bg-bytewave-blue-50 text-bytewave-blue group-hover:bg-bytewave-blue group-hover:text-white transition-colors duration-300 flex items-center justify-center">
        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            {{ $icon }}
        </svg>
    </span>
    <h3 class="text-lg font-semibold text-gray-800 leading-snug">{{ $label }}</h3>
</div>
