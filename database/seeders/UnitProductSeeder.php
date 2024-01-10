<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UnitProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'code' => 'NIU',
                'name' => 'UNIDAD(BIEN)',
                'created_at' => now(),
            ],
            [
                'code' => 'ZZ',
                'name' => 'UNIDAD(SERVICIO)',
                'created_at' => now(),
            ],
            [
                'code' => 'BJ',
                'name' => 'BALDE',
                'created_at' => now(),
            ],
            [
                'code' => 'BLL',
                'name' => 'BARRILES',
                'created_at' => now(),
            ],
            [
                'code' => 'BO',
                'name' => 'BOLSA',
                'created_at' => now(),
            ],
            [
                'code' => 'BX',
                'name' => 'CAJA',
                'created_at' => now(),
            ],
            [
                'code' => 'CY',
                'name' => 'CILINDRO',
                'created_at' => now(),
            ],
            [
                'code' => 'KGM',
                'name' => 'KILOGRAMO',
                'created_at' => now(),
            ],
            [
                'code' => 'GRM',
                'name' => 'GRAMO',
                'created_at' => now(),
            ],
            [
                'code' => 'SET',
                'name' => 'JUEGO',
                'created_at' => now(),
            ],
            [
                'code' => 'KT',
                'name' => 'KIT',
                'created_at' => now(),
            ],
            [
                'code' => 'CA',
                'name' => 'LATAS',
                'created_at' => now(),
            ],
            [
                'code' => 'LBR',
                'name' => 'LIBRAS',
                'created_at' => now(),
            ],
            [
                'code' => 'LTR',
                'name' => 'LITRO',
                'created_at' => now(),
            ],
            [
                'code' => 'MTR',
                'name' => 'METRO',
                'created_at' => now(),
            ],
            [
                'code' => 'PR',
                'name' => 'PAR',
                'created_at' => now(),
            ],
            [
                'code' => 'TU',
                'name' => 'TUBOS',
                'created_at' => now(),
            ]
        ];
        DB::table('unit_products')->insert($units);
    }
}
