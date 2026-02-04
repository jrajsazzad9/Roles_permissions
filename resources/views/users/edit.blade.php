<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
            </h2>
            <a href="{{ route('users.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Name</label>
                            <input type="text" name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full border px-3 py-2 rounded"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full border px-3 py-2 rounded"
                                   required>
                        </div>

                        <!-- Roles -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Roles</label>
                            <div class="grid grid-cols-4 gap-3">
                                @php
                                    $userRoles = $user->roles->pluck('name')->toArray();
                                @endphp

                                @foreach ($roles as $role)
                                    <div class="mt-1">
                                        <input type="checkbox"
                                               id="role-{{ $role->id }}"
                                               class="rounded"
                                               name="roles[]"
                                               value="{{ $role->name }}"
                                               {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- <!-- Password (optional) -->
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold">Password (leave blank if unchanged)</label>
                            <input type="password" name="password"
                                   class="w-full border px-3 py-2 rounded">
                        </div> --}}

                        <!-- Submit -->
                        <div class="mt-6">
                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Update User
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
