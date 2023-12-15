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
        User::factory()->create([
            'name' => 'Ahmet',
            'surname'=>'Atılgan(Customer)',
            'email' => 'challangeUser@example.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Ahmet',
            'surname'=>'Atılgan(Admin)',
            'email' => 'challangeAdmin@example.com',
            'password' =>'password',
            'role' =>"admin"
        ]);

        User::factory(20)->create();

        Category::factory(10)->create();

        Product::factory(100)->create();
    }
}
