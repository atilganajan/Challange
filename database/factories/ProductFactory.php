<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories =Category::all();
        $categoryCount= count($categories);
        return [
            'filename' => fake()->imageUrl(),
            'category_id' => rand(1, $categoryCount),
            'name' =>$this->faker->unique()->word,
            'description' => $this->faker->paragraph,
        ];
    }
}
