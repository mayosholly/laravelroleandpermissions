<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return inertia('Post/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Post/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);
        $post = new Post($validated);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('post_photo');
            $post->image = $image;
            if ($image) {
                $post->setAttribute('image', $image);
            }
        };
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return inertia('Post/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('post_photo');
            $post->image = $image;
            if ($image) {
                $post->setAttribute('image', $image);
            }
        }
        $post->update($validated);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Storage::delete($post->image);
        $post->delete();
        return redirect()->route('posts.index');

    }
}
