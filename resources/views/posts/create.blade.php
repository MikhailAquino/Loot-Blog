<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Post
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center text-gray-500 hover:text-gray-700 px-3 py-1 rounded transition mb-4 -ml-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Create New User</h3>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="title">Title</label>
                    <input type="text" name="title" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="body">Body</label>
                    <textarea name="body" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="image">Photo</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="block w-full text-sm text-gray-700
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                            border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-200 transition"
                        accept="image/*"
                    >
                    @error('image')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                        Save Loot
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
