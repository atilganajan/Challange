@extends("_layout")
@section("title","Login")

@section("content")
    <div class="d-flex justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>
                <div class="card-body">
                    <form action="/user/login" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address*</label>
                            <input type="email" name="email" value="{{old("email")}}" class="form-control" id="email">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
