<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Role') }}
            </h2>
            <a href="{{ route('roles.index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Success message --}}
                    @if(session('success'))
                        <div class="mb-4 text-green-600 font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Update Role Form --}}
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Role Name --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Role Name
                            </label>
                            <input type="text" name="name" 
                                   value="{{ old('name', $role->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   required>

                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Permissions --}}
                        <div class="grid grid-cols-4 gap-3 mb-4">
                            @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox"
                                           name="permission[]"
                                           value="{{ $permission->name }}"
                                           class="rounded"
                                           {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                    <label>{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit"
    class="bg-blue-600 text-white px-5 py-3 rounded hover:bg-blue-700">
    Update Role
</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
