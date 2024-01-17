<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            KELOMPOK
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="w-full flex justify-between items-center mb-6">
                        <form action="{{ route('kelompok.index') }}" method="GET">
                            <input type="search" name="search" placeholder="Cari kelompok..."
                                class="bg-white text-gray-900 input input-bordered input-info w-full" />
                        </form>
                        <div class="flex space-x-2">
                            <a href="{{ route('export-excel-kelompok') }}" class="btn btn-success text-white">Export Excel</a>
                            <a href="{{ route('exportpdfkelompok') }}" class="btn btn-info text-white">Export PDF</a>
                            <a href="{{ route('kelompok.create') }}" class="btn btn-primary text-white">Tambah</a>
                        </div>
                    </div>
                    <table class="table">
                        <tr class="bg-primary">
                            <th class="text-white">No</th>
                            <th class="text-white">Kelompok</th>
                            <th class="text-white">Koor Kelompok</th>
                            <th class="text-white">Desa</th>
                            <th class="text-white">Koor Desa</th>
                            <th class="text-white">Created</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                        @foreach ($kelompoks as $index => $data)
                            <tr>
                                <td class="text-gray-800">{{ $index + $firstItem }}</td>
                                <td class="text-gray-800">{{ $data->name }}</td>
                                <td class="text-gray-800">{{ $data->koordinator }}</td>
                                <td class="text-gray-800">{{ $data->desa->name }}</td>
                                <td class="text-gray-800">{{ $data->desa->koordinator }}</td>
                                <td class="text-gray-800">{{ $data->created_at }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('kelompok.destroy', $data->id) }}" method="POST">
                                        {{-- <a href="{{ route('kelompok.edit', $data->id) }}"
                                            class="btn btn-sm btn-primary text-white">EDIT</a> --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-ghost text-red-800 hover:bg-red-800 hover:text-white -ml-4">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="mt-4">
                        {{ $kelompoks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
