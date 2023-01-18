<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    const VOUCHERS = [
        'factura electronica' => 'Factura Electronica',
        'boleta de compra electronica' => 'Boleta de compra Electronica',
        'nota de crédito electronica' => 'Nota de Crédito Electronica',
        'nota de débito electronica' => 'Nota de Débito Electronica',
    ];
    
    protected $fillable = [
        'description',
        'date',
        'time',
        'total',
        'type_voucher',
    ];

    public function getVoucherColorAttribute(){
        return [
            'factura electronica' => 'success',
            'boleta de compra electronica' => 'warning',
            'nota de crédito electronica' => 'info',
            'nota de débito electronica' => 'primary',
        ][$this->type_voucher] ?? 'secondary';
    }
}
