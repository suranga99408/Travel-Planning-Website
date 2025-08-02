<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelBooking extends Model
{
    use HasFactory;

    // Only needed if your table name doesn't follow Laravel's conventions
    // protected $table = 'your_custom_table_name';

    protected $fillable = [
        'user_id',
        'plan_id',
        'number_of_people',
        'special_requests',
        'total_amount',
        'payment_method',
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
}