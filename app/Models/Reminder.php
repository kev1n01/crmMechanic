<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    const STATUSES = [
        'no enviado' => 'No enviado',
        'enviado' => 'Enviado',
    ];

    protected $table = 'reminders';

    protected $fillable = [
        'vehicle_id',
        'description',
        'date',
        'status',
    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function getStatusColorAttribute()
    {
        return [
            'no enviado' => 'info',
            'enviado' => 'success',
        ][$this->status] ?? 'secondary';
    }
}
