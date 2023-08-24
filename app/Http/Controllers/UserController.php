<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function register(){
        return view("authentication.register");
    }

    public function store(CreateUserRequest $request){
        $hashedPassword = bcrypt($request->password);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $hashedPassword,
        ]);

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
