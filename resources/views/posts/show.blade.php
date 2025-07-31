<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <!-- Display the blog post thumbnail image -->
            @if ($post->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Thumbnail" class="w-full h-64 object-cover rounded-lg">
                </div>
            @endif

            <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
            <p class="text-gray-700 mb-6">{{ $post->body }}</p>
            <p class="text-sm text-gray-500">Given by {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
        </div>

        <!-- Comments section -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold">Comments</h3>
            @foreach ($post->comments as $comment)
                <div class="mt-2 p-3 bg-gray-100 rounded">
                    <p>{{ $comment->body }}</p>
                    <p class="text-xs text-gray-500">
                        by {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                    </p>

                    @can('delete', $comment)
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    @endcan
                </div>
            @endforeach

            <!-- Add comment form -->
            @auth
                <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                    @csrf
                    <textarea name="body" rows="3" class="w-full border rounded px-3 py-2" placeholder="Write a comment..."></textarea>
                    <button type="submit" class="mt-2 bg-purple-600 text-white px-4 py-2 rounded">
                        Add Comment
                    </button>
                </form>
            @else
                <p class="mt-4 text-gray-600">Log in to leave a comment.</p>
            @endauth
        </div>
    </div>
</x-app-layout>