<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add User
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
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="password">Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block font-medium text-gray-700 mb-2" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="mb-6 flex items-center">
                    <input id="is_admin" type="checkbox" name="is_admin" value="1"
                        class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-400"
                        {{ old('is_admin') ? 'checked' : '' }}>
                    <label for="is_admin" class="font-medium text-gray-700">Make this user an admin</label>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>