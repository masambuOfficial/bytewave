@extends('layouts.app')

@section('title', 'All Articles – ByteWave Tech Blog')
@section('meta_description', 'Browse all ByteWave articles on technology, software, AI and digital growth, with news and insights for businesses in Uganda and beyond.')

@section('content')
    <!-- Page Header Start -->
    <div class="relative isolate overflow-hidden py-20 bg-bytewave-blue">
        <x-bg-art layout="dark" flip />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12 relative z-10">
            <p class="text-5xl md:text-6xl font-bold text-white mb-6">
                @if(isset($category))
                    {{ $category->name }}
                @elseif(isset($tag))
                    #{{ $tag->name }}
                @else
                    All Articles
                @endif
            </p>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:underline transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2"><a class="hover:underline transition-colors" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="before:content-['/'] before:mx-2">All Articles</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Intro -->
        <div class="text-center mx-auto pb-12 max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-bold text-bytewave-ink">
                @if(isset($category))
                    {{ $category->name }} Articles
                @elseif(isset($tag))
                    #{{ $tag->name }}
                @else
                    All Articles
                @endif
            </h1>
            <p class="text-bytewave-ink/70 mt-4 text-lg">
                @if(isset($search))
                    Search results for "{{ $search }}"
                @else
                    Explore our latest articles and insights
                @endif
            </p>
        </div>

        <!-- Search Bar -->
        <div class="mb-8 max-w-2xl mx-auto">
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
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-bytewave-blue/20">
            <p class="text-bytewave-ink/70">{{ $articles->total() }} articles found</p>

            <div class="flex items-center space-x-2">
                <span class="text-sm text-bytewave-ink/70">Sort by:</span>
                <select
                    onchange="window.location.href = this.value"
                    class="px-4 py-2 border border-bytewave-ink/50 rounded-lg focus:ring-2 focus:ring-bytewave-blue focus:border-transparent"
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
                <div class="col-span-full">
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
