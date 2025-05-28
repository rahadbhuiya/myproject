<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\TopUpProduct;
use App\Models\ExchangeRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    // Show the form to create or edit the exchange rate
    public function edit()
    {
        $games = Game::all();  // For dropdown, if needed
        $exchangeRate = ExchangeRate::first();  // Only one rate expected
        $topUpProducts = TopUpProduct::with('game')->get();  // Optional display

        return view('admin.exchange_rate.edit', compact('exchangeRate', 'topUpProducts', 'games'));
    }

    // Update the exchange rate (create if doesn't exist)
    public function update(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0',
        ]);

        // update or create the single exchange rate record
        ExchangeRate::updateOrCreate([], ['rate' => $request->rate]);

        return redirect()->route('admin.exchange_rate.edit')->with('success', 'Exchange rate updated successfully.');
    }

    // List all exchange rates (usually only one)
    public function index()
    {
        $exchangeRates = ExchangeRate::all();

        return view('admin.exchange_rate.index', compact('exchangeRates'));
    }
}
