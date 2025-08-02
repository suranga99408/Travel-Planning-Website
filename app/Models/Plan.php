<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'image',
        'price_per_person',
        'start_date',
        'start_location'
    ];


    protected $casts = [
        'start_date' => 'date',
    ];

    public function destinations()
    {
        return $this->hasMany(PlanDestination::class);
    }
}