<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    const STATUSES = [
        'finalizado' => 'Finalizado',
        'cancelado' => 'Cancelado',
        'en progreso' => 'En progreso',
    ];
    

    protected $fillable = [
        'code',
        'odo',
        'arrival_date',
        'arrival_hour',
        'departure_date',
        'departure_hour',
        'total',
        'observation',
        'customer',
        'status',
        'vehicle',
    ];

    public function vehiclePlate()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }

    public function customerUser()
    {
        return $this->belongsTo(Customer::class, 'customer');
    }

    public function workOrderDetail()
    {
        return $this->hasMany(WorkOrderDetail::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            'finalizado' => 'success',
            'cancelado' => 'danger',
            'en progreso' => 'info',
        ][$this->status] ?? 'default';
    }
}
