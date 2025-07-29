<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Posts
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">

        @if ($posts->isEmpty())
            <div class="text-center text-gray-600">
                <p class="text-lg mb-4">No posts found.</p>
                <a href="{{ route('posts.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                    Add your first loot item!
                </a>
            </div>
        @else
            <a href="{{ route('posts.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                Create New Item
            </a>

            @foreach ($posts as $post)
                <div class="border p-4 mb-4">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mb-3 rounded shadow" style="max-height:200px;">
                    @endif
                    <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <p class="text-sm text-gray-600">by {{ $post->user->name }}</p>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2">Delete</button>
                        </form>
                    @endcan
                </div>
            @endforeach
        @endif

    </div>
</x-app-layout>