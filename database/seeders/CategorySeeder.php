<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                // 'id' => 1,
                'name' => 'PUBG',
                'image' => 'https://example.com/images/pubg.png',
                'description' => 'PlayerUnknown’s Battlegrounds (PUBG) is a battle royale game.'
            ],
            [
                // 'id' => 2,
                'name' => 'Free Fire',
                'image' => 'https://example.com/images/freefire.png',
                'description' => 'Free Fire is a fast-paced battle royale game available on mobile.'
            ],
            [
                // 'id' => 3,
                'name' => 'Mobile Legends',
                'image' => 'https://example.com/images/mobilelegends.png',
                'description' => 'Mobile Legends: Bang Bang is a multiplayer online battle arena (MOBA) game.'
            ],
            [
                // 'id' => 4,
                'name' => 'Valorant',
                'image' => 'https://example.com/images/valorant.png',
                'description' => 'Valorant is a free-to-play first-person hero shooter developed by Riot Games.'
            ]
        ];

        Category::insert($categories);
    }
}
