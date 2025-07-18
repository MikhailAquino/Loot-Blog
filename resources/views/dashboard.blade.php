<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4">
        <div class="mb-6 flex justify-between items-center">
            <h3 class="text-2xl font-bold">Available Posts</h3>
            <a href="{{ route('posts.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                Add New Post
            </a>
        </div>

        @if ($posts->isEmpty())
            <div class="text-center text-gray-600">
                <p class="text-lg mb-4">You don’t have any posts yet!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white rounded shadow p-6 relative transition transform hover:scale-105 hover:shadow-lg">
                        <a href="{{ route('posts.show', $post) }}" class="absolute inset-0 z-10"></a>

                        <h2 class="text-xl font-semibold mb-2">
                            {{ $post->title }}
                        </h2>

                        <p class="text-gray-700 mb-4">
                            {{ \Illuminate\Support\Str::limit($post->body, 100) }}
                        </p>

                        <p class="text-sm text-gray-500 mb-2">
                            by {{ $post->user->name }}
                        </p>

                        <p class="text-purple-700">
                            💬 {{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}
                        </p>

                        <div class="flex justify-between items-center relative z-20">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>