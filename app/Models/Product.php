<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const STATUSES = [
        'activo' => 'Activo',
        'inactivo' => 'Inactivo',
    ];

    protected $fillable = [
        'name',
        'code',
        'sku',
        'stock',
        'image',
        'sale_price',
        'purchase_price',
        'status',
        'unit_products_id',
        'category_products_id',
        'brand_products_id',
    ];

    public function unit()
    {
        return $this->belongsTo(UnitProduct::class, 'unit_products_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_products_id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandProduct::class, 'brand_products_id');
    }

    public function purchaseDetail()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function getImageProductAttribute()
    {
        return $this->image ?? 'productos/default.jpg';
    }

    public function getStatusColorAttribute()
    {
        return [
            'activo' => 'success',
            'inactivo' => 'danger',
        ][$this->status] ?? 'secondary';
    }
}
