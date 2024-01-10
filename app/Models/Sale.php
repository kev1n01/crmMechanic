<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    const STATUSES = [
        'pagado' => 'Pagado',
        'no pagado' => 'No pagado',
    ];

    const TYPES = [
        'vehicular' => 'Vehicular',
        'comercial' => 'Comercial',
    ];

    const TYPE_PAYMENTS = [
        'contado' => 'Contado',
        'credito' => 'Crédito',
    ];

    const METHOD_PAYMENTS = [
        'efectivo' => 'Efectivo',
        'yape' => 'Yape',
        'plin' => 'Plin',
        'transferencia' => 'Transferencia',
        'deposito' => 'Depósito',
    ];

    protected $fillable = [
        'customer_id',
        'code_sale',
        'total',
        'type_payment',
        'method_payment',
        'cash',
        'type_sale',
        'date_sale',
        'observation',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function saleDetail()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            'pagado' => 'success',
            'no pagado' => 'info',
            'cancelado' => 'danger',
        ][$this->status] ?? 'secondary';
    }
    
    public function getTypeColorAttribute()
    {
        return [
            'vehicular' => 'warning',
            'comercial' => 'primary',
        ][$this->type_sale] ?? 'secondary';
    }
}
