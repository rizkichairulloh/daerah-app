<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog
        </h2>
    </x-slot>

    <!-- Modal -->
    <div id="updateModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Employee Name</label>
                        <input type="text" class="form-control" id="emp_name" placeholder="Enter Employee name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id='gender' class="form-control">
                            <option value='Male'>Male</option>
                            <option value='Female'>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter city">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="txt_empid" value="0">
                    <button type="button" class="btn btn-success btn-sm" id="btn_save">Save</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="uk-table uk-table-hover uk-table-striped data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-gray-900">No</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('blog.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
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
                            $updateButton = "<button class='btn btn-sm btn-success text-white updateUser' data-id='" + full.id + "' data-bs-toggle='modal' data-bs-target='#updateModal' >Edit</button>";

                            $deleteButton = "<button onclick='deletePost(" + full.id + ")' class='btn btn-sm btn-error text-white deleteUser'>Hapus</i></button>";
                            return "<div class='flex space-x-2'>" + $updateButton + $deleteButton + "</div>";
                        },
                    },
                ]
            });
        });
    </script>
</x-app-layout>
