<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $commentCount = Comment::count();
        $posts = Post::with('user')->latest()->get();
        $users = User::latest()->get();
        return view('admin.dashboard', compact('userCount', 'postCount', 'commentCount', 'posts', 'users'));
    }
}
