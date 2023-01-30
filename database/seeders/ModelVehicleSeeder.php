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
            [
                'name' => 'Avensis',
                'created_at' => now(),
            ],
            [
                'name' => 'Yaris',
                'created_at' => now(),
            ],
            [
                'name' => 'Runner',
                'created_at' => now(),
            ],
            [
                'name' => 'Escudo',
                'created_at' => now(),
            ],
            [
                'name' => 'Aerio',
                'created_at' => now(),
            ],
            [
                'name' => 'Besta',
                'created_at' => now(),
            ],
            [
                'name' => 'Bongo',
                'created_at' => now(),
            ],
            [
                'name' => 'Carens',
                'created_at' => now(),
            ],
        ];

        DB::table('model_vehicles')->insert($models);
    }
}
