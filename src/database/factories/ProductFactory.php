<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
         return [
        'name' => fake()->words(3, true),
        'description' => fake()->paragraph(),
        'category_id' => \App\Models\Category::factory(),
        'image' => null,
        'price' => fake()->randomFloat(2, 10, 1000),
        'stock' => fake()->numberBetween(0, 100),
        'status' => fake()->randomElement(['active', 'inactive']),
    ];
    }
}
