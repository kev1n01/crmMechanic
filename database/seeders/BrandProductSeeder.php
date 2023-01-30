<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BrandProductSeeder extends Seeder
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
                'name' => 'Vistony',
                'created_at' => now(),
            ],
            [
                'name' => 'Tokico',
                'created_at' => now(),
            ],
            [
                'name' => 'Bosch',
                'created_at' => now(),
            ],
            [
                'name' => 'Kamura',
                'created_at' => now(),
            ],
            [
                'name' => 'Toyota',
                'created_at' => now(),
            ],
            [
                'name' => 'Koyo',
                'created_at' => now(),
            ],
        ];

        DB::table('brand_products')->insert($brands);
    }
}
