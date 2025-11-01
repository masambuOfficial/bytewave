@props(['article'])

@if($article)
<div class="relative h-[500px] rounded-2xl overflow-hidden group">
    <img 
        src="{{ $article->cover_image }}" 
        alt="{{ $article->title }}"
        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
    >
    
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
    
    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
        @if($article->category && is_object($article->category))
            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-4" 
                  style="background-color: {{ $article->category->color }}">
                {{ $article->category->name }}
            </span>
        @endif
        
        <h1 class="text-4xl md:text-5xl font-bold mb-4 line-clamp-2">
            <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-400 transition-colors">
                {{ $article->title }}
            </a>
        </h1>
        
        <p class="text-lg text-gray-200 mb-6 line-clamp-2">
            {{ $article->excerpt }}
        </p>
        
        <div class="flex items-center space-x-6 text-sm">
            @if($article->author)
                <div class="flex items-center space-x-2">
                    <img 
                        src="{{ $article->author->avatar }}" 
                        alt="{{ $article->author->name }}"
                        class="w-10 h-10 rounded-full border-2 border-white"
                    >
                    <span class="font-medium">{{ $article->author->name }}</span>
                </div>
            @endif
            
            <span>{{ $article->published_at?->format('M d, Y') }}</span>
            
            @if($article->read_time)
                <span>{{ $article->read_time }} min read</span>
            @endif
            
            @if($article->views)
                <span>{{ number_format($article->views) }} views</span>
            @endif
        </div>
    </div>
</div>
@endif
