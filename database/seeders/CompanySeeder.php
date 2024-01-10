<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('companies')->insert([
            'name' => 'MECANICA AUTOMOTRIZ FLOPACH',
            'ruc' => '20610648771',
            'phone' => '982654321',
            'province' => 'Huanuco',
            'department' => 'Huanuco',
            'district' => 'Huanuco',
            'ubigeous' => '123124',
            'address' => 'OTR. PUEBLO COLPA BAJA ANX. CHUNOPAMPA HUANUCO HUANUCO HUANUCO',
            'logo' => ''
        ]);
    }
}
