<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kelompok
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('daerah.store') }}" method="post">
                        @csrf
                        <input type="text" name="name" placeholder="masukkan nama"
                            class="input input-bordered w-full bg-white" />
                        <!-- error message untuk title -->
                        @error('name')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" name="dapukan" placeholder="masukkan dapukan"
                            class="input input-bordered w-full bg-white mt-4" />
                        <!-- error message untuk title -->
                        @error('dapukan')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <select name="desa_id" class="select select-bordered w-full bg-white mt-4">
                            <option disabled selected>Pilih Desa</option>
                            @foreach ($desas as $data)
                                <option id="desa_id" value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('desa_id')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <select name="kelompok_id" class="select select-bordered w-full bg-white mt-4">
                            <option disabled selected>Pilih Kelompok</option>
                            @foreach ($kelompoks as $data)
                                <option id="kelompok_id" value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('kelompok_id')
                            <div class="text-red-600 my-1">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex justify-start space-x-2">
                            <button type="submit" class="btn btn-primary my-4 text-white">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
