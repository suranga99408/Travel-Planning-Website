<?php

// app/Models/PlanBooking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'number_of_people',
        'special_requests',
        'payment_method',
        'total_amount',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function index()
{
    $bookings = auth()->user()->planBookings()->with('plan')->latest()->get();
    return view('bookings.index', compact('bookings'));
}
}