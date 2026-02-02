<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
        <a href="{{ route('permissions.index') }}"
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
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Permission Create Form --}}
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Role Name
                            </label>
                            <input type="text" name="name" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Enter Name"
                                   required>
                            
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                            
                    <div class="grid grid-cols-4 mb-4">
                    @if ($permissions->isNotEmpty())
                    @foreach ($permissions as $permission)
                    <div class="mt-3">
                    <input type="checkbox" class="rounded" name="permission[]" value="{{ $permission->name }}">
                    <label for="">{{ $permission->name}}</label>
                    </div>
                    @endforeach
                    @endif
                    </div>

                        <button type="submit"
                                class="bg-blue-600 text-white px-5 py-3 rounded hover:bg-blue-700">
                            Save Permission
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
