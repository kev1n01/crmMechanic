<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    const VOUCHERS = [
        'Factura Electrónica' => 'Factura Electrónica',
        'Boleta de Venta Electrónica' => 'Boleta de Venta Electrónica',
        'Nota de Crédito Electrónica' => 'Nota de Crédito Electrónica',
        'Nota de Débito Electrónica' => 'Nota de Débito Electrónica',
        'Recibo de Servicios Públicos Electrónico' => 'Recibo de Servicios Públicos Electrónico',
        'Recibo por Honorarios Electrónico' => 'Recibo por Honorarios Electrónico',
        'Comprobante de Retención Electrónico' => 'Comprobante de Retención Electrónico',
        'Comprobante de Percepción Electrónico' => 'Comprobante de Percepción Electrónico',
        'Liquidación de Compra Electrónica' => 'Liquidación de Compra Electrónica',
    ];
    
    protected $fillable = [
        'description',
        'date',
        'time',
        'total',
        'type_voucher',
    ];
}
