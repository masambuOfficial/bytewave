@extends('layouts.app')

@section('title', 'All Articles - BYTEWAVE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">
            @if(isset($category))
                {{ $category->name }} Articles
            @elseif(isset($tag))
                #{{ $tag->name }}
            @else
                All Articles
            @endif
        </h1>
        <p class="text-gray-600">
            @if(isset($search))
                Search results for "{{ $search }}"
            @else
                Explore our latest articles and insights
            @endif
        </p>
    </div>
    
    <!-- Search Bar -->
    <div class="mb-8">
        <x-blog.search-bar :value="$search ?? ''" />
    </div>
    
    <!-- Filter Chips -->
    <div class="mb-8">
        <x-blog.filter-chips 
            :categories="$categories" 
            :tags="$tags"
            :activeCategory="$category ?? null"
            :activeTag="$tag ?? null"
        />
    </div>
    
    <!-- Sort Options -->
    <div class="flex items-center justify-between mb-8">
        <p class="text-gray-600">{{ $articles->total() }} articles found</p>
        
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-600">Sort by:</span>
            <select 
                onchange="window.location.href = this.value"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="{{ route('blog.all', array_merge(request()->except('sort'), ['sort' => 'recent'])) }}" {{ ($sort ?? 'recent') === 'recent' ? 'selected' : '' }}>
                    Most Recent
                </option>
                <option value="{{ route('blog.all', array_merge(request()->except('sort'), ['sort' => 'popular'])) }}" {{ ($sort ?? '') === 'popular' ? 'selected' : '' }}>
                    Most Popular
                </option>
                <option value="{{ route('blog.all', array_merge(request()->except('sort'), ['sort' => 'featured'])) }}" {{ ($sort ?? '') === 'featured' ? 'selected' : '' }}>
                    Featured
                </option>
            </select>
        </div>
    </div>
    
    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @forelse($articles as $article)
            <x-blog.article-card :article="$article" />
        @empty
            <div class="col-span-3">
                <x-blog.empty-state />
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($articles->hasPages())
        <div class="flex justify-center">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
