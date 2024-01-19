<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('blog.store') }}" method="post">
                        @csrf
                        <input type="text" name="title" placeholder="masukkan title"
                            class="input input-bordered w-full bg-white" />
                        <!-- error message untuk title -->
                        @error('title')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea name="description" class="textarea textarea-bordered w-full bg-white mt-4" placeholder="masukkan diskripsi"></textarea>
                        <!-- error message untuk title -->
                        @error('description')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea name="content" class="textarea textarea-bordered w-full bg-white mt-4" placeholder="masukkan content"></textarea>
                        <!-- error message untuk title -->
                        @error('content')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex justify-start space-x-2 my-4">
                            <a href="{{ route('blog.index') }}" class="btn btn-outline">Batal</a>
                            <button type="submit" class="btn btn-primary text-white">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
