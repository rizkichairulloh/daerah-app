<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kelompok
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('kelompok.update', $kelompok->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" placeholder="masukkan nama desa"
                            class="input input-bordered w-full bg-white" value="{{ old('name', $kelompok->name) }}" />
                        <!-- error message untuk title -->
                        @error('name')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (session('error'))
                            <div class="text-red-600 my-1">
                                {{ session('error') }}
                            </div>
                        @endif
                        <input type="text" name="koordinator" placeholder="masukkan nama koordinator / ki"
                            class="input input-bordered w-full bg-white mt-4"
                            value="{{ old('koordinator', $kelompok->koordinator) }}" />
                        <!-- error message untuk title -->
                        @error('koordinator')
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
