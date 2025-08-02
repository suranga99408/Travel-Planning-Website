<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function planBookings()
    {
        return $this->hasMany(PlanBooking::class);
    }

    // app/Models/User.php
public function vehicleBookings()
{
    return $this->hasMany(VehicleBooking::class);

}

// app/Models/User.php
public function hotelBookings()
{
    return $this->hasMany(HotelBooking::class);
}

}