<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider = [
            [
                'name' =>  'Roberto',
                'phone' =>  '848123234',
                'address' =>  'aguilar 231',
                'ruc' =>  '53245432182',
                'status' =>  'activo',
                'created_at' => now(),
            ],
            [
                'name' =>  'Juan',
                'phone' =>  '848123232',
                'address' =>  'Lima 554',
                'ruc' =>  '53245432144',
                'status' =>  'inactivo',
                'created_at' => now(),
            ],
            [
                'name' =>  'Lucas',
                'phone' =>  '848123237',
                'address' =>  'huallay  231',
                'ruc' =>  '53245432156',
                'status' =>  'activo',
                'created_at' => now(),
            ],
            [
                'name' =>  'Manuel',
                'phone' =>  '848144234',
                'address' =>  'valdezx 2444',
                'ruc' =>  '53245434482',
                'status' =>  'activo',
                'created_at' => now(),
            ],
            [
                'name' =>  'Joel',
                'phone' =>  '848123992',
                'address' =>  'Puno 5544',
                'ruc' =>  '53245432155',
                'status' =>  'inactivo',
                'created_at' => now(),
            ],
            [
                'name' =>  'Maria',
                'phone' =>  '848123212',
                'address' =>  'Juales  6644',
                'ruc' =>  '53245772156',
                'status' =>  'inactivo',
                'created_at' => now(),
            ],
        ];

        DB::table('providers')->insert($provider);
    }
}
