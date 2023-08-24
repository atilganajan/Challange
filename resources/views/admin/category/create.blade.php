@extends("_layout")
@section("title","Add Category")

@section("content")
    <div class="d-flex justify-content-center mt-5">
        <div class="w-50 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/category/add-category" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="category" class="form-label">Category*</label>
                            <input type="text" name="name" class="form-control" id="category">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
