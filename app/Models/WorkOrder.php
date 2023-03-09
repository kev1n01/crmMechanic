<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    const STATUSES = [
        'finalizado' => 'Finalizado',
        'retrasado' => 'Retrasado',
        'en progreso' => 'En progreso',
    ];

    const IS_CONFIRMED = [
        0 => 'No confirmado',
        1 => 'Confirmado',
    ];

    const TYPES = [
        'preventivo' => 'Preventivo',
        'correctivo' => 'Correctivo',
        'predictivo' => 'Predictivo',
        'planchado y pintura' => 'Planchado y pintura',
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
        'is_confirmed',
        'type_atention',
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
            'retrasado' => 'danger',
            'en progreso' => 'info',
        ][$this->status] ?? 'default';
    }

    public function getTypeColorAttribute()
    {
        return [
            'preventivo' => 'info',
            'correctivo' => 'primary',
            'predictivo' => 'secondary',
            'planchado y pintura' => 'dark',
        ][$this->type_atention] ?? 'default';
    }

    public function getConfirmationColorAttribute()
    {
        return [
            0 => 'danger',
            1 => 'success',
        ][$this->is_confirmed] ?? 'default';
    }

    public function getConfirmationNameAttribute()
    {
        return [
            0 => 'No confirmado',
            1 => 'Confirmado',
        ][$this->is_confirmed] ?? 'N/A';
    }
}
