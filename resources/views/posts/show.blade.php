<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8">
            <!-- Back Button -->
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center text-gray-500 hover:text-gray-700 px-3 py-1 rounded transition mb-4 -ml-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>

            <!-- Post Content -->
            <h3 class="text-3xl font-bold mb-4 text-gray-800">{{ $post->title }}</h3>
            <div class="mb-4 text-gray-600 text-sm flex items-center gap-2">
                <span>By {{ $post->user->name ?? 'Unknown' }}</span>
                <span>•</span>
                <span>{{ $post->created_at->format('F j, Y') }}</span>
            </div>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="rounded-lg shadow mb-6 max-h-80 w-full object-cover">
            @endif
            <div class="mb-6 text-gray-700 text-lg leading-relaxed">
                {!! nl2br(e($post->body)) !!}
            </div>
            @if($post->tags && count($post->tags))
                <div class="mb-6">
                    @foreach ($post->tags as $tag)
                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold mr-2 mb-2">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            <!-- Comments Section -->
            <div class="mt-8">
                <h4 class="text-lg font-semibold mb-4">Comments ({{ $post->comments->count() }})</h4>
                <div class="space-y-4">

                    <!-- Loop: Display Comments -->
                    @foreach($post->comments as $comment)
                        <div class="bg-gray-50 rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-semibold text-gray-700">{{ $comment->user->name ?? 'Anonymous' }}</span>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-gray-700 mb-2">
                                {!! nl2br(e($comment->body)) !!}
                            </div>
                            <div class="flex gap-2">
                                @can('delete', $comment)
                                    <div>
                                        <a href="{{ route('comments.edit', $comment) }}"
                                        class="text-blue-600 hover:underline text-sm font-semibold">Edit</a>
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete this comment?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm font-semibold">Delete</button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Add Comment Form -->
            @auth
            <div class="mt-10">
                <h4 class="text-lg font-semibold mb-4">Add a Comment</h4>
                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="body" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Type your comment here..." required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <button type="submit"
                                class="bg-blue-100 text-blue-700 border border-blue-300 px-4 py-2 rounded shadow-sm hover:bg-blue-200 transition font-semibold">
                            Post Comment
                        </button>
                    </div>
                </form>
            </div>
            @endauth

            <!-- Optional: Edit/Delete actions for authorized users -->
            @can('update', $post)
                <div class="flex gap-2 mt-6">
                    <a href="{{ route('posts.edit', $post) }}"
                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 px-4 py-2 rounded-lg shadow text-sm font-semibold transition">
                        Edit
                    </a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg shadow text-sm font-semibold transition">
                            Delete
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
</x-app-layout>