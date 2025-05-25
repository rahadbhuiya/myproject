<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'name' => 'PUBG Mobile',
                'logo' => 'https://example.com/logos/pubg.png',
                'description' => 'PUBG Mobile is a popular battle royale game.',
                'category_name' => 'PUBG',
            ],
            [
                'name' => 'Free Fire',
                'logo' => 'https://example.com/logos/freefire.png',
                'description' => 'Free Fire is a survival shooter game available on mobile.',
                'category_name' => 'Free Fire',
            ],
            [
                'name' => 'Mobile Legends',
                'logo' => 'https://example.com/logos/mlbb.png',
                'description' => 'Mobile Legends is a 5v5 MOBA game.',
                'category_name' => 'Mobile Legends',
            ],
            [
                'name' => 'Valorant',
                'logo' => 'https://example.com/logos/valorant.png',
                'description' => 'Valorant is a tactical shooter by Riot Games.',
                'category_name' => 'Valorant',
            ],
        ];

        foreach ($games as $gameData) {
            $category = Category::where('name', $gameData['category_name'])->first();

            if ($category) {
                Game::create([
                    'name' => $gameData['name'],
                    'logo' => $gameData['logo'],
                    'description' => $gameData['description'],
                    'category_id' => $category->id,
                ]);
            } else {
                echo "⚠️  Category '{$gameData['category_name']}' not found. Skipping game '{$gameData['name']}'.\n";
            }
        }
    }
}
