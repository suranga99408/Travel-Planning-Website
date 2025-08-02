<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@travelplanner.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        // Create or update regular user
        User::updateOrCreate(
            ['email' => 'user@travelplanner.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password'),
                'is_admin' => false,
            ]
        );

        // Seed other tables
        $this->call([
            PlansTableSeeder::class,
            PlanDestinationsTableSeeder::class,
            HotelsTableSeeder::class,
            VehiclesTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}