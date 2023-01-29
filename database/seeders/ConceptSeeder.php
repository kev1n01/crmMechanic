<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $concepts = [
            [
                'name' => 'Alineamiento',
                'created_at' => now(),
            ],
            [
                'name' => 'Calibracion',
                'created_at' => now(),
            ],
            [
                'name' => 'Bajada de motor',
                'created_at' => now(),
            ],
            [
                'name' => 'Cambio de cremayera',
                'created_at' => now(),
            ],
            [
                'name' => 'Engrase de palier',
                'created_at' => now(),
            ],
            [
                'name' => 'Engrase de puntos de cardan',
                'created_at' => now(),
            ],
            [
                'name' => 'Cambio de aceite de caja',
                'created_at' => now(),
            ],
        ];

        DB::table('concepts')->insert($concepts);
    }
}
