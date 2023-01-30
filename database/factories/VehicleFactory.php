<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'license_plate' => strtoupper(fake()->bothify('?#?-##?')),
            'customer_id' => rand(1, 50),
            'type_vehicle' => rand(1, 3),
            'brand_vehicle' => rand(1, 1),
            'model_vehicle' => rand(1, 13),
            'color_vehicle' => rand(1, 6),
            'model_year' => fake()->year(),
            'odo' => fake()->randomNumber(5),
            'created_at' => now(),
        ];
    }
}
