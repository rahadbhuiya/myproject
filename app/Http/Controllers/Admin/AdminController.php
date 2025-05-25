<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalGames = Game::count();
        $totalCategories = Category::count();
        $exchangeRate = ExchangeRate::first();

        return view('admin.dashboard', compact('totalOrders', 'totalGames', 'totalCategories', 'exchangeRate'));
  
    }
}
