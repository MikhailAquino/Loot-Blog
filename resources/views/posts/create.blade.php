<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Item to the Vault
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block font-semibold">Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="body" class="block font-semibold">Body</label>
                <textarea name="body" rows="6" class="w-full border p-2 rounded" required>{{ old('body') }}</textarea>
                @error('body')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="image" class="block font-semibold">Photo</label>
                <input type="file" name="image" class="w-full border p-2 rounded" accept="image/*">
                @error('image')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Save Loot
            </button>
        </form>
    </div>
</x-app-layout>