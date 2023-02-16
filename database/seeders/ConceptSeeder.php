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
                'code' => '001',
                'name' => 'Alineamiento',
                'created_at' => now(),
            ],
            [
                'code' => '002',
                'name' => 'Calibracion',
                'created_at' => now(),
            ],
            [
                'code' => '003',
                'name' => 'Bajada de motor',
                'created_at' => now(),
            ],
            [
                'code' => '004',
                'name' => 'Cambio de cremayera',
                'created_at' => now(),
            ],
            [
                'code' => '005',
                'name' => 'Engrase de palier',
                'created_at' => now(),
            ],
            [
                'code' => '006',
                'name' => 'Engrase de puntos de cardan',
                'created_at' => now(),
            ],
            [
                'code' => '007',
                'name' => 'Cambio de aceite de caja',
                'created_at' => now(),
            ],
        ];

        DB::table('concepts')->insert($concepts);
    }
}
