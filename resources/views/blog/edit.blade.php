<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('blog.update', $blog->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" placeholder="masukkan title"
                            class="input input-bordered w-full bg-white" value="{{ old('title', $blog->title) }}" />
                        <!-- error message untuk title -->
                        @error('title')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea name="description" class="textarea textarea-bordered w-full bg-white mt-4" placeholder="masukkan diskripsi">{{ old('description', $blog->description) }}</textarea>
                        <!-- error message untuk title -->
                        @error('description')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea name="content" class="textarea textarea-bordered w-full bg-white mt-4" placeholder="masukkan content">{{ old('content', $blog->content) }}</textarea>
                        <!-- error message untuk title -->
                        @error('content')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex justify-start space-x-2">
                            <button type="submit" class="btn btn-primary my-4 text-white">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
