<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanDestination;
use Illuminate\Database\Seeder;

class PlanDestinationsTableSeeder extends Seeder
{
    public function run()
    {
        $kandyPlan = Plan::where('title', 'Kandy Cultural Tour')->first();
        $beachPlan = Plan::where('title', 'Beach Paradise - South Coast')->first();
        $safariPlan = Plan::where('title', 'Wildlife Safari Adventure')->first();
        $trainPlan = Plan::where('title', 'Hill Country Train Journey')->first();
        $ancientPlan = Plan::where('title', 'Ancient Cities Exploration')->first();

        $destinations = [
            // Kandy Cultural Tour destinations
            [
                'plan_id' => $kandyPlan->id,
                'name' => 'Temple of the Sacred Tooth Relic',
                'description' => 'Visit the most sacred Buddhist temple in Sri Lanka, which houses the relic of the tooth of Buddha. Experience the daily rituals and learn about the temple\'s rich history.',
                'image' => 'plan_destinations/tooth-temple.jpg',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $kandyPlan->id,
                'name' => 'Royal Botanical Gardens',
                'description' => 'Explore the beautiful Peradeniya Botanical Gardens with its impressive collection of orchids, palm avenues, and giant bamboo. A perfect place for nature lovers.',
                'image' => 'plan_destinations/botanical-gardens.jpg',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $kandyPlan->id,
                'name' => 'Kandy Lake',
                'description' => 'Enjoy a peaceful walk around the scenic Kandy Lake, built in 1807 by the last king of Kandy. The lake is surrounded by lush hills and offers beautiful views.',
                'image' => 'plan_destinations/kandy-lake.jpg',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $kandyPlan->id,
                'name' => 'Cultural Dance Show',
                'description' => 'Experience traditional Kandyan dance performances featuring vibrant costumes, drumming, and fire walking displays. A colorful introduction to Sri Lankan culture.',
                'image' => 'plan_destinations/dance-show.jpg',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Beach Paradise destinations
            [
                'plan_id' => $beachPlan->id,
                'name' => 'Unawatuna Beach',
                'description' => 'Relax on the golden sands of Unawatuna, one of Sri Lanka\'s most beautiful beaches. Enjoy swimming in the calm waters or try snorkeling to see colorful fish.',
                'image' => 'plan_destinations/unawatuna.jpg',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $beachPlan->id,
                'name' => 'Mirissa Whale Watching',
                'description' => 'Take a boat trip from Mirissa to spot blue whales, dolphins, and other marine life (seasonal). One of the best places in the world for whale watching.',
                'image' => 'plan_destinations/whale-watching.jpg',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $beachPlan->id,
                'name' => 'Galle Fort',
                'description' => 'Explore the historic Galle Fort, a UNESCO World Heritage site with Dutch colonial architecture, boutique shops, and ocean views from the ramparts.',
                'image' => 'plan_destinations/galle-fort.jpg',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Wildlife Safari destinations
            [
                'plan_id' => $safariPlan->id,
                'name' => 'Yala National Park',
                'description' => 'Morning and afternoon safaris in Yala, which has the highest density of leopards in the world. Also spot elephants, crocodiles, and many bird species.',
                'image' => 'plan_destinations/yala.jpg',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $safariPlan->id,
                'name' => 'Udawalawe National Park',
                'description' => 'Safari in Udawalawe, known for its large elephant population. Also home to water buffalo, spotted deer, sambar deer, and many birds of prey.',
                'image' => 'plan_destinations/udawalawe.jpg',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $safariPlan->id,
                'name' => 'Elephant Transit Home',
                'description' => 'Visit the Udawalawe Elephant Transit Home where orphaned elephant calves are cared for before being released back into the wild.',
                'image' => 'plan_destinations/elephant-home.jpg',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Hill Country Train Journey destinations
            [
                'plan_id' => $trainPlan->id,
                'name' => 'Kandy to Nuwara Eliya Train Ride',
                'description' => 'Scenic train journey through tea plantations, waterfalls, and mountains. One of the most beautiful train rides in the world.',
                'image' => 'plan_destinations/train-ride.jpg',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $trainPlan->id,
                'name' => 'Tea Factory Visit',
                'description' => 'Tour a working tea factory to learn how tea is processed from leaf to cup. Includes tea tasting with panoramic views of the plantations.',
                'image' => 'plan_destinations/tea-factory.jpg',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $trainPlan->id,
                'name' => 'Nuwara Eliya',
                'description' => 'Explore "Little England" with its colonial architecture, cool climate, and beautiful gardens. Visit Gregory Lake and enjoy the mountain scenery.',
                'image' => 'plan_destinations/nuwara-eliya.jpg',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Ancient Cities Exploration destinations
            [
                'plan_id' => $ancientPlan->id,
                'name' => 'Sigiriya Rock Fortress',
                'description' => 'Climb the ancient rock fortress of Sigiriya with its frescoes, mirror wall, and lion\'s paw entrance. A UNESCO World Heritage site with stunning views.',
                'image' => 'plan_destinations/sigiriya.jpg',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $ancientPlan->id,
                'name' => 'Polonnaruwa Ancient City',
                'description' => 'Explore the well-preserved ruins of Sri Lanka\'s medieval capital, including the Quadrangle, Gal Vihara statues, and the ancient parliament.',
                'image' => 'plan_destinations/polonnaruwa.jpg',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $ancientPlan->id,
                'name' => 'Anuradhapura Sacred City',
                'description' => 'Visit Sri Lanka\'s ancient capital with its massive dagobas, sacred bo tree (oldest historically documented tree in the world), and ruins of palaces and monasteries.',
                'image' => 'plan_destinations/anuradhapura.jpg',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan_id' => $ancientPlan->id,
                'name' => 'Dambulla Cave Temple',
                'description' => 'Explore this impressive rock temple with its five caves containing numerous Buddha statues and colorful murals dating back to the 1st century BCE.',
                'image' => 'plan_destinations/dambulla.jpg',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PlanDestination::insert($destinations);
    }
}