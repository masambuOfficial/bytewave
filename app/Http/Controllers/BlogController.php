<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display blog overview page (hero + latest posts)
     */
    public function index()
    {
        // Get hero article
        $heroArticle = Blog::published()
            ->hero()
            ->with(['author', 'category', 'tags'])
            ->first();

        // Get latest 5 posts for sidebar
        $latestPosts = Blog::published()
            ->with(['author', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Get featured articles for "Latest from the blog" section
        $featuredArticles = Blog::published()
            ->featured()
            ->with(['author', 'category', 'tags'])
            ->latest()
            ->take(6)
            ->get();

        // Get all categories for "Explore topics"
        $categories = Category::withCount('blogs')->get();

        // Get popular tags
        $popularTags = Tag::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->take(10)
            ->get();

        return view('blog.index', compact(
            'heroArticle',
            'latestPosts',
            'featuredArticles',
            'categories',
            'popularTags'
        ));
    }

    /**
     * Display all articles page with filters and search
     */
    public function all(Request $request)
    {
        $query = Blog::published()->with(['author', 'category', 'tags']);

        // Search
        if ($search = $request->get('search')) {
            $query->search($search);
        }

        // Filter by category
        if ($categoryId = $request->get('category')) {
            $query->byCategory($categoryId);
        }

        // Filter by tag
        if ($tagId = $request->get('tag')) {
            $query->byTag($tagId);
        }

        // Sort
        $sort = $request->get('sort', 'recent');
        switch ($sort) {
            case 'popular':
                $query->popular();
                break;
            case 'featured':
                $query->featured();
                break;
            default:
                $query->latest();
        }

        $articles = $query->paginate(12);

        // Get all categories and tags for filters
        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.all', compact('articles', 'categories', 'tags', 'search', 'sort'));
    }

    /**
     * Display single article
     */
    public function show(Blog $blog)
    {
        // Increment view count
        $blog->incrementViews();

        // Load relationships
        $blog->load(['author', 'category', 'tags', 'approvedComments.user', 'approvedComments.replies']);

        // Get related articles
        $relatedArticles = $blog->getRelatedPosts(3);

        return view('blog.show', compact('blog', 'relatedArticles'));
    }

    /**
     * Display articles by category
     */
    public function category(Category $category)
    {
        $articles = Blog::published()
            ->byCategory($category->id)
            ->with(['author', 'category', 'tags'])
            ->latest()
            ->paginate(12);

        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.all', compact('articles', 'category', 'categories', 'tags'));
    }

    /**
     * Display articles by tag
     */
    public function tag(Tag $tag)
    {
        $articles = Blog::published()
            ->byTag($tag->id)
            ->with(['author', 'category', 'tags'])
            ->latest()
            ->paginate(12);

        $categories = Category::all();
        $tags = Tag::all();

        return view('blog.all', compact('articles', 'tag', 'categories', 'tags'));
    }

    /**
     * Store a comment
     */
    public function storeComment(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'body' => 'required|min:3|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = new Comment($validated);
        $comment->blog_id = $blog->id;

        if (auth()->check()) {
            $comment->user_id = auth()->id();
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255'
            ]);
            $comment->name = $request->name;
            $comment->email = $request->email;
        }

        // Auto-approve for authenticated users, require approval for guests
        $comment->is_approved = auth()->check();
        $comment->save();

        return back()->with('success', auth()->check() 
            ? 'Comment posted successfully!' 
            : 'Comment submitted and awaiting approval.');
    }
}
