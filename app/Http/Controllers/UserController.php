<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController
{
    protected UserRepository $users;

    public function __construct(UserRepository $users){
        $this->users = $users;
    }

    public function register(){
        return view("authentication.register");
    }

    public function store(CreateUserRequest $request){

        $this->users->create($request->only('name', 'surname', 'email', 'phone', 'password'));

        return redirect('/login')->with('success', 'User registered successfully');
    }


    public function login(){
        return view("authentication.login");
    }

    public function userLogin(LoginUserRequest $request){

        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect('/')->with('success', 'User login successfully');
        } else {
            return back()->with(['message' => 'Invalid credentials']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
