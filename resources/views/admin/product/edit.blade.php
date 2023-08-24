@extends("_layout")
@section("title","Edit Product")

@section("content")
    <div class="d-flex justify-content-center mt-5">
        <div class="w-50 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/product/update-product" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="product_id" value="{{$product->id}}" >
                        <input type="hidden" name="old_image" id="oldImage" value="1" >
                        <div class="parent-old-image" >
                           <div class="d-flex flex-column align-items-center ">
                               <img width="200px" src="{{$product->filename}}" >
                               <button type="button" class="btn btn-sm btn-danger mt-2" id="updateImage" >Remove and change Image</button>
                           </div>
                        </div>
                        <div class="mb-3 parent-image-field" style="display: none">
                            <label for="image" class="form-label">Image* <small>(Max 3 MB, JPEG, PNG)</small></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" >
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" class="form-control" value="{{$product->name}}" id="name" name="name" >
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category*</label>
                            <select type="text" class="form-control" id="category" name="category">
                                <option value="" >Choose category</option>
                                @foreach($categories as $category)
                                    <option @if($product->category_id == $category->id ) selected @endif value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description*</label>
                            <textarea class="form-control" id="description" name="description" >{{$product->description}}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end" >
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("script")



    <script>
        $(document).ready(function () {
            $("#updateImage").on("click",function (){
                $(".parent-image-field").show();
                $(".parent-old-image").hide();
                $("#oldImage").val(0);
            })
        });
    </script>

    @error('image')
    <script>
        $(document).ready(function () {
            $("#updateImage").trigger("click");
        });
    </script>
    @enderror

@endsection
