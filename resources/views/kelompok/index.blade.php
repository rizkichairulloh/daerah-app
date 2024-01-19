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
                            <a href="{{ route('export-excel-kelompok') }}"
                                class="btn btn-sm btn-success text-white">Export Excel</a>
                            <a href="{{ route('exportpdfkelompok') }}" class="btn btn-sm btn-info text-white">Export
                                PDF</a>
                            <a href="{{ route('kelompok.create') }}"
                                class="btn btn-sm btn-primary text-white">Tambah</a>
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
                                    <form id="deleteForm" method="POST">
                                        {{-- <a href="{{ route('kelompok.edit', $data->id) }}"
                                            class="btn btn-sm btn-primary text-white">EDIT</a> --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-sm btn-ghost text-red-800 hover:bg-red-800 hover:text-white -ml-4"
                                            onclick="confirmDelete('{{ $data->id }}')">HAPUS</button>
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
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, update the form action with the correct item ID and submit the form
                    document.getElementById('deleteForm').action = "{{ route('kelompok.destroy', '') }}" + '/' +
                        itemId;
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
</x-app-layout>
