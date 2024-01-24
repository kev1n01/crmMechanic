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

    const TYPE_DOCUMENTS = [
        '6' => 'RUC',
        '1' => 'DNI',
        '0' => 'SIN DOCUMENTO',
    ];

    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'num_doc',
        'address',
        'phone',
        'status',
    ];

    public function getStatusColorAttribute()
    {
        return [
            'activo' => 'success',
            'inactivo' => 'danger',
        ][$this->status] ?? 'secondary';
    }
}
