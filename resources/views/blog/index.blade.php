@extends('layouts.app')

@section('title', 'Tech Blog – Insights on Technology & Digital Growth | ByteWave')
@section('meta_description', 'Insights, updates, and perspectives on technology and digital growth from the BYTEWAVE team.')

@push('schema')
    <x-breadcrumb-schema :items="['Home' => route('home'), 'Blog' => url()->current()]" />
@endpush

@section('content')
<div x-data="{ replyTo: null }">
    <!-- Page Header Start -->
    <div class="relative isolate overflow-hidden py-20 bg-bytewave-blue">
        <x-bg-art layout="dark" />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12 relative z-10">
            <p class="text-5xl md:text-6xl font-bold text-white mb-6">Blog</p>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white">
                    <li><a class="hover:underline transition-colors" href="{{ url('/') }}">Home</a></li>
                    <li class="before:content-['/'] before:mx-2">Blog</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Intro -->
        <div class="text-center mx-auto pb-12 max-w-2xl">
            <span class="inline-block text-bytewave-blue font-semibold mb-3 uppercase tracking-wider text-sm before:content-[''] before:inline-block before:w-1.5 before:h-1.5 before:bg-bytewave-gold before:mr-2 before:align-middle">Insights &amp; Updates</span>
            <h1 class="text-4xl md:text-5xl font-bold text-bytewave-ink">From the BYTEWAVE Blog</h1>
            <p class="text-bytewave-ink/70 mt-4 text-lg">Ideas, updates, and perspectives on technology and digital growth</p>
        </div>

        @if($categories->isNotEmpty())
            <!-- Topic Pills -->
            <div class="flex flex-wrap justify-center gap-3 mb-16">
                <a href="{{ route('blog.all') }}" class="px-5 py-2 rounded-full text-sm font-semibold bg-bytewave-blue text-white hover:bg-bytewave-ink transition-colors">
                    All Articles
                </a>
                @foreach($categories as $category)
                    @if($category->blogs_count > 0)
                        <a href="{{ route('blog.category', $category->slug) }}"
                           class="px-5 py-2 rounded-full text-sm font-semibold border transition-colors hover:text-white"
                           style="border-color: {{ $category->color }}40; color: {{ $category->color }};"
                           onmouseover="this.style.backgroundColor='{{ $category->color }}'"
                           onmouseout="this.style.backgroundColor='transparent'">
                            {{ $category->name }} <span class="opacity-70">({{ $category->blogs_count }})</span>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif

        @if($heroArticle)
            <!-- Hero Article + Latest Posts Sidebar -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
                <div class="lg:col-span-2">
                    <x-blog.hero-article :article="$heroArticle" />
                </div>

                @if($latestPosts->isNotEmpty())
                    <div>
                        <h2 class="text-xl font-bold text-bytewave-ink mb-4">Latest Posts</h2>
                        <div class="space-y-3">
                            @foreach($latestPosts as $post)
                                <a href="{{ route('blog.show', $post->slug) }}" class="block group">
                                    <div class="flex gap-3 bg-white p-3 rounded-xl border border-bytewave-blue/20 hover:shadow-md hover:border-bytewave-blue/30 transition-all">
                                        <img
                                            src="{{ $post->cover_image }}"
                                            alt="{{ $post->title }}"
                                            class="w-20 h-20 object-cover rounded-lg flex-shrink-0 bg-bytewave-blue/5"
                                        >
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-semibold text-bytewave-ink group-hover:text-bytewave-blue transition-colors line-clamp-2 text-sm">
                                                {{ $post->title }}
                                            </h3>
                                            <p class="text-xs text-bytewave-ink/70 mt-1">
                                                {{ $post->published_at?->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Latest from the blog -->
        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-bytewave-ink">Latest from the Blog</h2>
                <a href="{{ route('blog.all') }}" class="text-bytewave-blue font-semibold hover:text-bytewave-ink transition-colors whitespace-nowrap">
                    View all &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredArticles as $article)
                    <x-blog.article-card :article="$article" />
                @empty
                    <div class="col-span-full">
                        <x-blog.empty-state message="No articles yet" />
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Newsletter CTA -->
        <x-newsletter-form />
    </div>
</div>
@endsection
