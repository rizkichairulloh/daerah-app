<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="w-full flex justify-end mb-6">
                        <div class="flex space-x-2">
                            {{-- <a href="#" class="btn btn-sm btn-info text-white hover:text-gray-900">Export PDF</a> --}}
                            <a href="{{ route('blog.create') }}"
                                class="btn btn-sm btn-primary text-white hover:text-gray-900">Tambah</a>
                        </div>
                    </div>
                    <table class="uk-table uk-table-hover uk-table-striped data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Content</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


        // Function to handle delete operation
        function deletePost(id) {
            if (confirm('Are you sure you want to delete this BLOG?')) {
                $.ajax({
                    url: '/blog/' + id,
                    method: 'DELETE', // Use the DELETE method for deleting resources
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token if you're using it
                    },
                    success: function(response) {
                        if (response.success == 1) {
                            alert("Blog deleted successfully.");

                            // Reload DataTable
                            $('.data-table').DataTable().ajax.reload();
                        } else {
                            alert("Invalid ID.");
                        }
                    },
                    error: function(xhr) {
                        alert('Error deleting post. Please try again.');
                    }
                });
            }
        }

        $(function() {
            var table = $('.data-table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('blog.index') }}",
                columns: [{
                        data: 'no',
                        name: 'no',
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            $updateButton = '<a href="{{ route('blog.edit', ':id')}}" class="btn btn-sm btn-primary text-white">EDIT</a>';

                            $deleteButton = "<button onclick='deletePost(" + full.id +
                                ")' class='btn btn-sm btn-error text-white deleteUser'>Hapus</i></button>";
                            return "<div class='flex space-x-2'>" + $updateButton.replace(":id", full.id) + $deleteButton +
                                "</div>";
                        },
                    },
                ]
            });
        });
    </script>
</x-app-layout>
