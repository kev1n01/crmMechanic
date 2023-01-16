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
                'name' => 'VISTONY',
                'created_at' => now(),
            ],
            [
                'name' => 'MOPAL',
                'created_at' => now(),
            ],
            [
                'name' => 'MOTORSA4',
                'created_at' => now(),
            ],
            [
                'name' => 'XTREMEMOTOR',
                'created_at' => now(),
            ],
        ];

        DB::table('brand_products')->insert($brands);
    }
}
