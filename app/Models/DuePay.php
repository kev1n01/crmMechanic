<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuePay extends Model
{
    use HasFactory;

    const REASONS = [
        'ot' => 'OT',
        'venta' => 'Venta',
        'otro' => 'Otro',
    ];

    protected $fillable = [
        'description',
        'person_owed',
        'amount_owed',
        'amount_paid',
        'reason',
    ];
}
