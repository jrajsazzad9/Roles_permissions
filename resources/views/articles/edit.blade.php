<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Article') }}
            </h2>
            <a href="{{ route('articles.index') }}"
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
                        <div class="mb-4 w-full p-4 bg-green-500 text-black font-semibold rounded shadow">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Update Article Form --}}
                    <form method="POST" action="{{ route('articles.update', $article->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <input type="text" name="title"
                                   value="{{ old('title', $article->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   required>

                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Text --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Text
                            </label>
                            <textarea name="text"
                                      rows="5"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('text', $article->text) }}</textarea>

                            @error('text')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Author --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Author
                            </label>
                            <input type="text" name="author"
                                   value="{{ old('author', $article->author) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   required>

                            @error('author')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="bg-blue-600 text-white px-5 py-3 rounded hover:bg-blue-700">
                            Update Article
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
