<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Grasa rojo',
                'code' => '42344',
                'stock' => 10,
                'image' => '',
                'sale_price' => 15,
                'purchase_price' => 12,
                'status' => 'activo',
                'category_products_id' => 4,
                'brand_products_id' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Grasa amarillo',
                'code' => '41345',
                'stock' => 10,
                'image' => '',
                'sale_price' => 15,
                'purchase_price' => 12,
                'status' => 'inactivo',
                'category_products_id' => 4,
                'brand_products_id' => 2,
                'created_at' => now(),
            ],
            [
                'name' => 'Grasa azul',
                'code' => '42346',
                'stock' => 10,
                'image' => '',
                'sale_price' => 15,
                'purchase_price' => 12,
                'status' => 'activo',
                'category_products_id' => 4,
                'brand_products_id' => 2,
                'created_at' => now(),
            ],
            [
                'name' => 'Refrigerante rojo',
                'code' => '42200',
                'stock' => 10,
                'image' => '',
                'sale_price' => 30,
                'purchase_price' => 26,
                'status' => 'activo',
                'category_products_id' => 3,
                'brand_products_id' => 4,
                'created_at' => now(),
            ],
            [
                'name' => 'Liquido de freno',
                'code' => '42111',
                'stock' => 10,
                'image' => '',
                'sale_price' => 25,
                'purchase_price' => 22,
                'status' => 'inactivo',
                'category_products_id' => 3,
                'brand_products_id' => 3,
                'created_at' => now(),
            ],
            [
                'name' => 'Aceite de caja',
                'code' => '42333',
                'stock' => 10,
                'image' => '',
                'sale_price' => 50,
                'purchase_price' => 48,
                'status' => 'activo',
                'category_products_id' => 2,
                'brand_products_id' => 2,
                'created_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
