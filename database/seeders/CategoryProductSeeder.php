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
        ];

        DB::table('category_products')->insert($categories);
    }
}
