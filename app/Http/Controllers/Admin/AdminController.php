<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalGames = Game::count();
        $totalCategories = Category::count();
        $exchangeRate = ExchangeRate::first();

        // Get the logged-in admin's latest 10 unread notifications
        $notifications = Auth::user()->unreadNotifications()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalGames',
            'totalCategories',
            'exchangeRate',
            'notifications'
        ));
    }
}
