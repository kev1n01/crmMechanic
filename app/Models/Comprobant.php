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

    protected $fillable = [
        'tipoDoc',
        'serie',
        'correlativo',
        'fechaEmision',
        'moneda',
        'tipoPago',
        'tipoDocClient',
        'numDoc',
        'rznSocialClient',
        'direccionClient',
        'provinciaClient',
        'departamentoClient',
        'distritoClient',
        'ubigueoClient',
        'ruc',
        'razonSocialCompany',
        'nombreComercialCompany',
        'direccionCompany',
        'provinciaCompany',
        'departamentoCompany',
        'distritoCompany',
        'ubigueoCompany',
        'mtoOperGravadas',
        'mtoOperExoneradas',
        'mtoIGV',
        'totalImpuestos',
        'valorVenta',
        'subTotal',
        'mtoImpVenta',
        'value',
    ];
}
