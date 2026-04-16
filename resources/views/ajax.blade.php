<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>

    <title>Ajax-Crud</title>
    <!-- ✅ Custom CSS -->
    <style>
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container mt-3">

        <p id="respanel">Click on the button to open the modal.</p>

        <a href="javascript::void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
            Open modal
        </a>
    </div>


    <div class="container">
        <div class="row justify-content-center mt-10">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="datatable">
                        <thead class="table-success">
                            <th>SL No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </thead>
                        {{-- <tbody id="employee_data">
                            @foreach ($employees as $key => $row)
                                <tr>
                                    <th> {{ $key + 1 }} </th>
                                    <td> {{ $row->name }}</td>
                                    <td> {{ $row->email }}</td>
                                    <td> {{ $row->mobile }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-employee"
                                            data-id="{{ $row->id }}" data-name="{{ $row->name }}"
                                            data-email="{{ $row->email }}" data-mobile="{{ $row->mobile }}"
                                            data-bs-toggle="modal" data-bs-target="#myEditModal">
                                            Edit
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-employee"
                                            data-id="{{ $row->id }}">
                                            Delete
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Create Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Employee Records</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="container mt-3">

                        <form id="submitform">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter UserName"
                                    name="name">
                                <span id="nameError" class="error"></span>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                                <span id="emailError" class="error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password"
                                    name="password">
                                <span id="passwordError" class="error"></span>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="email">Mobile:</label>
                                <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile"
                                    name="mobile">
                                <span id="mobileError" class="error"></span>
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div id="successMsg" class="mt-3 text-success"></div>

    <!-- Edit Modal -->

    <div class="modal" id="myEditModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee Records</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="container mt-3">

                        <form id="updateForm">
                            @csrf
                            <input type="hidden" name="id" id="employee_id">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="mb-3 mt-3">
                                <label>Name:</label>
                                <input type="text" class="form-control" id="employee_name" name="name">
                                <span id="edit_nameError" class="error"></span>
                            </div>

                            <div class="mb-3 mt-3">
                                <label>Email:</label>
                                <input type="email" class="form-control" id="employee_email" name="email">
                                <span id="edit_emailError" class="error"></span>
                            </div>

                            <div class="mb-3 mt-3">
                                <label>Mobile:</label>
                                <input type="text" class="form-control" id="employee_mobile" name="mobile">
                                <span id="edit_mobileError" class="error"></span>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        id="updateBtn">Close</button>
                </div>

            </div>
        </div>
    </div>
    <div id="successMsg" class="mt-3 text-success"></div>
</body>

</html>


<script>
    $(document).ready(function() {

        // ================= CSRF SETUP =================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // ================= CREATE EMPLOYEE =================
        $('#submitform').submit(function(e) {
            e.preventDefault(); // IMPORTANT

            let data = $(this).serialize();

            $.ajax({
                url: "{{ route('employees.store') }}",
                type: "POST",
                data: data,

                beforeSend: function() {
                    $('.error').text("");
                    $('#successMsg').text("");
                },

                success: function(response) {
                    $('#successMsg').text(response.message);
                    $('#submitform')[0].reset();
                    window.location.reload(true)
                },

                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;

                    if (errors.name) {
                        $('#nameError').text(errors.name[0]);
                    }
                    if (errors.email) {
                        $('#emailError').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#passwordError').text(errors.password[0]);
                    }
                    if (errors.mobile) {
                        $('#mobileError').text(errors.mobile[0]);
                    }
                }


            });

        });

        // ================= EDIT EMPLOYEE (OPEN MODAL) =================
        $(document).on('click', '.edit-employee', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let mobile = $(this).data('mobile');

            $('#employee_name').val(name);
            $('#employee_email').val(email);
            $('#employee_mobile').val(mobile);
            $('#employee_id').val(id);

            var myModal = new bootstrap.Modal(document.getElementById('myEditModal'));
            myModal.show();
        });

        // ================= UPDATE EMPLOYEE =================
        $('#updateForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#employee_id').val();
            let data = $(this).serialize();

            let url = "{{ route('employees.update', ['_id_']) }}";
            url = url.replace('_id_', id);

            $.ajax({
                url: url,
                type: "PUT",
                data: data,

                success: function(response) {
                    $('#respanel').text(response.message);
                    $('#myEditModal').modal('hide');
                    window.location.reload();
                },

            });
        });

        // ================= DELETE EMPLOYEE (SWEETALERT) =================
        $(document).on('click', '.delete-employee', function(event) {
            event.preventDefault();

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {

                if (result.isConfirmed) {

                    let url = "{{ route('employees.destroy', ['_id_']) }}";
                    url = url.replace('_id_', id);

                    $.ajax({
                        url: url,
                        type: "DELETE",
                        success: function(response) {

                            $('#respanel').text(response.message);

                            Swal.fire({
                                title: "Deleted!",
                                text: "Employee has been deleted.",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // remove row without reload
                            row.remove();
                        }
                    });
                }
            });
        });
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'mobile'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]

        });

    });
</script>




<script>
    $(document).ready(function() {

        $('#updateForm').submit(function(e) {
            e.preventDefault();

            let form = $(this);
            let data = form.serialize();

            let id = $('#employee_id').val(); // get id

            if (!id) {
                alert("ID missing!");
                return;
            }

            $.ajax({
                url: "/employees/" + id, // dynamic URL
                type: "POST", // keep POST (Laravel handles PUT)
                data: data,

                beforeSend: function() {
                    $('.error').text("");
                    $('#successMsg').text("");
                },

                success: function(response) {
                    $('#successMsg').text(response.message);
                    form[0].reset();
                },

                error: function(xhr) {

                    $('.error').text("");

                    let errors = xhr.responseJSON?.errors;

                    if (errors) {
                        if (errors.name) {
                            $('#edit_nameError').text(errors.name[0]);
                        }
                        if (errors.email) {
                            $('#edit_emailError').text(errors.email[0]);
                        }
                        if (errors.mobile) {
                            $('#edit_mobileError').text(errors.mobile[0]);
                        }
                    } else {
                        alert(xhr.responseJSON?.message || "Something went wrong!");
                    }
                }
            });

        });

    });
</script>
