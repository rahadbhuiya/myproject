<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
        // Show current exchange rate
    public function index()
    {
        $exchangeRate = ExchangeRate::first();
        return view('admin.exchange_rate.index', compact('exchangeRate'));
    }

    // Update the exchange rate
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
