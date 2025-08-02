<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Add this line

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Travel Backpack',
                'description' => 'Durable 40L backpack with multiple compartments for all your travel needs.',
                'price' => 89.99,
                'stock' => 50,
                'image' => 'products/backpack.jpg'
            ],
            [
                'name' => 'Compact Travel Pillow',
                'description' => 'Memory foam travel pillow with removable cover for long flights.',
                'price' => 24.99,
                'stock' => 100,
                'image' => 'products/pillow.jpg'
            ],
            // Add more products as needed
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}