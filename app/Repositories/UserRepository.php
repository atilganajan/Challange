<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;

class UserRepository
{

    public function create(array $data)
    {
        $fillableFields = ['name', 'surname', 'email', 'phone', 'password'];
        $fillableData = Arr::only($data, $fillableFields);

        return User::create($fillableData);
    }

}
