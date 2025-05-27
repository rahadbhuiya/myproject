<?php

namespace App\Http\Controllers\Admin;

use App\Models\TopUpProduct;
use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function index()
    {
        // Get the first exchange rate record (or null if none exists)
        $exchangeRate = ExchangeRate::first();

        // Get all TopUpProducts with their related game
        $topUpProducts = TopUpProduct::with('game')->get();

        // Pass single $exchangeRate and $topUpProducts to the view
        return view('admin.exchange_rate.create', compact('exchangeRate', 'topUpProducts'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric|min:0',
        ]);

        $exchangeRate = ExchangeRate::first();

        if ($exchangeRate) {
            $exchangeRate->rate = $request->rate;
            $exchangeRate->save();
        } else {
            ExchangeRate::create(['rate' => $request->rate]);
        }

        return redirect()->route('admin.exchange_rate.index')->with('success', 'Exchange rate updated');
    }
}
