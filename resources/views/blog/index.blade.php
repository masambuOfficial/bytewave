@extends('layouts.app')

@section('title', 'Blog - BYTEWAVE')

@section('content')
<div x-data="{ replyTo: null }">
    <!-- Hero Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-900">All articles</h1>
            <a href="{{ route('blog.all') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                View all articles →
            </a>
        </div>
        
        <!-- Hero Article + Latest Posts Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <div class="lg:col-span-2">
                <x-blog.hero-article :article="$heroArticle" />
            </div>
            
            <div class="space-y-4">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Latest Posts</h2>
                @foreach($latestPosts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="block group">
                        <div class="flex space-x-3">
                            <img 
                                src="{{ $post->cover_image }}" 
                                alt="{{ $post->title }}"
                                class="w-24 h-24 object-cover rounded-lg flex-shrink-0"
                            >
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 text-sm">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $post->published_at?->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Latest from the blog -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Latest from the blog</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredArticles as $article)
                    <x-blog.article-card :article="$article" :featured="$loop->first" />
                @empty
                    <div class="col-span-3">
                        <x-blog.empty-state message="No featured articles yet" />
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Explore topics -->
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Explore topics</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('blog.category', $category->slug) }}" 
                   class="p-6 rounded-lg text-center hover:shadow-lg transition-shadow"
                   style="background-color: {{ $category->color }}20; border: 2px solid {{ $category->color }}40">
                    <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $category->blogs_count }} articles</p>
                </a>
            @endforeach
        </div>
    </div>
    
    <!-- Newsletter CTA -->
    <div class="container mx-auto px-4 py-16">
        <x-newsletter-form />
    </div>
</div>
@endsection