@extends('layouts.admin')

@section('title', 'Blog Posts')

@push('styles')
<style>
    .posts-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .posts-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .posts-header p {
        color: #546270;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-post {
        background: var(--bytewave-blue);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        white-space: nowrap;
    }

    .btn-add-post:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1.5rem;
    }

    .post-card {
        background: #fff;
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .post-card:hover {
        box-shadow: 0 12px 28px rgba(11, 31, 51, 0.1);
        transform: translateY(-3px);
    }

    .post-media {
        position: relative;
    }

    .post-image {
        height: 180px;
        width: 100%;
        object-fit: cover;
        display: block;
    }

    .post-image-placeholder {
        height: 180px;
        background: var(--bytewave-blue-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .post-image-placeholder i {
        font-size: 2.25rem;
        color: var(--bytewave-blue);
        opacity: 0.5;
    }

    .post-status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
    }

    .post-status-badge.draft {
        background: rgba(255, 255, 255, 0.92);
        color: #546270;
    }

    .post-status-badge.published {
        background: rgba(23, 112, 63, 0.92);
        color: #fff;
    }

    .post-category-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(11, 31, 51, 0.65);
        backdrop-filter: blur(4px);
        color: #fff;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .post-card-body {
        padding: 1.25rem 1.35rem 1.1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .post-card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: #0B1F33;
        margin-bottom: 0.4rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .post-card-text {
        color: #546270;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 0.9rem;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.9rem;
        color: #546270;
        font-size: 0.78rem;
        margin-bottom: 1rem;
    }

    .post-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .post-card-actions {
        display: flex;
        gap: 0.5rem;
        border-top: 1px solid #CDE3F1;
        padding-top: 0.9rem;
        margin-top: auto;
    }

    .post-action-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        border: none;
        border-radius: 9px;
        padding: 0.5rem 0.6rem;
        font-size: 0.8rem;
        font-weight: 600;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .post-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .post-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .post-action-btn.view {
        background: #F3F8FC;
        color: #546270;
    }

    .post-action-btn.view:hover {
        background: #546270;
        color: #fff;
    }

    .post-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .post-action-btn.delete:hover {
        background: #C0392B;
        color: #fff;
    }

    .post-action-form {
        flex: 1;
        display: flex;
    }

    .posts-empty {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border: 1px dashed #CDE3F1;
        border-radius: 16px;
    }

    .posts-empty i {
        font-size: 2.75rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .posts-empty p {
        color: #546270;
        margin-bottom: 1.25rem;
    }

    .status-tabs {
        display: flex;
        gap: 0.4rem;
        background: #F3F8FC;
        padding: 0.35rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        width: fit-content;
        flex-wrap: wrap;
    }

    .status-tab {
        padding: 0.5rem 1rem;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #546270;
        text-decoration: none;
        transition: background 0.2s ease, color 0.2s ease;
        white-space: nowrap;
    }

    .status-tab:hover {
        color: var(--bytewave-blue-dark);
    }

    .status-tab.active {
        background: #fff;
        color: var(--bytewave-blue-dark);
        box-shadow: 0 2px 6px rgba(11, 31, 51, 0.1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="posts-header">
        <div>
            <h1>Blog Posts</h1>
            <p>Write and manage articles published on your website.</p>
        </div>
        <x-admin.button href="{{ route('admin.posts.create') }}">Write New Post</x-admin.button>
    </div>

    <div class="status-tabs">
        <a class="status-tab {{ $status === '' ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
            All ({{ \App\Models\Post::count() }})
        </a>
        <a class="status-tab {{ $status === 'draft' ? 'active' : '' }}" href="{{ route('admin.posts.index', ['status' => 'draft']) }}">
            Draft ({{ \App\Models\Post::draft()->count() }})
        </a>
        <a class="status-tab {{ $status === 'published' ? 'active' : '' }}" href="{{ route('admin.posts.index', ['status' => 'published']) }}">
            Published ({{ \App\Models\Post::published()->count() }})
        </a>
    </div>

    @if($posts->isEmpty())
        <div class="posts-empty">
            <i class="fas fa-newspaper"></i>
            <p>{{ $status !== '' ? 'No blog posts match this filter.' : 'No blog posts found.' }}</p>
            @if($status === '')
                <x-admin.button href="{{ route('admin.posts.create') }}">Write your first post</x-admin.button>
            @endif
        </div>
    @else
        <div class="posts-grid">
            @foreach($posts as $post)
                <div class="post-card">
                    <div class="post-media">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 alt="{{ $post->title }}"
                                 class="post-image">
                        @else
                            <div class="post-image-placeholder">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif

                        <div class="post-status-badge {{ $post->status }}">
                            {{ ucfirst($post->status) }}
                        </div>

                        @if($post->category)
                            <div class="post-category-badge">
                                {{ $post->category }}
                            </div>
                        @endif
                    </div>

                    <div class="post-card-body">
                        <h5 class="post-card-title">{{ $post->title }}</h5>
                        <p class="post-card-text">
                            {{ Str::limit($post->excerpt ?? $post->content, 100) }}
                        </p>

                        <div class="post-meta">
                            <span><i class="fas fa-user"></i> {{ $post->author->name ?? 'Unknown Author' }}</span>
                            <span><i class="fas fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
                            @if($post->comments_count)
                                <span><i class="fas fa-comments"></i> {{ $post->comments_count }}</span>
                            @endif
                        </div>

                        <div class="post-card-actions">
                            <a href="{{ route('admin.posts.edit', $post) }}"
                               class="post-action-btn edit"
                               title="Edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <a href="{{ route('blog.show', $post->slug) }}"
                               class="post-action-btn view"
                               title="View"
                               target="_blank">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post) }}"
                                  method="POST"
                                  class="post-action-form"
                                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="post-action-btn delete"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
