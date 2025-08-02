<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'user_id',
        'pickup_date',
        'return_date',
        'pickup_location',
        'return_location',
        'driver_age',
        'daily_rate',
        'total_price',
        'status',
        'special_requests',
        'insurance_type',
        'insurance_cost',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}