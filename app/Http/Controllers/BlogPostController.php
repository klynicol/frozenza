<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BlogPostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $posts = BlogPost::with('author')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return Inertia::render('Blog/Index', [
            'posts' => $posts,
            'meta' => [
                'title' => 'Frozen Pizza Blog - Reviews, Tips & News',
                'description' => 'Read the latest blog posts about frozen pizzas, cooking tips, reviews, and more.',
            ]
        ]);
    }

    public function show(BlogPost $post)
    {
        $post->load('author');

        return Inertia::render('Blog/Show', [
            'post' => $post,
            'meta' => [
                'title' => $post->title,
                'description' => Str::limit(strip_tags($post->content), 160),
                'imageUrl' => $post->featured_image,
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Blog/Create', [
            'meta' => [
                'title' => 'Create New Blog Post',
                'description' => 'Write a new blog post about frozen pizzas.',
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'published_at' => 'nullable|date',
        ]);

        $post = BlogPost::create([
            ...$validated,
            'user_id' => Auth::id(),
            'slug' => Str::slug($validated['title']),
        ]);

        return redirect()->route('blog.show', $post)
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $post)
    {
        $this->authorize('update', $post);

        return Inertia::render('Blog/Edit', [
            'post' => $post,
            'meta' => [
                'title' => "Edit: {$post->title}",
                'description' => 'Edit your blog post.',
            ]
        ]);
    }

    public function update(Request $request, BlogPost $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'published_at' => 'nullable|date',
        ]);

        $post->update([
            ...$validated,
            'slug' => Str::slug($validated['title']),
        ]);

        return redirect()->route('blog.show', $post)
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Blog post deleted successfully!');
    }
} 