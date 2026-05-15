<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['required', 'string'],
            'category_id'    => ['required', 'exists:categories,id'],
            'location_found' => ['required', 'string', 'max:255'],
            'date_found'     => ['required', 'date', 'before_or_equal:today'],
            'contact_phone'  => ['required', 'string', 'max:20'],
            'photo'          => ['nullable', 'image', 'mimes:jpg,png,webp', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('posts', 'public');
        }

        Post::create([
            'user_id'        => Auth::id(),
            'institution_id' => Auth::user()->institution_id,
            'category_id'    => $request->category_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'location_found' => $request->location_found,
            'date_found'     => $request->date_found,
            'contact_phone'  => $request->contact_phone,
            'photo_path'     => $photoPath,
            'status'         => 'active',
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['required', 'string'],
            'category_id'    => ['required', 'exists:categories,id'],
            'location_found' => ['required', 'string', 'max:255'],
            'date_found'     => ['required', 'date', 'before_or_equal:today'],
            'contact_phone'  => ['required', 'string', 'max:20'],
            'photo'          => ['nullable', 'image', 'mimes:jpg,png,webp', 'max:2048'],
        ]);

        $photoPath = $post->photo_path;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('posts', 'public');
        }

        $post->update([
            'category_id'    => $request->category_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'location_found' => $request->location_found,
            'date_found'     => $request->date_found,
            'contact_phone'  => $request->contact_phone,
            'photo_path'     => $photoPath,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
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