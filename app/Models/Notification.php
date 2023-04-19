<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    const STATUS = [
        'visto' => 'Visto',
        'no visto' => 'No visto',
    ];

    protected $fillable = [
        'title',
        'status',
        'expire_time',
    ];
}
