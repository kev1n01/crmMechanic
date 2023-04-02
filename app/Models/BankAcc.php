<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAcc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cta_bank',
        'cta_interbank',
    ];
}
