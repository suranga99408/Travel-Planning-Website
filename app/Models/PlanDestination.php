<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'name',
        'description',
        'image',
        'order'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}