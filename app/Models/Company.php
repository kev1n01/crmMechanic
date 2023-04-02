<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    const DEPARTMENTS = [
        'HUANUCO' => 'HUANUCO'
    ];

    const PROVINCES = [
        'HUANUCO' => 'HUANUCO'
    ];

    const DISTRICTS = [
        'HUANUCO' => 'HUANUCO'
    ];

    protected $fillable = [
        'name',
        'phone',
        'ruc',
        'department',
        'province',
        'district',
        'ubigeous',
        'address',
        'logo',
    ];
}
