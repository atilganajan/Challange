@extends("_layout")
@section("title",$product->name)


@section("content")

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{ $product->filename }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="d-flex justify-content-end">
                            <a href="{{url()->previous()}}" class="btn btn-danger w-25">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
