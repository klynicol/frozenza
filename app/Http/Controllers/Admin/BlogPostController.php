<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BlogPostController extends Controller
{
    /**
     * Display a listing of blog posts for admin.
     */
    public function index(Request $request): InertiaResponse
    {
        $posts = BlogPost::with('author:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Admin/BlogPosts/Index', [
            'posts' => $posts,
        ]);
    }
}
