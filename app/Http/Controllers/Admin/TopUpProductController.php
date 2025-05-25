<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\TopUpProduct;
use Illuminate\Http\Request;

class TopUpProductController extends Controller
{
    
    // Show top-up products list
    public function index()
    {
        $topUpProducts = TopUpProduct::with('game')->get();
        return view('admin.topups.index', compact('topUpProducts'));
    }

    // Show create form for new top-up product
    public function create()
    {
        $games = Game::all();
        return view('admin.topups.create', compact('games'));
    }

    // Store new top-up product
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'delivery_time' => 'required|string',
            'instructions' => 'required|string',
        ]);

        $topUpProduct = new TopUpProduct();
        $topUpProduct->game_id = $request->game_id;
        $topUpProduct->product_name = $request->product_name;
        $topUpProduct->amount = $request->amount;
        $topUpProduct->price = $request->price;
        $topUpProduct->delivery_time = $request->delivery_time;
        $topUpProduct->instructions = $request->instructions;

        $topUpProduct->save();

        return redirect()->route('products.index')->with('success', 'Top-up Product added successfully');
    }

    // Show edit form for top-up product
    public function edit($id)
    {
        $topUpProduct = TopUpProduct::findOrFail($id);
        $games = Game::all();
        return view('products.edit', compact('topUpProduct', 'games'));
    }

    // Update top-up product
    public function update(Request $request, $id)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'delivery_time' => 'required|string',
            'instructions' => 'required|string',
        ]);

        $topUpProduct = TopUpProduct::findOrFail($id);
        $topUpProduct->game_id = $request->game_id;
        $topUpProduct->product_name = $request->product_name;
        $topUpProduct->amount = $request->amount;
        $topUpProduct->price = $request->price;
        $topUpProduct->delivery_time = $request->delivery_time;
        $topUpProduct->instructions = $request->instructions;

        $topUpProduct->save();

        return redirect()->route('admin.top_up_products.index')->with('success', 'Top-up Product updated successfully');
    }

    // Delete top-up product
    public function destroy($id)
    {
        $topUpProduct = TopUpProduct::findOrFail($id);
        $topUpProduct->delete();

        return redirect()->route('admin.top_up_products.index')->with('success', 'Top-up Product deleted successfully');
    }
}
