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
                'name' => 'Abrazaderas',
                'type' => 'repuesto',
                'created_at' => now(),
            ],
            [
                'name' => 'Alineamiento',
                'type' => 'servicio',
                'created_at' => now(),
            ],
            [
                'name' => 'Calibracion',
                'type' => 'servicio',
                'created_at' => now(),
            ],
            [
                'name' => 'Empaque de motor',
                'type' => 'repuesto',
                'created_at' => now(),
            ],
        ];

        DB::table('concepts')->insert($concepts);
    }
}
