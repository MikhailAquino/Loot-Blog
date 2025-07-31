<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-8">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center text-gray-500 hover:text-gray-700 px-3 py-1 rounded transition mb-4 -ml-2 focus:outline-none focus:ring-2 focus:ring-blue-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">Name</label>
                    <input name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2">Email</label>
                    <input name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-6 flex items-center">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_admin" value="1" class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-400" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                        <span class="ml-2">Make this user an admin</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
