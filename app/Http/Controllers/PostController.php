<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        // Display a listing of the resource.
        $posts = Post::latest()->withCount('comments')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Show the form for creating a new resource.
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $request->user()->posts()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // Show the form for editing the specified resource.
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        // Remove the specified resource from storage.Only owner can delete
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted!');
    }
}
