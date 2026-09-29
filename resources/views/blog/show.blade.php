@extends('layouts.app')

@section('title', $post->title . ' - BYTEWAVE Blog')

@section('content')
    <!-- Page Header Start -->
    <div class="relative bg-cover bg-center py-20" style="background: linear-gradient(rgba(11, 31, 51, 0.6), rgba(11, 31, 51, 0.6)), url('{{ asset('images/bg-1.jpg') }}') center center no-repeat, #0B1F33; background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">{{ $post->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="flex justify-center items-center space-x-2 text-white text-lg">
                    <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    <li><a href="{{ route('blog.index') }}" class="hover:underline">Blog</a></li>
                    <li class="text-white/50" aria-hidden="true">/</li>
                    @if($post->category)
                        <li><a href="{{ route('blog.category', $post->category) }}" class="hover:underline">{{ $post->category }}</a></li>
                        <li class="text-white/50" aria-hidden="true">/</li>
                    @endif
                    <li class="text-white">{{ Str::limit($post->title, 30) }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Details Start -->
    <div class="container-fluid blog py-5 my-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8 wow fadeIn" data-wow-delay="0.1s">
                    <div class="blog-item-detail bg-light rounded overflow-hidden">
                        @if($post->image)
                            <div class="blog-img position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid w-100" alt="{{ $post->title }}">
                            </div>
                        @endif

                        <div class="blog-content px-4 py-4">
                            <div class="row g-2 mb-4">
                                <div class="col-auto">
                                    @if($post->author)
                                        <img src="{{ $post->author->avatar ?? asset('admin.jpg') }}" 
                                             class="rounded-circle" 
                                             alt="{{ $post->author->name }}"
                                             width="40" height="40">
                                    @endif
                                </div>
                                <div class="col">
                                    <h6 class="mb-0">{{ $post->author->name ?? 'Admin' }}</h6>
                                    <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                                </div>
                                @if($post->category)
                                    <div class="col-auto">
                                        <a href="{{ route('blog.category', $post->category) }}" 
                                           class="badge bg-primary text-decoration-none">
                                            {{ $post->category }}
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="blog-text">
                                {!! $post->content !!}
                            </div>

                            @if($post->tags->count() > 0)
                                <div class="blog-tags mt-4">
                                    <h5 class="mb-3">Tags</h5>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                                           class="badge bg-primary text-decoration-none me-1">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Share Buttons -->
                            <div class="blog-share mt-4 pt-4 border-top">
                                <h5 class="mb-3">Share This Post</h5>
                                <div class="d-flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                       class="btn btn-primary" target="_blank">
                                        <i class="fab fa-facebook-f me-2"></i>Share on Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                                       class="btn btn-info text-white" target="_blank">
                                        <i class="fab fa-twitter me-2"></i>Share on Twitter
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}" 
                                       class="btn btn-secondary" target="_blank">
                                        <i class="fab fa-linkedin-in me-2"></i>Share on LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($relatedPosts->count() > 0)
                        <!-- Related Posts -->
                        <div class="mt-5">
                            <h3 class="text-warning mb-4">Related Posts</h3>
                            <div class="row g-4">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-md-6">
                                        <div class="blog-item position-relative bg-light rounded h-100">
                                            @if($relatedPost->image)
                                                <img src="{{ asset('storage/' . $relatedPost->image) }}" 
                                                     class="img-fluid w-100 rounded-top" 
                                                     alt="{{ $relatedPost->title }}">
                                            @endif
                                            <div class="blog-content p-4">
                                                <h5 class="mb-3">{{ $relatedPost->title }}</h5>
                                                <p class="text-secondary mb-3">
                                                    {{ $relatedPost->excerpt ?? Str::limit(strip_tags($relatedPost->content), 100) }}
                                                </p>
                                                <x-cta-button :href="route('blog.show', $relatedPost)" text="Read More" size="sm" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <!-- Search -->
                    <div class="mb-5">
                        <form action="{{ route('blog.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control p-3" name="q" placeholder="Search posts...">
                                <button class="bg-bytewave-blue text-white px-4 py-2 rounded-lg hover:bg-bytewave-ink transition-colors" aria-label="Search"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    @if(isset($categories) && $categories->count() > 0)
                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Categories</h3>
                            <div class="d-flex flex-column">
                                @foreach($categories as $cat)
                                    <a href="{{ route('blog.category', $cat) }}" 
                                       class="h5 mb-3 text-decoration-none">
                                        <i class="fas fa-angle-right text-warning me-2"></i>{{ $cat }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tags -->
                    @if(isset($tags) && $tags->count() > 0)
                        <div class="mb-5">
                            <h3 class="text-warning mb-4">Popular Tags</h3>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                                       class="badge bg-primary text-decoration-none">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details End -->
@endsection

@section('styles')
<style>
    .blog-content img {
        max-width: 100%;
        height: auto;
    }

    .blog-text {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .blog-text p {
        margin-bottom: 1.5rem;
    }

    .blog-text h2, .blog-text h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }

    .blog-share .btn {
        padding: 0.5rem 1rem;
    }

    @media (max-width: 768px) {
        .blog-share .btn {
            font-size: 0.875rem;
            padding: 0.4rem 0.8rem;
        }
    }
</style>
@endsection
