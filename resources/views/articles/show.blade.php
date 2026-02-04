<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('View Article') }}
            </h2>
            <a href="{{ route('articles.index') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <h1 class="font-semibold text-lg mb-2"> {{ $article->title }}</h1>
                        <p class="text-gray-500 text-sm mt-2">
                            Author: {{ $article->author }} | 
                            Created: {{ $article->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>


                    <div class="mb-4">
                        <h2 class="font-semibold text-lg mb-2">Content:</h2>
                        <p class="text-gray-700 whitespace-pre-line">{{ $article->text }}</p>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('articles.edit', $article->id) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Edit
                        </a>

                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>