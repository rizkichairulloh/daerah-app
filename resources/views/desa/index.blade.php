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
                    <div class="w-full flex justify-between items-center mb-6">
                        <form action="{{ route('desa.index') }}" method="GET">
                            <input type="search" name="search" placeholder="Cari desa..."
                                class="bg-white text-gray-900 input input-bordered input-info w-full" />
                        </form>
                        <div class="flex space-x-2">
                            {{-- <a href="{{ route('import-excel-desa') }}" class="btn btn-success text-white">Import PDF</a> --}}
                            <!-- Open the modal using ID.showModal() method -->
                            <button class="btn btn-sm btn-warning text-white" onclick="my_modal_1.showModal()">Import
                                Excel</button>
                            <dialog id="my_modal_1" class="modal">
                                <div class="modal-box bg-white">
                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <div class="flex justify-between items-center mb-8">
                                            <p class="text-gray-900 font-bold font-sans text-3xl">Import</p>
                                            <button class="text-gray-900 font-bold font-sans text-2xl">X</button>
                                        </div>

                                    </form>
                                    <form action="{{ route('import-excel-desa') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="file" name="upload-file" required="required"
                                            class="file-input file-input-bordered file-input-primary w-full bg-white" />

                                        <div class="modal-action flex">
                                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                                        </div>
                                    </form>

                                </div>
                            </dialog>
                            <a href="{{ route('exportpdfdesa') }}" class="btn btn-sm btn-info text-white">Export PDF</a>
                            <a href="{{ route('desa.create') }}" class="btn btn-sm btn-primary text-white">Tambah</a>
                        </div>
                    </div>
                    <table class="table">
                        <tr class="bg-primary">
                            <th class="text-white">No</th>
                            <th class="text-white">Desa</th>
                            <th class="text-white">Koordinator / KI</th>
                            <th class="text-white">Created</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                        @foreach ($desas as $data)
                            <tr>
                                <td class="text-gray-800">{{ $loop->iteration }}</td>
                                <td class="text-gray-800">{{ $data->name }}</td>
                                <td class="text-gray-800">{{ $data->koordinator }}</td>
                                <td class="text-gray-800">{{ $data->created_at }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('desa.destroy', $data->id) }}" method="POST">
                                        <a href="{{ route('desa.edit', $data->id) }}"
                                            class="btn btn-sm btn-primary text-white">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-ghost text-red-800 hover:bg-red-800 hover:text-white">HAPUS</button>
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
