<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            @can('create permissions')
            <a href="{{ route('articles.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Create Article
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
                                <th class="border px-3 py-2">Title</th>
                                <th class="border px-3 py-2">Author</th>
                                <th class="border px-3 py-2">Created</th>
                                <th class="border px-3 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                                <tr>
                                    <td class="border px-3 py-2">{{ $article->id }}</td>
                                    <td class="border px-3 py-2">{{ $article->title }}</td>
                                    <td class="border px-3 py-2">{{ $article->author }}</td>
                                    <td class="border px-3 py-2">{{ $article->created_at->format('d M Y') }}</td>
                                    <td class="border px-3 py-2 flex gap-2">

                                        {{-- View Button --}}
                                        <a href="{{ route('articles.show', $article->id) }}"
                                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            View
                                        </a>

                                        {{-- Edit Button --}}
                                        @can('edit articles')
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                            Edit
                                        </a>
                                        @endcan

                                        @can('delete articles')
                                        {{-- Delete Button --}}
                                        <form action="{{ route('articles.destroy', $article->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">
                                        No articles found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $articles->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
