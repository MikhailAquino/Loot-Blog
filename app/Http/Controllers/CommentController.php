<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment added.');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment deleted.');
    }
}