<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryProductSeeder::class);
        $this->call(BrandProductSeeder::class);
        $this->call(TypeVehicleSeeder::class);
        $this->call(BrandVehicleSeeder::class);
        $this->call(ModelVehicleSeeder::class);
        $this->call(ColorVehicleSeeder::class);
        \App\Models\Customer::factory(30)->create();
        \App\Models\Provider::factory(10)->create();
        // \App\Models\Product::factory(5)->create();
        \App\Models\Vehicle::factory(30)->create();
        $this->call(ConceptSeeder::class);
    }
}
