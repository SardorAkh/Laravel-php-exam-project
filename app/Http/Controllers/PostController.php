<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index() {
        $post = Post::where('user_id', Auth::user()->id)->get();
        return Inertia::render('Dashboard',[
            'posts' =>  $post->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                ];
            })
        ]);
    }
    public function show(Post $post) {
        return Inertia::render('Post',[
            'post' => $post
        ]);
    }
    public function create() {
        return Inertia::render('Post/Create');
    }
    public function store(Request $request) {

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
        ]);

        return Redirect::route('dashboard');
    }
    public function update(Post $post,Request $request) {

        dd($post);

        return Redirect::route('dashboard');
    }
    public function edit(Post $post) {

        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }
}
