@extends("_layout")
@section("title","Register")

@section("content")
    <div class="d-flex justify-content-center mt-5">
        <div class="w-50">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Register</h3>
                </div>
                <div class="card-body">
                    <form action="/user/create" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" name="name" class="form-control" value="{{old("name")}}" id="name">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Surname*</label>
                            <input type="text" name="surname" value="{{old("surname")}}" class="form-control" id="surname">
                            @error('surname')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon*</label>
                            <input type="text" name="phone" value="{{old("phone")}}" class="form-control" id="phone">
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address*</label>
                            <input type="email" name="email" value="{{old("email")}}"  class="form-control" id="email">
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
                        <div class="mb-3">
                            <label for="passwordConfirm" class="form-label">Password Confirm*</label>
                            <input type="password" name="password_confirm" class="form-control" id="passwordConfirm">
                            @error('password_confirm')
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
