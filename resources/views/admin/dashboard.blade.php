<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <p>You are logged in as an admin.</p>

    <h2 class="mt-6">Site Statistics</h2>
    <ul>
        <li><strong>Total Users:</strong> {{ $userCount }}</li>
        <li><strong>Total Posts:</strong> {{ $postCount }}</li>
        <li><strong>Total Comments:</strong> {{ $commentCount }}</li>
    </ul>

    <h2 class="mt-6">Manage Content</h2>
    <ul>
        <li><a href="{{ route('posts.index') }}">Manage Posts</a></li>
        <li><a href="{{ route('profile.edit') }}">Manage Users (edit your profile)</a></li>
        <!-- Add a route for user management if you implement it -->
    </ul>
</x-app-layout>