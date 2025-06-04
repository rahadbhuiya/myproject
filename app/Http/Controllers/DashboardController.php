<?php

namespace App\Http\Controllers;

use App\Models\ProfileModel;       // Your orders model
use App\Models\Transaction;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Orders placed by user with related product info
        $orders = ProfileModel::where('user_id', $user->id)
                              ->with('product')
                              ->latest()
                              ->get();

        // User's billing transactions
        $transactions = Transaction::where('user_id', $user->id)
                                   ->latest()
                                   ->get();

        // Notifications (Laravel built-in)
        // $notifications = $user->notifications()
        //                       ->latest()
        //                       ->get();
                // Get all notifications of current user
        $notifications = Auth::user()->notifications()->latest()->get();

        // User preferences with fallback
        $preferences = [
            'language'              => $user->language              ?? 'English',
            'timezone'              => $user->timezone              ?? 'Asia/Dhaka',
            'notifications_enabled' => $user->notifications_enabled ?? true,
        ];

        // Support tickets submitted by user
        $supportTickets = SupportTicket::where('user_id', $user->id)
                                       ->latest()
                                       ->get();

        // Security and session-related info
        $security = [
            'last_login_at'     => optional($user->last_login_at)->format('Y-m-d H:i') ?? null,
            'last_login_ip'     => $user->last_login_ip     ?? 'Unknown',
            'active_sessions'   => $user->active_sessions_count ?? 1,
            'last_login_device' => $user->last_login_device ?? 'Unknown',
        ];

        return view('dashboard', compact(
            'user',
            'orders',
            'transactions',
            'notifications',
            'preferences',
            'supportTickets',
            'security'
        ));
    }

    /**
     * Mark a specific notification as read.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markNotificationRead($id)
    {
        $notification = Auth::user()
                            ->notifications()
                            ->findOrFail($id);

        $notification->markAsRead();

        return redirect()->back()->with('status', 'Notification marked as read.');
    }

    /**
     * Update the authenticated user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Profile updated successfully.');
    }

    /**
     * Change the authenticated user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status_password', 'Password changed successfully.');
    }

    /**
     * OPTIONAL: Paginated view for all orders of the authenticated user.
     *
     * Uncomment if needed.
     */
    /*
    public function orders()
    {
        $user = Auth::user();

        $orders = ProfileModel::where('user_id', $user->id)
                              ->latest()
                              ->paginate(15);

        return view('orders.index', compact('orders'));
    }
    */
}
