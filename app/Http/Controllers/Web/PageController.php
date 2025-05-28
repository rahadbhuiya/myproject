<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;

class PageController extends Controller
{
    public function exchangeRate()
    {
        $exchangeRate = ExchangeRate::first();
        return view('frontend.exchange_rate', compact('exchangeRate'));
    }
}
