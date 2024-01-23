<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengurus Daerah Klaten Utara
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="w-full flex justify-end items-center mb-6">
                        <div class="flex space-x-2">
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
                                    <form action="{{ route('import-excel-daerah') }}" method="post"
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
                            <a href="{{ route('export-excel-daerah') }}"
                                class="btn btn-sm btn-success text-white">Export Excel</a>
                            <a href="{{ route('exportpdfdaerah') }}" class="btn btn-sm btn-info text-white">Export
                                PDF</a>
                            <a href="{{ route('daerah.create') }}" class="btn btn-sm btn-primary text-white">Tambah</a>
                        </div>
                    </div>
                    <table class="uk-table uk-table-hover uk-table-striped data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Dapukan</th>
                                <th>Desa</th>
                                <th>Kelompok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // Function to handle delete operation
        function deletePost(id) {
            Swal.fire({
                title: 'Anda yakin akan hapus data ini?',
                text: 'anda tidak akan melihat data ini lagi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/daerah/' + id,
                        method: 'DELETE', // Use the DELETE method for deleting resources
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Include CSRF token if you're using it
                        },
                        success: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });

                            if (response.success == 1) {
                                Toast.fire({
                                    icon: "success",
                                    title: "Delete successfully!"
                                });
                                // Reload DataTable
                                $('.data-table').DataTable().ajax.reload();
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: "Delete Failed!"
                                });
                            }
                        },
                        error: function(xhr) {
                            Toast.fire({
                                icon: "error",
                                title: "Error deleting post. Please try again."
                            });
                        }
                    });
                }
            });
        }

        $(function() {
            var table = $('.data-table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('daerah.index') }}",
                columns: [{
                        data: 'no',
                        name: 'no',
                        sortable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'dapukan',
                        name: 'dapukan'
                    },
                    {
                        data: 'desa.name',
                        name: 'desa.name'
                    },
                    {
                        data: 'kelompok.name',
                        name: 'kelompok.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            $updateButton =
                                '<a href="{{ route('kelompok.edit', ':id') }}" class="btn btn-sm btn-primary text-white">EDIT</a>';

                            $deleteButton = "<button onclick='deletePost(" + full.id +
                                ")' class='btn btn-sm btn-error text-white deleteUser'>Hapus</i></button>";
                            return "<div class='flex space-x-2'>" + $updateButton.replace(":id",
                                    full.id) + $deleteButton +
                                "</div>";
                        },
                    },
                ]
            });
        });
    </script>
</x-app-layout>
