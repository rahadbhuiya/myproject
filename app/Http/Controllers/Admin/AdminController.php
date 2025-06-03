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

        // Use admin guard for authentication (recommended for separate admin panel)
        $admin = Auth::guard('admin')->user();

        // Fetch latest 10 unread notifications for the logged-in admin
        $notifications = $admin
            ? $admin->unreadNotifications()->latest()->take(10)->get()
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
        $order = Order::findOrFail($orderId);

        // Prevent re-marking an already completed order
        if (strtolower($order->status) === 'completed') {
            return redirect()->back()->with('info', 'Order is already completed.');
        }

        // Update status to completed
        $order->status = 'completed';
        $order->save();

        // Notify user if they exist
        if ($order->user) {
            $order->user->notify(new OrderCompleted($order));
        }

        return redirect()->back()->with('success', 'Order marked as completed and user notified.');
    }
}
