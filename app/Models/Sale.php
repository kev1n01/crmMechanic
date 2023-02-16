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
        'cancelado' => 'Cancelado',
    ];

    protected $fillable = [
        'customer_id',
        'code_sale',
        'total',
        'cash',
        'change',
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
}
