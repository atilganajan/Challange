@extends("_layout")
@section("title", "Categories")

@section("style")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>

        #categoryDataTable_wrapper {
            margin: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #categoryDataTable_filter {
            text-align: right;
        }

        .dataTables_paginate {
            text-align: center;
            margin-top: 20px;
        }

        .dataTables_info {
            margin-top: 20px;
        }

        .centered-link {
            display: flex;
            justify-content: center;
        }
    </style>
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="categoryDataTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <form id="delete-category-form" action="/admin/category/delete" method="post" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="category_id" id="category_id_input">
        </form>
    </div>
@endsection

@section("script")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



    <script>
        $(document).ready(function () {
            const categoryTable = $('#categoryDataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "ajax": {
                    "url": "/admin/categories",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {
                        "data": "id",
                        "render": function (data, type, full, meta) {
                            return `<div class="centered-link">
                                        <a class="me-3"  href="/admin/category/edit/${data}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="delete-category" style="color: red" data-id="${data}"> <i class="fas fa-trash"></i></a>
                                    </div>`;
                        }
                    },
                ],
                "order": [[0, "desc"]],
                "language": {
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    }
                }
            });


            $('#categoryDataTable').on('click', '.delete-category', function (e) {
                e.preventDefault();
                const categoryId = $(this).data('id');
                Swal.fire({
                    title: 'Confirm Deletion',
                    text: 'Are you sure you want to delete this category?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#category_id_input').val(categoryId);
                        $('#delete-category-form').submit();
                    }
                });
            });


        });
    </script>
@endsection
