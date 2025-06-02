<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Game;
use App\Models\Order;
use App\Notifications\OrderCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with summary statistics and notifications.
     */
    public function index()
    {
        $totalOrders = Order::count();
        $totalGames = Game::count();
        $totalCategories = Category::count();
        $exchangeRate = ExchangeRate::first();

        // Fetch latest 10 unread notifications for the logged-in admin user
        $notifications = auth()->check()
            ? auth()->user()->unreadNotifications()->latest()->take(10)->get()
            : collect();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalGames',
            'totalCategories',
            'exchangeRate',
            'notifications'
        ));
    }

    /**
     * Mark a given order as completed and notify the associated user.
     * 
     * @param int $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeOrder($orderId)
    {
        // Retrieve the order or fail with 404
        $order = Order::findOrFail($orderId);

        // Prevent re-completing an already completed order
        if ($order->status === 'completed') {
            return redirect()->back()->with('info', 'Order is already completed.');
        }

        // Update order status to completed
        $order->status = 'completed';
        $order->save();

        // Notify the user about order completion if user exists
        $user = $order->user; // Make sure 'user' relationship is defined on Order model
        if ($user) {
            $user->notify(new OrderCompleted($order));
        }

        return redirect()->back()->with('success', 'Order marked as completed and user notified.');
    }
}
