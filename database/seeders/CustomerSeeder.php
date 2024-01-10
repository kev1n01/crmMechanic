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
                'email' => 'Julio@gmail.com',
                'num_doc' => '12312312312',
                'address' => 'Jr Miraglores 123',
                'phone' => '987654321',
                'status' => 'activo',
                'created_at' => now(),
            ],
            [
                'name' => 'Cesar',
                'email' => 'Cesar@gmail.com',
                'num_doc' => '42312312312',
                'address' => 'Jr flores 1243',
                'phone' => '982654321',
                'status' => 'activo',
                'created_at' => now(),
            ],
            [
                'name' => 'Juancho',
                'email' => 'Juancho@gmail.com',
                'num_doc' => '12312314312',
                'address' => 'Jr rosas 123',
                'phone' => '987654322',
                'status' => 'inactivo',
                'created_at' => now(),
            ],
            [
                'name' => 'Lucas',
                'email' => 'Lucas@gmail.com',
                'num_doc' => '12377312312',
                'address' => 'Jr juuu 123',
                'phone' => '98765432',
                'status' => 'activo',
                'created_at' => now(),
            ],
        ];

        DB::table('customers')->insert($customers);

    }
}
