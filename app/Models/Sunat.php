<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunat extends Model
{
    use HasFactory;
    protected $table = 'sunats';

    protected $fillable = [
        'ruc',
        'social_reason',
        'user_sol_secondary',
        'password_sol_secondary',
        'address',
        'certificate',
        'certificate_password',
    ];
}
