<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
             @can('create users')
            <a href="{{ route('users.create') }}"
            
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create User
            </a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Success message --}}
                    @if(session('success'))
                        <div class="mb-4 w-full p-4 bg-green-500 text-black font-semibold rounded shadow">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full table-auto border border-gray-300">
    <thead class="bg-gray-50">
        <tr>
            <th class="border px-3 py-2">#</th>
            <th class="border px-3 py-2">User Name</th>
            <th class="border px-3 py-2">Email</th>
            <th class="border px-3 py-2">Roles</th>
            <th class="border px-3 py-2">Created</th>
            <th class="border px-3 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td class="border px-3 py-2">{{ $user->id }}</td>
            <td class="border px-3 py-2">{{ $user->name }}</td>
            <td class="border px-3 py-2">{{ $user->email }}</td>
            <td class="border px-3 py-2">
                @forelse($user->roles as $role)
                    <span class="inline-block bg-gray-200 text-sm px-2 py-1 rounded mr-1 mb-1">
                        {{ $role->name }}
                    </span>
                @empty
                    <span class="text-gray-400">No Role</span>
                @endforelse
            </td>
            <td class="border px-3 py-2">{{ $user->created_at->format('d M Y') }}</td>
            <td class="border px-3 py-2">
             @can('edit users')
                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 mr-2">Edit</a>
                   @endcan

                   @can('delete users')
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600">Delete</button>
                </form>
                   @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center py-3">No Users Found</td>
        </tr>
        @endforelse
    </tbody>
</table>


                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
