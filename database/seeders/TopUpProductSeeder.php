<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\TopUpProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopUpProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $game = Game::where('name', 'PUBG Mobile')->first();

                $products = [
            [
                'game_id' => 1,
                'product_name' => '60 UC',
                'amount' => '60',
                'price_bdt' => 100,
                'price_usd' => 1.00,
                'delivery_time' => '5 Minutes',
                'instructions' => 'Enter your correct PUBG ID',
            ],
            [
                'game_id' => 1,
                'product_name' => '325 UC',
                'amount' => '325',
                'price_bdt' => 500,
                'price_usd' => 4.99,
                'delivery_time' => '5-10 Minutes',
                'instructions' => 'Enter correct Game ID and login method',
            ],
            [
                'game_id' => 2,
                'product_name' => '100 Diamonds',
                'amount' => '100',
                'price_bdt' => 95,
                'price_usd' => 0.89,
                'delivery_time' => 'Instant',
                'instructions' => 'Free Fire ID required',
            ],
        ];
    }
}
