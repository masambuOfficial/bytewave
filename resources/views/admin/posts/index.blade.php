@extends('layouts.admin')

@section('title', 'Blog Posts')

@push('styles')
<style>
    .post-card {
        transition: transform 0.2s;
    }
    .post-card:hover {
        transform: translateY(-5px);
    }
    .post-image {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: calc(0.375rem - 1px);
        border-top-right-radius: calc(0.375rem - 1px);
    }
    .action-buttons {
        transition: opacity 0.2s;
        opacity: 0;
    }
    .post-card:hover .action-buttons {
        opacity: 1;
    }
    .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.875rem;
    }
    .status-badge.draft {
        background: rgba(108, 117, 125, 0.9);
        color: white;
    }
    .status-badge.published {
        background: rgba(25, 135, 84, 0.9);
        color: white;
    }
    .category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.875rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Write New Post
        </a>
    </div>

    @if($posts->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
            <p class="text-muted">No blog posts found.</p>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                Write your first post
            </a>
        </div>
    @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow post-card h-100">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" 
                                 alt="{{ $post->title }}" 
                                 class="post-image">
                        @else
                            <div class="post-image bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-newspaper fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="status-badge {{ $post->status }}">
                            {{ ucfirst($post->status) }}
                        </div>

                        @if($post->category)
                            <div class="category-badge">
                                {{ $post->category }}
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($post->excerpt ?? $post->content, 100) }}
                            </p>
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-user"></i> {{ $post->author->name ?? 'Unknown Author' }}
                                </small>
                                <small class="text-muted ms-3">
                                    <i class="fas fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                                </small>
                                @if($post->comments_count)
                                    <small class="text-muted ms-3">
                                        <i class="fas fa-comments"></i> {{ $post->comments_count }}
                                    </small>
                                @endif
                            </div>
                            
                            <div class="action-buttons">
                                <hr>
                                <div class="btn-group w-100">
                                    <a href="{{ route('admin.posts.edit', $post) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('blog.show', $post->slug) }}" 
                                       class="btn btn-outline-info" 
                                       title="View"
                                       target="_blank">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection