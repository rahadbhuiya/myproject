<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feature;
use App\Models\TopUpProduct;
use Illuminate\Http\Request;

class GameDettailsController extends Controller
{
    // Show category with related games and their products
    public function categoryGames($id)
    {
        // Load category with its games relationship
        $category = Category::with('games')->findOrFail($id);

        // Get all products related to games in this category
        $products = TopUpProduct::with('game')
            ->whereIn('game_id', $category->games->pluck('id'))
            ->get();

        // Load all features (if needed)
        $features = Feature::all();

        // Pass category, features, and products to the view
        return view('web.page.dettails', compact('category', 'features', 'products'));
    }

    // Show product details and payment page
    public function gameProducts($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.order.payment', compact('product'));
    }

    // Show order creation form for a product
    public function create($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.page.order', compact('product'));
    }
}
