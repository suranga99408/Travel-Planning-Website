<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

 // app/Models/Hotel.php
protected $fillable = [
    'name',
    'description',
    'full_description',
    'image',
    'images',
    'type',
    'category',
    'price_per_night',
    'food_options',
    'has_nightlife',
    'nightlife_description',
    'location',
    'phone',
    'email',
    'rating',
    'has_wifi',
    'has_pool',
    'has_gym',
    'has_spa',
    'has_restaurant',
    'meal_plan'
];

protected $casts = [
    'images' => 'array',
    'has_wifi' => 'boolean',
    'has_pool' => 'boolean',
    'has_gym' => 'boolean',
    'has_spa' => 'boolean',
    'has_restaurant' => 'boolean',
    'has_nightlife' => 'boolean'
];

public function bookings()
{
    return $this->hasMany(HotelBooking::class);
}


}