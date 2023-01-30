<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BrandVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name' => 'TOYOTA',
                'created_at' => now(),
            ],
            [
                'name' => 'NISSAN',
                'created_at' => now(),
            ],
            [
                'name' => 'HINO',
                'created_at' => now(),
            ],
            [
                'name' => 'FORD',
                'created_at' => now(),
            ],
            [
                'name' => 'CHEVROLET',
                'created_at' => now(),
            ],
            [
                'name' => 'HONDA',
                'created_at' => now(),
            ],
            [
                'name' => 'AUDI',
                'created_at' => now(),
            ],
            [
                'name' => 'DAEWOO',
                'created_at' => now(),
            ],
            [
                'name' => 'HYUNDAI',
                'created_at' => now(),
            ],
            [
                'name' => 'KIA',
                'created_at' => now(),
            ],
            [
                'name' => 'MAZDA',
                'created_at' => now(),
            ],
            [
                'name' => 'SUZUKI',
                'created_at' => now(),
            ],
        ];

        DB::table('brand_vehicles')->insert($brands);
    }
}
