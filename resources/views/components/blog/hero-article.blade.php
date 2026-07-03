@props(['article'])

@if($article)
<div class="relative h-[420px] md:h-[500px] rounded-2xl overflow-hidden group shadow-lg">
    <img
        src="{{ $article->cover_image }}"
        alt="{{ $article->title }}"
        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
    >

    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>

    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
        @if($article->category && is_object($article->category))
            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-4 bg-bytewave-gold text-white">
                {{ $article->category->name }}
            </span>
        @endif

        <h2 class="text-2xl md:text-4xl font-bold mb-3 line-clamp-2">
            <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-bytewave-gold transition-colors">
                {{ $article->title }}
            </a>
        </h2>

        <p class="text-gray-200 mb-5 line-clamp-2 max-w-2xl">
            {{ $article->excerpt }}
        </p>

        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-200">
            @if($article->author)
                <div class="flex items-center gap-2">
                    <img
                        src="{{ $article->author->avatar }}"
                        alt="{{ $article->author->name }}"
                        class="w-9 h-9 rounded-full border-2 border-white/70 object-cover"
                    >
                    <span class="font-medium">{{ $article->author->name }}</span>
                </div>
            @endif

            <span>{{ $article->published_at?->format('M d, Y') }}</span>

            @if($article->read_time)
                <span>{{ $article->read_time }} min read</span>
            @endif
        </div>
    </div>
</div>
@endif
