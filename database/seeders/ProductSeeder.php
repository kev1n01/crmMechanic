<?php

namespace Database\Seeders;

use App\Helpers\Csv;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    public $fieldColumnMap = [
        'name' => '',
        'code' => '',
        'stock' => '',
        'sale_price' => '',
        'purchase_price' => '',
        'status' => '',
    ];
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
                'stock' => 12,
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
                'stock' => 24,
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
                'stock' => 5,
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
                'stock' => 15,
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

        // $columns = Csv::from("C:\laragon\www\crmmechanic\storage\app\livewire-tmp/qkNrvSxAeUaMUMEA0M9a7ntmbhGGG1-metacHJvZHVjdG9zX2Nzdi5jc3Y=-.csv")->columns();
        // $guesses = [
        //     'name' => ['name', 'name'],
        //     'code' => ['code', 'code'],
        //     'stock' => ['stock', 'stock'],
        //     'sale_price' => ['sale_price', 'sale_price'],
        //     'purchase_price' => ['purchase_price', 'purchase_price'],
        //     'status' => ['status', 'status'],
        // ];

        // foreach ($columns as $column) {
        //     $match = collect($guesses)->search(fn ($options) =>
        //     in_array(strtolower($column), $options));

        //     if ($match) $this->fieldColumnMap[$match] = $column;
        // }

        // Csv::from("C:\laragon\www\crmmechanic\storage\app\livewire-tmp/qkNrvSxAeUaMUMEA0M9a7ntmbhGGG1-metacHJvZHVjdG9zX2Nzdi5jc3Y=-.csv")
        //     ->eachRow(function ($row) {
        //         Product::create(
        //             $this->extractFieldsFromRow($row)
        //         );
        //     });
    }
    // public function extractFieldsFromRow($row)
    // {
    //     $attributes = collect($this->fieldColumnMap)
    //         ->filter()
    //         ->mapWithKeys(function ($heading, $field) use ($row) {
    //             return [$field => $row[$heading]];
    //         })->toArray();

    //     return $attributes;
    // }
}
