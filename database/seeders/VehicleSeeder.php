<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
                'license_plate' => '1AS-X5D',
                'customer_id' => 1,
                'type_vehicle' => 2,
                'brand_vehicle' => 3,
                'model_vehicle' => 2,
                'color_vehicle' => 1,
                'model_year' => '2018',
                'odo' => '31232',
                'created_at' => now(),
            ],
            [
                'license_plate' => 'G24-GFD',
                'customer_id' => 3,
                'type_vehicle' => 1,
                'brand_vehicle' => 4,
                'model_vehicle' => 4,
                'color_vehicle' => 3,
                'model_year' => '2015',
                'odo' => '12455',
                'created_at' => now(),
            ],
            [
                'license_plate' => '4ES-X5D',
                'customer_id' => 6,
                'type_vehicle' => 3,
                'brand_vehicle' => 3,
                'model_vehicle' => 3,
                'color_vehicle' => 4,
                'model_year' => '2020',
                'odo' => '51232',
                'created_at' => now(),
            ],
            [
                'license_plate' => '5T4-XL2',
                'customer_id' => 1,
                'type_vehicle' => 2,
                'brand_vehicle' => 2,
                'model_vehicle' => 2,
                'color_vehicle' => 5,
                'model_year' => '2013',
                'odo' => '21222',
                'created_at' => now(),
            ],
        ];

        DB::table('vehicles')->insert($vehicles);
    }
}
