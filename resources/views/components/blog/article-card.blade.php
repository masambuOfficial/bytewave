@props(['article', 'featured' => false])

<article class="{{ $featured ? 'md:col-span-2' : '' }} group cursor-pointer">
    <a href="{{ route('blog.show', $article->slug) }}" class="block">
        <div class="relative overflow-hidden rounded-lg {{ $featured ? 'h-96' : 'h-64' }} bg-gray-200">
            <img 
                src="{{ $article->cover_image }}" 
                alt="{{ $article->title }}"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy"
            >
            @if($article->category && is_object($article->category))
                <span class="absolute top-4 left-4 px-3 py-1 text-xs font-semibold text-white rounded-full" 
                      style="background-color: {{ $article->category->color }}">
                    {{ $article->category->name }}
                </span>
            @endif
        </div>
        
        <div class="mt-4">
            <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                {{ $article->title }}
            </h3>
            
            <p class="mt-2 text-gray-600 line-clamp-2">
                {{ $article->excerpt }}
            </p>
            
            <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                <div class="flex items-center space-x-4">
                    @if($article->author)
                        <div class="flex items-center space-x-2">
                            <img 
                                src="{{ $article->author->avatar }}" 
                                alt="{{ $article->author->name }}"
                                class="w-8 h-8 rounded-full"
                            >
                            <span>{{ $article->author->name }}</span>
                        </div>
                    @endif
                    
                    <span>{{ $article->published_at?->format('M d, Y') }}</span>
                    
                    @if($article->read_time)
                        <span>{{ $article->read_time }} min read</span>
                    @endif
                </div>
                
                @if($article->views)
                    <span>{{ number_format($article->views) }} views</span>
                @endif
            </div>
            
            @if($article->tags && $article->tags->isNotEmpty())
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach($article->tags->take(3) as $tag)
                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </a>
</article>
