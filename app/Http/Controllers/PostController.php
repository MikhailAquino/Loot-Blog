<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|max:2048', // Validate image
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image'] = $path;
        }

        $request->user()->posts()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        $post->load('comments.user');
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

        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validate image (optional)
        ]);

        // If the user uploads a new image, handle the upload
        if ($request->hasFile('image')) {
            // Delete old image from storage
            if ($post->image) {
                Storage::delete('public/posts/' . $post->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('public/posts');
            $validated['image'] = basename($imagePath); // Save the new image file name
        }

        // Update the post with the validated data
        $post->update($validated);

        return redirect()->route('dashboard')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        // Remove the specified resource from storage. Only owner can delete.
        $this->authorize('delete', $post);

        // Delete the associated image if it exists
        if ($post->image) {
            Storage::delete('public/posts/' . $post->image);
        }

        // Delete the post
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted!');
    }
}