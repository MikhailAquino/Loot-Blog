<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Post
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto px-4">
        <div class="bg-white rounded shadow p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

            <p class="text-gray-700 mb-6">
                {{ $post->body }}
            </p>

            <p class="text-sm text-gray-500 mb-6">
                Posted by {{ $post->user->name }} • {{ $post->created_at->format('M d, Y') }}
            </p>

            <div class="flex space-x-4">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                        Edit Post
                    </a>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
                            Delete Post
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}"
               class="text-blue-500 hover:underline">&larr; Back to Dashboard</a>
        </div>
    </div>
</x-app-layout>