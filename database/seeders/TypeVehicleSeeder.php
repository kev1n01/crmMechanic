<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Camioneta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Auto',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Furgoneta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('type_vehicles')->insert($types);
    }
}
