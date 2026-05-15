<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Request $request)
{
    $institutionId = session('institution_id')
        ?? auth()->user()?->institution_id;

    if (!$institutionId) {
        return redirect()->route('institution.select');
    }

    $posts = Post::where('institution_id', $institutionId)
        ->where('status', 'active')
        ->when($request->search, fn($q) =>
            $q->where('title', 'like', "%{$request->search}%")
        )
        ->when($request->posted_on, fn($q) =>
            $q->whereDate('created_at', $request->posted_on)
        )
        ->when($request->category_id, fn($q) =>
            $q->where('category_id', $request->category_id)
        )
        ->orderByDesc('date_found')
        ->orderByDesc('created_at')
        ->get()
        ->groupBy(fn($post) => $post->date_found->format('Y-m-d'));

    $categories = Category::orderBy('name')->get();

    return view('dashboard', compact('posts', 'categories'));
}

    public function archive()
    {
        return view('posts.archive');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function markReunited(Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}