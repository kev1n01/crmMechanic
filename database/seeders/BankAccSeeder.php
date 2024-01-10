<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BankAccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bc = [
            [
                'name' => 'Banco de Crédito del Perú',
                'cta_bank' => '191-0000001-0-00',
                'cta_interbank' => '002-191-0000001000-00',
            ],
            [
                'name' => 'BBVA Continental',
                'cta_bank' => '191-0000001-0-01',
                'cta_interbank' => '002-191-0000001001-00',
            ],
            [
                'name' => 'Banco de la Nación',
                'cta_bank' => '191-0000001-0-02',
                'cta_interbank' => '002-191-0000001002-00',
            ]
        ];
        DB::table('bank_accs')->insert($bc);
    }
}
