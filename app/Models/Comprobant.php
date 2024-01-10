<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobant extends Model
{
    use HasFactory;
    const TYPE_CPE = [
        '01' => 'Factura',
        '03' => 'Boleta',
    ];
    const TYPE_CURRENCY = [
        'PEN' => 'PEN',
        'USD' => 'USD',
    ];
    const TYPE_PAYMENTS = [
        'Contado' => 'Contado',
        'Credito' => 'Credito',
    ];
    const TYPE_AFECTATION = [
        10 => 'Gravado - Operacion Onerosa',
        20 => 'Exonerado - Operacion Onerosa',
    ];

    protected $table = 'comprobants';

    protected $fillable = [
        'tipoDoc',
        'serie',
        'correlativo',
        'fechaEmision',
        'moneda',
        'tipoPago',
        'cliente',
        'empresa',
        'items',
    ];
}
