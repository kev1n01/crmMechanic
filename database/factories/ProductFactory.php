<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => fake()->unique()->sentence(5),
            'code' => fake()->randomNumber(5),
            'stock' => fake()->numberBetween(1, 100),
            'image' => '',
            'sale_price' => fake()->randomFloat(2, 0, 1000),
            'purchase_price' => fake()->randomFloat(2, 0, 1000),
            'status' => fake()->randomElement(['activo','inactivo']),
            'category_products_id' => rand(1, 8),
            'brand_products_id' => rand(1, 6),
            'created_at' => now(),
        ];
    }
}
