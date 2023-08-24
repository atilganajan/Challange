@extends("_layout")
@section("title","Add Product")

@section("content")
    <div class="d-flex justify-content-center mt-5">
        <div class="w-50 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Product</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/product/add-product" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="old_image" value="0" >
                        <div class="mb-3">
                            <label for="image" class="form-label">Image* <small>(Max 3 MB, JPEG, PNG)</small></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" >
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" class="form-control" value="{{old("name")}}" id="name" name="name" >
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category*</label>
                            <select type="text" class="form-control" id="category" name="category">
                                <option value="" >Choose category</option>
                                @foreach($categories as $category)
                                    <option @if(old("category") == $category->id ) selected @endif value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description*</label>
                            <textarea class="form-control" id="description" name="description" >{{old("description")}}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end" >
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
