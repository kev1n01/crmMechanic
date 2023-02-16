<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'item',
        'quantity',
        'discount',
        'price'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }
}
