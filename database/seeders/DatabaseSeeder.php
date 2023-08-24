<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {


        DB::table('roles')->insert([
            ['id' => 2, 'role' => 'üye'],
            ['id' => 1, 'role' => 'yönetici'],
        ]);

        User::factory()->create([
            'name' => 'Ahmet',
            'surname'=>'Atılgan(Customer)',
            'email' => 'challangeUser@example.com',
            'password' => Hash::make('password'),
            'role_id' =>2
        ]);

        User::factory()->create([
            'name' => 'Ahmet',
            'surname'=>'Atılgan(Admin)',
            'email' => 'challangeAdmin@example.com',
            'password' => Hash::make('password'),
            'role_id' =>1
        ]);

        User::factory(20)->create([
            'password' => Hash::make('password'),

        ]);

        Category::factory(10)->create();

        Product::factory(100)->create();
    }
}
