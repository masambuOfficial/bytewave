<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author'])  // Eager load author relationship
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:posts',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|string'
        ]);

        // Handle tags
        $tags = $this->processTags($validated['tags'] ?? '');
        unset($validated['tags']);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $slug = \Str::slug($validated['title']);
            $filename = $slug . '.' . $extension;
            $path = $file->storeAs('posts', $filename, 'public');
            $validated['image'] = $path;
        }

        // Add user_id
        $validated['user_id'] = auth()->id();

        // Create post and sync tags
        $post = Post::create($validated);
        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'category' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|string'
        ]);

        // Handle tags
        $tags = $this->processTags($validated['tags'] ?? '');
        unset($validated['tags']);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                \Storage::disk('public')->delete($post->image);
            }
            
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $slug = \Str::slug($validated['title']);
            $filename = $slug . '.' . $extension;
            $path = $file->storeAs('posts', $filename, 'public');
            $validated['image'] = $path;
        }

        // Update post and sync tags
        $post->update($validated);
        $post->tags()->sync($tags);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        // Delete post image if exists
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        
        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully');
    }

    protected function processTags($tagsString)
    {
        if (empty($tagsString)) {
            return [];
        }

        // Split tags string into array and trim whitespace
        $tagNames = array_map('trim', explode(',', $tagsString));
        $tagNames = array_filter($tagNames); // Remove empty values

        $tags = [];
        foreach ($tagNames as $name) {
            // Find or create the tag
            $tag = Tag::firstOrCreate(
                ['name' => $name],
                ['slug' => \Str::slug($name)]
            );
            $tags[] = $tag->id;
        }

        return $tags;
    }
}
