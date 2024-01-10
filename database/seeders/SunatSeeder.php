<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SunatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sunats')->insert([
            'ruc' => '20422348921',
            'social_reason' => 'EMPRESA MALA',
            'user_sol_secondary' => 'gasda123',
            'password_sol_secondary' => 'afasad123',
            'address' => 'JR. HUALLAGA 232',
            'certificate' => '',
            'certificate_password' => '123',
        ]);
    }
}
