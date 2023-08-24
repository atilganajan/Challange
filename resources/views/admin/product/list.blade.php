@extends("_layout")
@section("title", "Products")

@section("style")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>

        #productDataTable_wrapper {
            margin: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #productDataTable_filter {
            text-align: right;
        }

        .dataTables_paginate {
            text-align: center;
            margin-top: 20px;
        }

        .dataTables_info {
            margin-top: 20px;
        }

        tbody td {
            vertical-align: middle; /* or top or bottom */
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
                <table id="productDataTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>

                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <form id="delete-product-form" action="/admin/product/delete" method="post" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="product_id" id="product_id_input">
        </form>
    </div>

    <table class="d-none" id="filter-row-wrapper">
        <thead>
        <tr class="filters border-top">
            <th data-element="input"><input type="text" class="form-control" placeholder=""></th>
            <th data-element="input"><input type="text" class="form-control" placeholder=""></th>
            <th data-element="input"><input type="text" class="form-control" placeholder=""></th>
            <th data-element="select">
                <select class="form-control">
                    <option></option>
                    @foreach($categories as $category)
                        <option value="{{$category->name}}" >{{$category->name}}</option>
                    @endforeach
                </select></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

@endsection

@section("script")
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function () {
            const productTable = $('#productDataTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,

                "ajax": {
                    "url": "/admin/products",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "description",
                     "render": function (data, type, full, meta) {
                            const maxLength = 50; // Set the maximum character length
                            if (data.length > maxLength) {
                                return data.substring(0, maxLength) + "..."; // Append "..." if text is longer
                            } else {
                                return data;
                            }
                        }
                    },
                    {"data": "category_name"},
                    {"data": "filename",
                    "render":function (data,type,full,meta){
                        return `<img width="100px" src="${data}" >`
                    }},
                    {
                        "data": "id",
                        "render": function (data, type, full, meta) {
                            return `<div class="centered-link">
                                        <a class="me-3"  href="/admin/product/edit/${data}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="delete-product" style="color: red" data-id="${data}"> <i class="fas fa-trash"></i></a>
                                    </div>`;
                        }
                    },
                ],
                "order": [[0, "desc"]],
                "dom": 'l<"search-input"f>rtip',
                "language": {
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    }
                },
                initComplete: function() {

                    var thisTable = this;
                    var rowFilter = $('#filter-row-wrapper thead tr').appendTo($(productTable.table().header()));

                    var api = this.api();

                    api.columns()
                        .eq(0)
                        .each(function (colIdx) {


                                if ($('.filters th').eq($(api.column(colIdx).header()).index()).data('element') == 'input') {

                                    $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                                        .off('keyup change')
                                        .on('change', function (e) {
                                            $(this).attr('title', $(this).val());
                                            var regexr = '({search})';

                                            var cursorPosition = this.selectionStart;
                                            api.column(colIdx)
                                                .search(
                                                    this.value != ''
                                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                        : '',
                                                    this.value != '',
                                                    this.value == ''
                                                )
                                                .draw();
                                        })
                                        .on('keyup', function (e) {
                                            e.stopPropagation();

                                            var cursorPosition = this.selectionStart;
                                            $(this).trigger('change');
                                            $(this)
                                                .focus()[0]
                                                .setSelectionRange(cursorPosition, cursorPosition);
                                        });
                                } else {

                                    $('select', $('.filters th').eq($(api.column(colIdx).header()).index()))
                                        .off('change')
                                        .on('change', function (e) {
                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                            api.column(colIdx).search('\\b' + val + '\\b', true, false).draw();
                                        })
                                }
                        })
                }
            });


            $('#productDataTable').on('click', '.delete-product', function (e) {
                e.preventDefault();
                const productId = $(this).data('id');
                Swal.fire({
                    title: 'Confirm Deletion',
                    text: 'Are you sure you want to delete this product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#product_id_input').val(productId);
                        $('#delete-product-form').submit();
                    }
                });
            });


        });
    </script>
@endsection
