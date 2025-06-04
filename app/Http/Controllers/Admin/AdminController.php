<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Game;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCompleted;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * Apply authentication and admin check middleware.
     */
    public function __construct()
    {
        // Only authenticated users can access
        $this->middleware('auth');

        // Only admin users can access routes in this controller
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user || !$user->is_admin) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    /**
     * Show admin dashboard with stats and notifications.
     */
    public function index()
    {
        $totalOrders = Order::count();
        $totalGames = Game::count();
        $totalCategories = Category::count();
        $exchangeRate = ExchangeRate::first();

        $notifications = Auth::user()
            ->unreadNotifications()
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalGames',
            'totalCategories',
            'exchangeRate',
            'notifications'
        ));
    }

    /**
     * Mark order as completed and notify user.
     *
     * @param int $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if (strtolower($order->status) === 'completed') {
            return redirect()->back()->with('info', 'Order is already completed.');
        }

        $order->status = 'completed';
        $order->save();

        if ($order->user) {
            $order->user->notify(new OrderCompleted($order));
        }

        return redirect()->back()->with('success', 'Order marked as completed and user notified.');
    }

    /**
     * Notify all admins about a new order.
     *
     * @param Order $order
     * @return void
     */
    public function notifyAdminsAboutOrder(Order $order)
    {
        $admins = User::where('is_admin', true)->get();

        Notification::send($admins, new NewOrderNotification($order));
    }
}
