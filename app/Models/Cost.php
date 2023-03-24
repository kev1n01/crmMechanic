<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    const VOUCHERS = [
        'factura electronica' => 'Factura Electronica',
        'boleta electronica' => 'Boleta Electronica',
    ];

    protected $fillable = [
        'description',
        'date',
        'total',
        'type_voucher',
    ];

    public function getVoucherColorAttribute()
    {
        return [
            'factura electronica' => 'success',
            'boleta electronica' => 'info',
        ][$this->type_voucher] ?? 'secondary';
    }
}
