@props(['categories', 'tags', 'activeCategory' => null, 'activeTag' => null])

<div class="flex flex-wrap gap-3" x-data="{ showAll: false }">
    <!-- All Articles -->
    <a href="{{ route('blog.all') }}" 
       class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ !$activeCategory && !$activeTag ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
        All Articles
    </a>
    
    <!-- Categories -->
    @foreach($categories as $category)
        <a href="{{ route('blog.category', $category->slug) }}" 
           class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ $activeCategory && $activeCategory->id === $category->id ? 'text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
           style="{{ $activeCategory && $activeCategory->id === $category->id ? 'background-color: ' . $category->color : '' }}">
            {{ $category->name }}
            <span class="ml-1 text-xs opacity-75">({{ $category->blogs_count ?? 0 }})</span>
        </a>
    @endforeach
    
    <!-- Tags (show first 5, expand on click) -->
    @if($tags && $tags->isNotEmpty())
        <div class="w-full border-t border-gray-200 my-2"></div>
        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tags:</span>
        
        @foreach($tags->take(5) as $tag)
            <a href="{{ route('blog.tag', $tag->slug) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium transition-colors {{ $activeTag && $activeTag->id === $tag->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                #{{ $tag->name }}
            </a>
        @endforeach
        
        @if($tags->count() > 5)
            <button 
                @click="showAll = !showAll"
                class="px-3 py-1 text-xs font-medium text-blue-600 hover:text-blue-700">
                <span x-show="!showAll">+{{ $tags->count() - 5 }} more</span>
                <span x-show="showAll" x-cloak>Show less</span>
            </button>
            
            <div x-show="showAll" x-cloak class="flex flex-wrap gap-2 w-full">
                @foreach($tags->slice(5) as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}" 
                       class="px-3 py-1 rounded-full text-xs font-medium transition-colors {{ $activeTag && $activeTag->id === $tag->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    @endif
</div>
