<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('home');
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