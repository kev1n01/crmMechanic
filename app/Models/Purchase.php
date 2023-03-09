<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    const STATUSES = [
        'recibido' => 'Recibido',
        'pendiente' => 'Pendiente',
    ];

    const TYPE_CPE = [
        'factura' => 'Factura',
        'boleta' => 'Boleta',
    ];

    const METHOD_PAYMENTS = [
        'efectivo' => 'Efectivo',
        'yape' => 'Yape',
        'plin' => 'Plin',
        'transferencia' => 'Transferencia',
        'deposito' => 'Depósito',
    ];

    protected $fillable = [
        'provider_id',
        'total',
        'code_purchase',
        'date_purchase',
        'method_payment',
        'type_cpe',
        'nro_cpe',
        'observation',
        'status',
    ];


    public function getStatusColorAttribute()
    {
        return [
            'recibido' => 'success',
            'cancelado' => 'danger',
            'pendiente' => 'info',
        ][$this->status] ?? 'secondary';
    }

    public function getDateForTableAttribute()
    {
        return $this->date_purchase->format('d m Y');
    }

    public function getDateForEditingAttribute()
    {
        return optional($this->date_purchase)->format('d/m/Y');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function purchaseDetail()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
