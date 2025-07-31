<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Comment</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md p-8">
            <a href="{{ route('posts.show', $comment->post_id) }}"
                class="inline-flex items-center text-gray-500 hover:text-gray-700 px-3 py-1 rounded transition mb-4 -ml-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Edit Comment</h3>
            <form method="POST" action="{{ route('comments.update', $comment) }}">
                @csrf
                @method('PUT')
                <textarea name="body" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('body', $comment->body) }}</textarea>
                @error('body')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                        Update Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>