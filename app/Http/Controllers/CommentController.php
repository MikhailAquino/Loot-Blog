<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment added!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }

}