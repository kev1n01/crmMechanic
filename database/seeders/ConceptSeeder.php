<?php

namespace Database\Seeders;

use App\Models\Concept;
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
                'code' => '1',
                'name' => 'Alineamiento',
                'created_at' => now(),
            ],
            [
                'code' => '2',
                'name' => 'Calibracion',
                'created_at' => now(),
            ],
            [
                'code' => '3',
                'name' => 'Bajada de motor',
                'created_at' => now(),
            ],
            [
                'code' => '4',
                'name' => 'Cambio de cremayera',
                'created_at' => now(),
            ],
            [
                'code' => '5',
                'name' => 'Engrase de palier',
                'created_at' => now(),
            ],
            [
                'code' => '6',
                'name' => 'Engrase de puntos de cardan',
                'created_at' => now(),
            ],
            [
                'code' => '7',
                'name' => 'Cambio de aceite de caja',
                'created_at' => now(),
            ],
        ];

        DB::table('concepts')->insert($concepts);
    }
}
