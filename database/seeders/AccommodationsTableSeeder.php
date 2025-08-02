<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use Illuminate\Database\Seeder;

class AccommodationsTableSeeder extends Seeder
{
    public function run()
    {
        $accommodations = [
            [
                'name' => 'The Grand Kandyan Accommodation',
                'description' => 'A luxurious 5-star accommodation with panoramic views...',
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1566073771259-6a8506099945',
                    'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa',
                    'https://images.unsplash.com/photo-1564501049412-61c2a3083791'
                ]),
                'accommodation_type' => 'Half Board',
                'category' => 'Luxury',
                'price_per_night' => 250.00,
                'location' => '123 Temple Road, Kandy',
                'has_wifi' => true,
                'has_pool' => true,
                'has_gym' => true,
                'has_spa' => true,
                'has_restaurant' => true,
                'phone' => '+94 812345678',
                'email' => 'reservations@grandkandyan.com',
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
                'rating' => '5-star',
            ],
            // Add more accommodations as needed
        ];

        foreach ($accommodations as $accommodation) {
            Accommodation::create($accommodation);
        }
    }
}