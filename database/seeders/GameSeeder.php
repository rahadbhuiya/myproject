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
        // Safe delete without violating foreign key constraints
        Game::query()->delete();

        // Add your custom games here
        $games = [
            // Example:
            // [
            //     'name' => 'Call of Duty: Mobile',
            //     'logo' => 'https://example.com/logos/codm.png',
            //     'description' => 'COD Mobile is a fast-paced FPS game.',
            //     'category_name' => 'Call of Duty',
            // ],
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
