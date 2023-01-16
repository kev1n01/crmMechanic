<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    CONST STATUSES = [
        'activo' => 'Activo',
        'inactivo' => 'Inactivo',
    ];  

    protected $fillable = [
        'name',
        'phone',
        'address',
        'ruc',
        'status',
    ];
    
    public function getStatusColorAttribute(){
        return [
            'activo' => 'success',
            'inactivo' => 'danger',
        ][$this->status] ?? 'secondary';
    }

    public function purchase(){
        return $this->hasMany(Purchase::class);
    }

   
}
