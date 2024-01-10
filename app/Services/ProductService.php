<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function searchProducts($product)
    {
        return Product::query()->where('stock', '>', 0)->when(
            $product,
            fn ($q, $product) =>
            $q->where('name', 'like', '%' . $product . '%')
                ->orwhere('code', 'like', '%' . $product . '%')
        )->get();
    }

    public function productByCode($code)
    {
        return  Product::where('code', 'like', '%' . $code . '%')->first();
    }
}
