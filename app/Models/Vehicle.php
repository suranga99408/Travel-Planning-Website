<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'full_description',
        'images',
        'type',
        'category',
        'price_per_day',
        'capacity',
        'transmission',
        'fuel_type',
        'air_conditioned',
        'doors',
        'bags',
        'color',
        'year',
        'plate_number',
        'features',
        'available',
        'location',
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'air_conditioned' => 'boolean',
        'available' => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(VehicleBooking::class);
    }
}