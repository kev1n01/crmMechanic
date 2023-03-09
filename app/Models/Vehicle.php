<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    const YEARS = [
        '2030' => '2030',
        '2029' => '2029',
        '2028' => '2028',
        '2027' => '2027',
        '2026' => '2026',
        '2025' => '2025',
        '2024' => '2024',
        '2023' => '2023',
        '2022' => '2022',
        '2021' => '2021',
        '2020' => '2020',
        '2019' => '2019',
        '2018' => '2018',
        '2017' => '2017',
        '2016' => '2016',
        '2015' => '2015',
        '2014' => '2014',
        '2013' => '2013',
        '2012' => '2012',
        '2011' => '2011',
        '2010' => '2010',
        '2009' => '2009',
        '2008' => '2008',
        '2007' => '2007',
        '2006' => '2006',
        '2005' => '2005',
        '2004' => '2004',
        '2003' => '2003',
        '2002' => '2002',
        '2001' => '2001',
        '2000' => '2000',
    ];

    protected  $fillable = [
        'license_plate',
        'customer_id',
        'type_vehicle',
        'brand_vehicle',
        'model_vehicle',
        'color_vehicle',
        'model_year',
        'odo',
        'image',
        'description',
    ];


    public function type()
    {
        return $this->belongsTo(TypeVehicle::class, 'type_vehicle');
    }

    public function brand()
    {
        return $this->belongsTo(BrandVehicle::class, 'brand_vehicle');
    }

    public function model()
    {
        return $this->belongsTo(ModelVehicle::class, 'model_vehicle');
    }

    public function color()
    {
        return $this->belongsTo(ColorVehicle::class, 'color_vehicle');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function workOrder()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
