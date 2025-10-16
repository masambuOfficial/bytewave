@extends('layouts.app')

@section('title', isset($category) ? "Blog - $category" : 'Blog - BYTEWAVE')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-warning mb-4 animated slideInDown">
                @if(isset($category))
                    {{ $category }} Posts
                @elseif(isset($search))
                    Search Results: {{ $search }}
                @else
                    Latest Blog Posts
                @endif
            </h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                    @if(isset($category))
                        <li class="breadcrumb-item text-warning active">{{ $category }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5 my-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h5 class="text-primary">Our Blog</h5>
                <h1 class="text-warning mb-3">Latest Insights & News</h1>
                <p class="text-secondary">Stay updated with the latest trends in technology, digital transformation, and industry insights.</p>
            </div>
            <div class="row g-5 justify-content-center">
                @forelse($posts as $post)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.2 }}s">
                        <div class="blog-item position-relative bg-light rounded h-100">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('img/blog-1.jpg') }}" class="img-fluid w-100 rounded-top" alt="{{ $post->title }}">
                            @endif
                            @if($post->category)
                                <span class="position-absolute px-4 py-3 bg-primary text-white rounded" style="top: -28px; right: 20px;">
                                    {{ $post->category }}
                                </span>
                            @endif
                            <div class="blog-btn d-flex justify-content-between position-relative px-3" style="margin-top: -75px;">
                                <div class="blog-icon btn btn-warning px-3 rounded-pill my-auto">
                                    <a href="{{ route('blog.show', $post) }}" class="btn text-white">Read More</a>
                                </div>
                                <div class="blog-btn-icon btn btn-primary px-4 py-3 rounded-pill">
                                    <div class="blog-icon-1">
                                        <p class="text-white px-2 mb-0">Share<i class="fa fa-arrow-right ms-3"></i></p>
                                    </div>
                                    <div class="blog-icon-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
                                           class="btn me-1" title="Share on Facebook" target="_blank">
                                            <i class="fab fa-facebook-f text-white"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
                                           class="btn me-1" title="Share on Twitter" target="_blank">
                                            <i class="fab fa-twitter text-white"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post)) }}" 
                                           class="btn me-1" title="Share on LinkedIn" target="_blank">
                                            <i class="fab fa-linkedin-in text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content text-center position-relative px-3" style="margin-top: -25px;">
                                <div class="author-image mb-3">
                                    @if($post->author)
                                        <img src="{{ $post->author->avatar ?? asset('img/admin.jpg') }}" 
                                             class="img-fluid rounded-circle border-4 border-white" 
                                             alt="{{ $post->author->name }}"
                                             width="60" height="60">
                                    @else
                                        <img src="{{ asset('img/admin.jpg') }}" 
                                             class="img-fluid rounded-circle border-4 border-white" 
                                             alt="Admin"
                                             width="60" height="60">
                                    @endif
                                </div>
                                <h4 class="mb-0">{{ $post->title }}</h4>
                                <div class="mb-3">
                                    <small class="text-primary">By {{ $post->author->name ?? 'Admin' }}</small>
                                    <small class="mx-2">|</small>
                                    <small class="text-secondary">{{ $post->created_at->format('M d, Y') }}</small>
                                </div>
                                <p class="text-secondary">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 150) }}</p>
                                @if($post->tags->count() > 0)
                                    <div class="mt-3">
                                        @foreach($post->tags as $tag)
                                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" 
                                               class="badge bg-primary text-decoration-none me-1">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center wow fadeIn" data-wow-delay="0.1s">
                        <div class="p-5 bg-light rounded">
                            <i class="fas fa-newspaper text-warning fa-4x mb-4"></i>
                            <h3 class="text-primary">No Posts Yet</h3>
                            <p class="text-secondary mb-4">We're working on creating amazing content for you. Check back soon!</p>
                            <a href="{{ url('/') }}" class="btn btn-warning rounded-pill py-3 px-5">Return Home</a>
                        </div>
                    </div>
                @endforelse
            </div>
            
            @if($posts->hasPages())
                <div class="row mt-5">
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <nav aria-label="Page navigation">
                            {{ $posts->links() }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Blog End -->
@endsection

@section('styles')
<style>
    .page-header {
        background: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('{{ asset('css/img/bg-1.jpg') }}') center center no-repeat;
        background-size: cover;
    }

    .blog-item {
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .blog-item:hover {
        transform: translateY(-5px);
    }

    .blog-btn-icon:hover .blog-icon-1 {
        margin-top: -42px;
    }

    .blog-icon-1 {
        transition: all 0.3s ease-in-out;
    }

    .blog-icon-2 {
        opacity: 0;
        transition: all 0.3s ease-in-out;
    }

    .blog-btn-icon:hover .blog-icon-2 {
        opacity: 1;
    }

    .pagination {
        justify-content: center;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--bs-warning);
        border-color: var(--bs-warning);
    }

    .pagination .page-link {
        color: var(--bs-primary);
    }

    .pagination .page-link:hover {
        background-color: var(--bs-warning);
        color: var(--bs-white);
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }
</style>
@endsection