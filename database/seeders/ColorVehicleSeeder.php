<?php

namespace Database\Seeders;

use App\Models\ColorVehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ColorVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'Rojo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blanco',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Azul',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Verde',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Negro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('color_vehicles')->insert($colors);
    }
}
