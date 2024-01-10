<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'num_doc' => random_int(10000000000, 99999999999),
            'address' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(9),
            'status' => fake()->randomElement(['activo', 'inactivo']),
            'created_at' => now(),
        ];
    }
}
