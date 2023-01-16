<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ModelVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            [
                'name' => 'Corvete',
                'created_at' => now(),
            ],
            [
                'name' => 'Corolla',
                'created_at' => now(),
            ],
            [
                'name' => 'Hilux',
                'created_at' => now(),
            ],
            [
                'name' => 'Descapotable',
                'created_at' => now(),
            ],
            [
                'name' => 'Across',
                'created_at' => now(),
            ],
        ];

        DB::table('model_vehicles')->insert($models);
    }
}
