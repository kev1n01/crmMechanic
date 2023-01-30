<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Abrazaderas',
                'created_at' => now(),
            ],
            [
                'name' => 'Aceites',
                'created_at' => now(),
            ],
            [
                'name' => 'Liquidos',
                'created_at' => now(),
            ],
            [
                'name' => 'Grasas',
                'created_at' => now(),
            ],
            [
                'name' =>'Filtros',
                'created_at' => now(),
            ],
            [
                'name' =>'Zapatas',
                'created_at' => now(),
            ],
            [
                'name' =>'Bobinas',
                'created_at' => now(),
            ],
            [
                'name' =>'Faros',
                'created_at' => now(),
            ],
        ];

        DB::table('category_products')->insert($categories);
    }
}
