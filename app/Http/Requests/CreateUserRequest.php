<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {

        return [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
                'email' => ['required', Rule::unique('users'), 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'phone' => 'required|max:50',
            'password' => [
                'required',
                'min:8',
                'max:50',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'password_confirm' => 'required|same:password',
        ];
    }

    public function messages()
    {
        {
            return [
                'name.required' => 'Name is required.',
                'surname.required' =>'Surname is required.',
                'email.required' => 'Email is required.',
                'email.unique' => 'This email is already in use.',
                'email.regex' => 'Invalid email format.',
                'phone.required' => 'Phone number is required.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters long.',
                'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
                'password_confirm.required' => 'Password confirmation is required.',
                'password_confirm.same' => 'Password confirmation must match the password.',
            ];
        }
    }
}
