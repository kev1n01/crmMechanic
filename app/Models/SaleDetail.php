<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'discount',
        'quantity',
        'price',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class,'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
