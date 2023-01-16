<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory;
    
    const TYPES = [
        'repuesto' => 'Repuesto',
        'servicio' => 'Servicio',
    ];
    protected $fillable = ['name', 'type'];
}
