<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feature;
use App\Models\Game;
use App\Models\Order;
use App\Models\TopUpProduct;
use Illuminate\Http\Request;

class GameDettailsController extends Controller
{


    public function categoryGames($id)
    {
        $product = TopUpProduct::all();
        $features = Feature::all();
        $category = Category::with('games.products')->findOrFail($id);
        return view('web.page.dettails', compact('category','features','product'));
    }


    public function gameProducts($id)
    {
        $product = TopUpProduct::with('game')->findOrFail($id);
        return view('web.page.order',compact('product'));
    }

    public function create()
    {
        return view('web.page.order');
    }

    

    
}
