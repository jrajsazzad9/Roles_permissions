<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Permission') }}
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

                    {{-- Permission Edit Form --}}
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Permission Name
                            </label>
                            <input type="text" name="name" 
                                   value="{{ old('name', $permission->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="e.g. edit posts"
                                   required>
                            
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
        class="bg-blue-600 text-white px-5 py-3 rounded hover:bg-blue-700">
    Update Permission
</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
