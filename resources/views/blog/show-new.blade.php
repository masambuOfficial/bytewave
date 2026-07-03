@extends('layouts.app')

@section('title', $blog->title . ' - BYTEWAVE Blog')
@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160))
@section('og_type', 'article')
@if($blog->cover_image)
    @section('og_image', asset($blog->cover_image))
@endif

@push('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "headline": @json($blog->title),
    "description": @json($blog->meta_description ?: Str::limit(strip_tags($blog->content), 160)),
    "datePublished": @json(optional($blog->published_at)->toIso8601String()),
    "dateModified": @json(optional($blog->updated_at)->toIso8601String()),
    "author": {
        "@type": "Person",
        "name": @json($blog->author_name ?: 'ByteWave Investments')
    },
    @if($blog->cover_image)
    "image": @json(asset($blog->cover_image)),
    @endif
    "publisher": {
        "@type": "Organization",
        "name": @json(config('company.name')),
        "logo": {
            "@type": "ImageObject",
            "url": @json(asset(config('company.logo')))
        }
    }
}
</script>
@endpush

@section('content')
<div x-data="{ replyTo: null }">
    @php
        $hasRealImage = $blog->getRawOriginal('cover_image') || $blog->image_url;
        $heroStyle = $hasRealImage
            ? "background-image: linear-gradient(rgba(3,46,73,0.75), rgba(3,46,73,0.88)), url('{$blog->cover_image}'); background-size: cover; background-position: center;"
            : "background:
                radial-gradient(circle at 15% 20%, rgba(251, 177, 69, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 85% 75%, rgba(102, 183, 231, 0.25) 0%, transparent 45%),
                radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px),
                linear-gradient(135deg, #032E49 0%, #04456E 45%, #0773B8 100%);
                background-size: auto, auto, 24px 24px, auto;";
    @endphp

    <!-- Article Hero Header -->
    <div class="relative overflow-hidden bg-cover bg-center py-20 md:py-28" style="{{ $heroStyle }}">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav aria-label="breadcrumb" class="mb-6">
                <ol class="flex items-center flex-wrap gap-2 text-white/80 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-bytewave-gold transition-colors">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-bytewave-gold transition-colors">Blog</a></li>
                    <li>/</li>
                    <li class="text-white truncate max-w-xs">{{ $blog->title }}</li>
                </ol>
            </nav>

            @if($blog->source_url)
                <span class="inline-block px-3 py-1 text-sm font-semibold text-white rounded-full mb-4 mr-2 bg-white/15 backdrop-blur-sm">
                    Curated
                </span>
            @endif
            @if($blog->category && is_object($blog->category))
                <a href="{{ route('blog.category', $blog->category->slug) }}"
                   class="inline-block px-3 py-1 text-sm font-semibold text-white rounded-full mb-4"
                   style="background-color: {{ $blog->category->color }}">
                    {{ $blog->category->name }}
                </a>
            @endif

            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6">{{ $blog->title }}</h1>

            <div class="flex flex-wrap items-center gap-x-6 gap-y-3 text-white/90">
                @if($blog->author)
                    <div class="flex items-center gap-2">
                        <img
                            src="{{ $blog->author->avatar }}"
                            alt="{{ $blog->author->name }}"
                            class="w-10 h-10 rounded-full border-2 border-white/40 object-cover"
                        >
                        <div>
                            <p class="font-semibold text-white text-sm">{{ $blog->author->name }}</p>
                            <p class="text-xs text-white/70">{{ $blog->published_at?->format('M d, Y') }}</p>
                        </div>
                    </div>
                @endif

                @if($blog->read_time)
                    <span class="text-sm">{{ $blog->read_time }} min read</span>
                @endif

                <span class="text-sm">{{ number_format($blog->views) }} views</span>
            </div>
        </div>
    </div>

    <article class="max-w-4xl mx-auto px-4 py-8">
        @if($blog->tags && $blog->tags->isNotEmpty())
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($blog->tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}"
                       class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none mb-12">
            {!! str($blog->content)->markdown() !!}
        </div>
        
        <!-- Source Attribution -->
        @if($blog->source_url)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8">
                <p class="text-sm text-gray-700">
                    This is ByteWave's take on a story from
                    <strong>{{ $blog->source_name }}</strong>. Continue reading the full original article
                    <a href="{{ $blog->source_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-700 underline">
                        here &rarr;
                    </a>
                </p>
            </div>
        @endif
        
        <!-- Social Share -->
        <div class="border-t border-b border-gray-200 py-6 mb-12">
            <x-blog.social-share :article="$blog" />
        </div>
        
        <!-- Author Bio -->
        @if($blog->author && $blog->author->bio)
            <div class="bg-gray-50 rounded-lg p-6 mb-12">
                <div class="flex items-start space-x-4">
                    <img 
                        src="{{ $blog->author->avatar }}" 
                        alt="{{ $blog->author->name }}"
                        class="w-16 h-16 rounded-full flex-shrink-0"
                    >
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ $blog->author->name }}</h3>
                        <p class="text-gray-600 mb-3">{{ $blog->author->bio }}</p>
                        @if($blog->author->twitter || $blog->author->linkedin)
                            <div class="flex space-x-3">
                                @if($blog->author->twitter)
                                    <a href="{{ $blog->author->twitter }}" target="_blank" class="text-blue-500 hover:text-blue-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                @endif
                                @if($blog->author->linkedin)
                                    <a href="{{ $blog->author->linkedin }}" target="_blank" class="text-blue-700 hover:text-blue-800">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Comments Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                Comments ({{ $blog->approvedComments->count() }})
            </h2>
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Comment Form -->
            <x-blog.comment-form :blog="$blog" />
            
            <!-- Comments List -->
            <div class="mt-8 space-y-6">
                @forelse($blog->approvedComments as $comment)
                    <x-blog.comment :comment="$comment" />
                @empty
                    <p class="text-gray-500 text-center py-8">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </article>
    
    <!-- Related Articles -->
    @if($relatedArticles && $relatedArticles->isNotEmpty())
        <div class="bg-gray-50 py-16">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Articles</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $article)
                        <x-blog.article-card :article="$article" />
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    <!-- Newsletter CTA -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        <x-newsletter-form 
            title="Enjoyed this article?"
            description="Subscribe to get more insights like this delivered to your inbox."
        />
    </div>
</div>
@endsection
