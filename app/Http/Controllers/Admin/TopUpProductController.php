<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\TopUpProduct;
use Illuminate\Http\Request;

class TopUpProductController extends Controller
{
    public function index()
    {
        $topUpProducts = TopUpProduct::with('game')->get();
        return view('admin.topups.index', compact('topUpProducts'));
    }

    public function create()
    {
        $games = Game::all();
        return view('admin.topups.create', compact('games'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',   // Add amount validation
            'discount' => 'required|numeric|between:0,100',
            'price' => 'required|numeric|min:0',
            'delivery_time' => 'required|string',
            'instructions' => 'required|string',
        ]);

        $topUpProduct = new TopUpProduct();
        $topUpProduct->game_id = $request->game_id;
        $topUpProduct->product_name = $request->product_name;
        $topUpProduct->amount = $request->amount;             // Assign amount
        $topUpProduct->discount = $request->discount;
        $topUpProduct->price = $request->price;
        $topUpProduct->delivery_time = $request->delivery_time;
        $topUpProduct->instructions = $request->instructions;

        $topUpProduct->save();

        return redirect()->route('admin.topups.index')->with('success', 'Top-up Product added successfully');
    }

    public function edit($id)
    {
        $topUpProduct = TopUpProduct::findOrFail($id);
        $games = Game::all();
        return view('admin.topups.edit', compact('topUpProduct', 'games'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',  // Add amount validation
            'discount' => 'required|numeric|between:0,100',
            'price' => 'required|numeric|min:0',
            'delivery_time' => 'required|string',
            'instructions' => 'required|string',
        ]);

        $topUpProduct = TopUpProduct::findOrFail($id);
        $topUpProduct->game_id = $request->game_id;
        $topUpProduct->product_name = $request->product_name;
        $topUpProduct->amount = $request->amount;           // Assign amount
        $topUpProduct->discount = $request->discount;
        $topUpProduct->price = $request->price;
        $topUpProduct->delivery_time = $request->delivery_time;
        $topUpProduct->instructions = $request->instructions;

        $topUpProduct->save();

        return redirect()->route('admin.topups.index')->with('success', 'Top-up Product updated successfully');
    }

    public function destroy($id)
    {
        $topUpProduct = TopUpProduct::findOrFail($id);
        $topUpProduct->delete();

        return redirect()->route('admin.topups.index')->with('success', 'Top-up Product deleted successfully');
    }
}
