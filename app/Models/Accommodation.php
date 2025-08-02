<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $table = 'accommodations'; // Explicit table name definition

    protected $fillable = [
        'name',
        'description',
        'images',
        'accommodation_type',
        'category',
        'price_per_night',
        'location',
        'has_wifi',
        'has_pool',
        'has_gym',
        'has_spa',
        'has_restaurant',
        'phone',
        'email',
        'check_in_time',
        'check_out_time',
        'rating'
    ];

    protected $casts = [
        'images' => 'array',
        'has_wifi' => 'boolean',
        'has_pool' => 'boolean',
        'has_gym' => 'boolean',
        'has_spa' => 'boolean',
        'has_restaurant' => 'boolean',
    ];

    // Accessor to get first image
    public function getFeaturedImageAttribute()
    {
        return $this->images ? $this->images[0] : null;
    }

    // Accessor for display price
    public function getDisplayPriceAttribute()
    {
        return '$' . number_format($this->price_per_night, 2);
    }

    // Scope for luxury accommodations
    public function scopeLuxury($query)
    {
        return $query->where('rating', '5-star');
    }

    // Scope for accommodations with pool
    public function scopeWithPool($query)
    {
        return $query->where('has_pool', true);
    }
}