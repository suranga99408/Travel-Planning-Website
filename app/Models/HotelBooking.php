<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hotel_id',
        'user_id',
        'check_in',
        'check_out',
        'adults',
        'children',
        'room_type',
        'room_count',
        'selected_rooms',
        'room_rate',
        'taxes',
        'total_price',
        'guest_name',
        'guest_email',
        'guest_phone',
        'special_requests',
        'payment_status',
        'payment_method',
        'status'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'selected_rooms' => 'array'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNightsAttribute()
    {
        return $this->check_out->diffInDays($this->check_in);
    }
}