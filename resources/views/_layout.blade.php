<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title","Challange")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

    @yield("style")


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" style="margin-left: 8px" href="/">Challange</a>

    <div class="collapse navbar-collapse d-flex justify-content-end px-3" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
            </li>

            @if(auth()->user() && auth()->user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/products') ? 'active' : '' }}" href="/admin/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/product-create') ? 'active' : '' }}"
                       href="/admin/product-create">Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}" href="/admin/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/category-create') ? 'active' : '' }}"
                       href="/admin/category-create">Add Category</a>
                </li>
            @endif

            @if(!auth()->user())
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="/register">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div class="mt-5">
@yield("content")
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>

@if(session('success'))

    <script>

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            html: "{{session('success')}}",
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            html: {{session('error')}},
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@yield("script")



</body>
</html>
