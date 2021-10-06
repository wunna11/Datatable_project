<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        {{-- Bootstrap CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

        {{-- Datatable CSS --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> --}}
        {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"> --}}
    </head>
    <body>
        <div class="container py-5">
            <div class="card">
                <div class="card-header"><b>Users</b></div>
                <div class="card-body">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>City</td>
                                <td>Created At</td>
                                <td>Updated At</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        {{-- Bootstrap JavaScript --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

        {{-- Datatasble JavaScript --}}
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        {{-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script> --}}

        <script>
            $(document).ready(function () {
                let token = document.head.querySelector('meta[name="csrf-token"]');
                if(token) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF_TOKEN' : token.content
                        }
                    });
                }
            });

            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": "/user/datatable/ssd",
                    columns: [
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'city_id',
                            name: 'city_id'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            });

            $(document).on('click', '.delete', function() {
                
                var id = $(this).data('id');
                // alert(id);
                $.ajax({
                    url: 'users/' + id,
                    type: 'DELETE',
                    success: function() {
                        table.ajax.reload();
                    }
                });
            });

        </script>
    </body>
</html>
