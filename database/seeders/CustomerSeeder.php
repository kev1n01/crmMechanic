<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name' => 'Julio',
                'dni' => '41234567',
                'ruc' => '12312312312',
                'address' => 'Jr Miraglores 123',
                'phone' => '987654321',
                'status' => 'activo',
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Cesar',
                'dni' => '51234567',
                'ruc' => '42312312312',
                'address' => 'Jr flores 1243',
                'phone' => '982654321',
                'status' => 'activo',
                'user_id' => 2,
                'created_at' => now(),
            ],
            [
                'name' => 'Juancho',
                'dni' => '41234565',
                'ruc' => '12312314312',
                'address' => 'Jr rosas 123',
                'phone' => '987654322',
                'status' => 'inactivo',
                'user_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Lucas',
                'dni' => '41236567',
                'ruc' => '12377312312',
                'address' => 'Jr juuu 123',
                'phone' => '98765432',
                'status' => 'activo',
                'user_id' => 4,
                'created_at' => now(),
            ],
        ];

        DB::table('customers')->insert($customers);

    }
}
