<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
