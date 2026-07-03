@props(['article', 'featured' => false])

<article class="{{ $featured ? 'md:col-span-2' : '' }} group bg-white rounded-xl shadow-sm hover:shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1">
    <a href="{{ route('blog.show', $article->slug) }}" class="block">
        <div class="relative overflow-hidden {{ $featured ? 'h-80' : 'h-52' }} bg-gray-100">
            <img
                src="{{ $article->cover_image }}"
                alt="{{ $article->title }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                loading="lazy"
            >
            @if($article->category && is_object($article->category))
                <span class="absolute top-4 left-4 px-3 py-1 text-xs font-semibold text-white rounded-full shadow"
                      style="background-color: {{ $article->category->color }}">
                    {{ $article->category->name }}
                </span>
            @endif
        </div>

        <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 group-hover:text-bytewave-blue transition-colors line-clamp-2">
                {{ $article->title }}
            </h3>

            <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                {{ $article->excerpt }}
            </p>

            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                <div class="flex items-center gap-2">
                    @if($article->author)
                        <img
                            src="{{ $article->author->avatar }}"
                            alt="{{ $article->author->name }}"
                            class="w-6 h-6 rounded-full object-cover"
                        >
                        <span class="font-medium text-gray-700">{{ $article->author->name }}</span>
                        <span class="text-gray-300">&bull;</span>
                    @endif
                    <span>{{ $article->published_at?->format('M d, Y') }}</span>
                </div>

                @if($article->read_time)
                    <span>{{ $article->read_time }} min read</span>
                @endif
            </div>
        </div>
    </a>
</article>
