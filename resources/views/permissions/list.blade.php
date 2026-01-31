
<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
        <a href="{{ route('permissions.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Create Permission
        </a>
    </div>
</x-slot>
    <div class="py-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Name</th>
                    <th class="border px-3 py-2">Created</th>
                    <th class="border px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-3 py-2">{{ $permission->name }}</td>
                        <td class="border px-3 py-2">{{ $permission->created_at->format('d M Y') }}</td>
                        <td class="border px-3 py-2">
                            <a href="{{ route('permissions.edit', $permission->id) }}"
                               class="text-blue-600 mr-2">Edit</a>

                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure?')"
                                    class="text-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-3">No permissions found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $permissions->links() }}
        </div>
    </div>
</div>
        </div>
    </div>
</x-app-layout>