<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block font-medium text-gray-700 mb-2" for="title">Title</label>
                <input type="text" name="title" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block font-medium text-gray-700 mb-2" for="body">Body</label>
                <textarea name="body" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                    Update Post
                </button>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
