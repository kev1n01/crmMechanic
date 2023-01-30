<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
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
            'phone' => fake()->phoneNumber(9),
            'address' => fake()->streetName(),
            'ruc' => random_int(10000000000,99999999999),
            'status' => fake()->randomElement(['activo','inactivo']),
            'created_at' => now(),
            
        ];
    }
}
