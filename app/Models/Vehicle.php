<?php

namespace App\Models;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'name',
        'plate_no',
        'is_active',
    ];

    protected $with = [
        'vehicleType:id,name',
    ];

    public function vehicleType ()
    {
        return $this->belongsTo(VehicleType::class);
    }

}
