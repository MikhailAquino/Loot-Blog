<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-semibold">Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded"
                       value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="body" class="block font-semibold">Body</label>
                <textarea name="body" rows="6" class="w-full border p-2 rounded" required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Update Post
            </button>
        </form>
    </div>
</x-app-layout>