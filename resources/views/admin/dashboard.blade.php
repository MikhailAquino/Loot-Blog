<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4">
        <div class="mb-6 flex justify-between items-center">
            <h3 class="text-2xl font-bold">Site Statistics</h3>
            <span class="text-gray-500 text-base">Welcome, {{ auth()->user()->name }}!</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <span class="text-4xl font-bold text-purple-600">{{ $userCount }}</span>
                <span class="text-gray-600 mt-2">Users</span>
            </div>
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <span class="text-4xl font-bold text-purple-600">{{ $postCount }}</span>
                <span class="text-gray-600 mt-2">Posts</span>
            </div>
            <div class="bg-white rounded shadow p-6 flex flex-col items-center">
                <span class="text-4xl font-bold text-purple-600">{{ $commentCount }}</span>
                <span class="text-gray-600 mt-2">Comments</span>
            </div>
        </div>

        <div class="bg-white rounded shadow p-6 mb-10">
            <div class="flex flex-col sm:flex-row gap-4 items-center mb-4">
                <h2 class="text-xl font-semibold px-4 py-2 rounded bg-gray-100 text-gray-800">
                    All Users
                </h2>
                <a href="{{ route('users.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow text-center font-semibold text-xl">
                    Add User
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Registered</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($user->is_admin)
                                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-semibold">Admin</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">User</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if (auth()->user()->is_admin)
                                        <a href="{{ route('users.edit', $user) }}"
                                        class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm shadow">Edit</a>
                                        @if(auth()->user()->id !== $user->id)
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm shadow ml-1">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded shadow p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-center mb-4">
                <h2 class="text-xl font-semibold px-4 py-2 rounded bg-gray-100 text-gray-800">
                    All Posts
                </h2>
                <a href="{{ route('posts.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow text-center font-semibold text-xl">
                    Create New Post
                </a>
            </div>
            @if ($posts->isEmpty())
                <p class="text-gray-600">No posts found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline font-medium">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        {{ $post->user->name }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        {{ $post->created_at->format('Y-m-d') }}
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="inline-block bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm shadow mr-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm shadow">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>