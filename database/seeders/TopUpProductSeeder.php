<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\TopUpProduct;
use Illuminate\Database\Seeder;

class TopUpProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all existing top-up products safely
        TopUpProduct::query()->delete();

        // No default products - empty array
        $products = [];

        foreach ($products as $productData) {
            $game = Game::where('name', $productData['game_name'])->first();

            if ($game) {
                TopUpProduct::create([
                    'game_id' => $game->id,
                    'product_name' => $productData['product_name'],
                    'amount' => $productData['amount'],
                    'price_bdt' => $productData['price_bdt'],
                    'price_usd' => $productData['price_usd'],
                    'delivery_time' => $productData['delivery_time'],
                    'instructions' => $productData['instructions'],
                ]);
            } else {
                echo "⚠️  Game '{$productData['game_name']}' not found. Skipping product '{$productData['product_name']}'.\n";
            }
        }
    }
}
