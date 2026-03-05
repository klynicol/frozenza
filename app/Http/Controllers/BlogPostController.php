<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Helpers\PizzaHelper;

class BlogPostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $posts = BlogPost::with('author')
            ->published()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        Inertia::share('meta', [
            'title' => 'Frozen Pizza Blog - Tips, Reviews & News',
            'description' => 'Read the latest blog posts about frozen pizzas, cooking tips, reviews, and more.',
            'keywords' => "frozen pizza, pizza reviews, pizza tips, frozen pizza news, pizza recipes, Connie's frozen pizza recall, frozen pizza safety, pizza blog",
            'canonicalUrl' => "/blogs",
        ]);

        return Inertia::render('Blog/Index', [
            'posts' => $posts
        ]);
    }

    public function show(BlogPost $post)
    {
        $post->load('author');

        // Ensure title is under 65 characters
        $title = Str::limit($post->title, 60) . ' - Pizza Kraken';
        
        Inertia::share('meta', [
            'title' => $title,
            'description' => $post->meta_description,
            'keywords' => $post->keywords ?? '',
            'canonicalUrl' => "/blogs/{$post->slug}",
        ]);

        return Inertia::render('Blog/Show', [
            'post' => $post,
            'content' => $post->content,
            'pizzas' => PizzaHelper::getPizzasPaginated(1),
        ]);
    }

    public function create()
    {
        Inertia::share('meta', [
            'title' => 'Write a New Blog Post - Pizza Kraken',
            'description' => 'Create a new blog post about frozen pizzas, reviews, and cooking tips.',
        ]);

        return Inertia::render('Blog/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:65535',
            'content' => 'nullable|string',
            'feature_image' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:65535',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'published_at' => 'nullable|date',
            'is_published' => 'boolean',
        ]);

        // Handle publish date logic
        if ($validated['is_published'] ?? false) {
            $validated['published_at'] = now();
        } elseif (!empty($validated['published_at'])) {
            $validated['published_at'] = $validated['published_at'];
        } else {
            $validated['published_at'] = null; // Draft
        }

        $post = BlogPost::create([
            // 'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'meta_description' => $validated['meta_description'],
            'content' => $validated['content'] ?? null,
            'feature_image' => $validated['feature_image'] ?? null,
            'keywords' => $validated['keywords'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'published_at' => $validated['published_at'],
        ]);

        return redirect()->route('blogs.show', $post)
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(BlogPost $post)
    {
        $this->authorize('update', $post);

        Inertia::share('meta', [
            'title' => 'Edit Post: ' . Str::limit($post->title, 45),
            'description' => 'Edit your blog post content, images, and settings.',
        ]);

        return Inertia::render('Blog/Edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, BlogPost $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:65535',
            'content' => 'nullable|string',
            'feature_image' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:65535',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'published_at' => 'nullable|date',
        ]);

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'meta_description' => $validated['meta_description'],
            'content' => $validated['content'] ?? null,
            'feature_image' => $validated['feature_image'] ?? null,
            'keywords' => $validated['keywords'] ?? null,
            'tags' => $validated['tags'] ?? null,
            'published_at' => $validated['published_at'],
        ]);

        return redirect()->route('blogs.show', $post)
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }
} 