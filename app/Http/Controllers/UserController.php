<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $validated['is_admin'] = $request->has('is_admin');

        $user->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting self for safety
        if (auth()->id() === $user->id) {
            return back()->with('error', "You can't delete your own account.");
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'is_admin' => $request->has('is_admin'),
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'User created!');
    }
}
