<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            DESA
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-end">
                        <a href="{{ route('desa.create') }}" class="btn btn-primary text-white mb-4">Tambah</a>
                    </div>
                    <table class="table">
                        <tr class="bg-primary">
                            <th class="text-white">No</th>
                            <th class="text-white">Nama</th>
                            <th class="text-white">Created_at</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                        @foreach ($desas as $data)
                            <tr>
                                <td class="text-gray-800">{{ $loop->iteration }}</td>
                                <td class="text-gray-800">{{ $data->name }}</td>
                                <td class="text-gray-800">{{ $data->created_at }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('desa.destroy', $data->id) }}" method="POST">
                                        <a href="{{ route('desa.edit', $data->id) }}"
                                            class="btn btn-sm btn-primary text-white">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
