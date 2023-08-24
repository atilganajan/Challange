@extends("_layout")

@section("style")

    <style>
        .sidebar {
            width: 250px;
            position: fixed;
            top: 55px;
            bottom: 0;
            left: 0;
            background-color: #f8f9fa; /
            overflow-y: auto;
        }
    </style>
@endsection

@section("content")
<div class="sidebar ">
    <div class="list-group">
        <a  class="list-group-item  bg-secondary text-white" >
            Categories
        </a>

        @foreach($categories as $category)
            <a href="/?category={{ $category->name }}" class="list-group-item list-group-item-action @if($activeCategory == $category->name) active @endif ">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="text-center container" style="padding-top: 30px; width: 75%; padding-left: 100px">
    <div class="row w-100 ">
        @foreach ($products as $product)
            <div class="col-lg-3 mt-3 "  >
            <div class="card"  >
                <div style="height: 200px; overflow: hidden;">
                    <img class="card-img-top" src="{{$product->filename}}" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h5 class="card-title">{{$product->category->name}}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 20, '...') }}</p>
                    @if(auth()->check() && auth()->user()->role_id == 2)
                        <div class="mb-2">
                            <button class="btn btn-success addToCartBtn" data-id="{{$product->id}}" >Add to Cart</button>
                        </div>
                    @endif
                    <a href="/product/detail/{{$product->id}}" class="btn btn-primary w-50" >Detail</a>
                </div>
            </div>
            </div>
        @endforeach

    </div>

    <div class="d-flex justify-content-end mt-3 me-3 ">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
<div id="userCart" class="position-fixed bottom-0 end-0 border border-2 border-solid" style="width: 250px; height: 600px; @if(!$userCartItems  ) display: none @endif">
    <ul id="userCartItems" class="list-group">
        @if($userCartItems)
            @foreach($userCartItems as $item)
                <li class="list-group-item d-flex align-items-center justify-content-between cart-item-{{$item->id}}">
                    <div class="d-flex align-items-center">
                        <img src="{{$item->product->filename}}" alt="Product Image" style="width: 50px;" class="mr-3">
                        <span class="text ms-3">{{$item->product->name}}</span>
                    </div>
                    <span class="icon text-danger deleteCartItem " data-id="{{$item->id}}"  style="cursor: pointer" ><i class="fa-solid fa-x"></i></span>
                </li>
            @endforeach
        @endif
    </ul>
</div>
@endsection

@section("script")
    <script>
        $(document).ready(function (){

            $(".addToCartBtn").on("click",function (){
                const productId = $(this).data("id");
                $.ajax({
                    url: '/add-to-cart',
                    type: 'POST',
                    data: {
                        product_id: productId,
                        _token:$('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function (data) {
                    if(data.status == "success"){
                        const product = data.productData;

                        $("#userCart").show();
                        $("#userCartItems").append(`
                        <li class="list-group-item d-flex align-items-center justify-content-between cart-item-${data.cartItem.id}">
                              <div class="d-flex align-items-center">
                                 <img src="${product.filename}" alt="Product Image" style="width: 50px;" class="mr-3">
                                 <span class="text ms-3">${product.name}</span>
                              </div>
                              <span class="icon text-danger deleteCartItem " data-id="${data.cartItem.id}"  style="cursor: pointer" ><i class="fa-solid fa-x"></i></span>
                        </li>
                        `)

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            html: "Successfully added to cart",
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            html: "Product not found",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }).fail(function () {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        html: "An unexpected error occurred",
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            })



            $(document).on("click", ".deleteCartItem", function () {
                const cartItemId = $(this).data("id");
                $.ajax({
                    url: '/remove-item-to-cart',
                    type: 'POST',
                    data: {
                        cart_item_id: cartItemId,
                        _token:$('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function (data) {
                    if(data.status == "success"){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            html: "Successfully removed to cart",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $(`.cart-item-${cartItemId}`).remove();

                        const ulElement = $("#userCartItems");
                        const liCount = ulElement.find("li").length;

                        if(liCount == 0){
                            $("#userCart").hide();
                        }

                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            html: "Product not found",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }).fail(function () {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        html: "An unexpected error occurred",
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
            })


        })




    </script>
@endsection
