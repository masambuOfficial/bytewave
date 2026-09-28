@props(['title', 'description', 'image', 'alt' => ''])

<article {{ $attributes->merge(['class' => 'reveal bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 flex flex-col']) }}>
    <div class="h-48 bg-bytewave-blue-50 flex items-center justify-center p-8">
        <img src="{{ $image }}" alt="{{ $alt ?: $title }}" class="max-h-full max-w-full object-contain" loading="lazy">
    </div>
    <div class="p-6 flex-1">
        <h3 class="text-xl font-bold text-bytewave-blue mb-2">{{ $title }}</h3>
        <p class="text-gray-600 leading-relaxed">{{ $description }}</p>
    </div>
</article>
