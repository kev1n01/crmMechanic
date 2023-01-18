<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        \App\Models\User::factory(10)->create();

	    $this->call(CategoryProductSeeder::class);
	    $this->call(BrandProductSeeder::class);
	    $this->call(CustomerSeeder::class);
	    $this->call(ProviderSeeder::class);
	    $this->call(ProductSeeder::class);
	    $this->call(TypeVehicleSeeder::class);
        $this->call(BrandVehicleSeeder::class);
        $this->call(ModelVehicleSeeder::class);
        $this->call(ColorVehicleSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(ConceptSeeder::class);
        // $this->call(WorkOrderSeeder::class);
    }
}
