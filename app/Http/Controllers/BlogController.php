<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index()
    {
        $posts = Post::with(['author', 'tags'])
            ->when(request('category'), function($query, $category) {
                return $query->where('category', $category);
            })
            ->when(request('tag'), function($query, $tag) {
                return $query->whereHas('tags', function($q) use ($tag) {
                    $q->where('slug', $tag);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Get all categories
        $categories = Post::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        // Get popular tags
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(Post $post)
    {
        $relatedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        // Get all categories
        $categories = Post::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        // Get popular tags
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts', 'categories', 'tags'));
    }

    /**
     * Display blog posts by category.
     */
    public function category($category)
    {
        $posts = Post::with(['author', 'tags'])
            ->where('category', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Get all categories
        $categories = Post::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        // Get popular tags
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'tags'))
            ->with('category', $category);
    }

    /**
     * Search blog posts.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $posts = Post::with(['author', 'tags'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Get all categories
        $categories = Post::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        // Get popular tags
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        return view('blog.index', compact('posts', 'categories', 'tags'))
            ->with('search', $query);
    }
}
