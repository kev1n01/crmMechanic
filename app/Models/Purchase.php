<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    CONST STATUSES = [
        'recibido' => 'Recibido',
        'cancelado' => 'Cancelado', 
        'pendiente' => 'Pendiente',
        'retrasado' => 'Retrasado',
    ];  

    protected $fillable = [
        'provider_id',
        'user_id',
        'total',
        'code_purchase',
        'date_purchase',
        'observation',
        'status',
    ];
    
    
    public function getStatusColorAttribute(){
        return [
            'recibido' => 'success',
            'cancelado' => 'danger',
            'pendiente' => 'danger',
            'retrasado' => 'warning',
        ][$this->status] ?? 'secondary';
    }

    public function getDateForTableAttribute(){
        return $this->date_purchase->format('d m Y');
    }

    public function getDateForEditingAttribute(){
        return optional($this->date_purchase)->format('d/m/Y');
    }

    public function buyer(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function provider(){
        return $this->belongsTo(Provider::class,'provider_id');
    }
    
    public function purchaseDetail(){
        return $this->hasMany(PurchaseDetail::class);
    }
}
