<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create Role
            </a>
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
                                <th class="border px-3 py-2">Role Name</th>
                                <th class="border px-3 py-2">Created</th>
                                <th class="border px-3 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-3 py-2">{{ $role->name }}</td>
                                    <td class="border px-3 py-2">{{ $role->created_at->format('d M Y') }}</td>
                                    <td class="border px-3 py-2">
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="text-blue-600 mr-2">
                                           Edit
                                        </a>

                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">
                                        No roles found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $roles->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
