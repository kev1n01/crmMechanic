<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    const VOUCHERS = [
        'factura electrónica' => 'Factura Electrónica',
        'boleta de compra electrónica' => 'Boleta de compra Electrónica',
        'nota de crédito electrónica' => 'Nota de Crédito Electrónica',
        'nota de débito electrónica' => 'Nota de Débito Electrónica',
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
            'factura Electrónica' => 'success',
            'boleta de compra electrónica' => 'danger',
            'nota de crédito electrónica' => 'info',
            'nota de débito electrónica' => 'primary',
        ][$this->type_voucher] ?? 'secondary';
    }
}
