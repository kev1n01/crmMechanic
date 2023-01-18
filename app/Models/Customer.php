<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    const STATUSES = [
        'activo' => 'Activo',
        'inactivo' => 'Inactivo',
    ];

    use HasFactory;

    protected $fillable = [
        'name',
        'dni',
        'ruc',
        'address',
        'phone',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusColorAttribute()
    {
        return [
            'activo' => 'success',
            'inactivo' => 'danger',
        ][$this->status] ?? 'secondary';
    }
}
