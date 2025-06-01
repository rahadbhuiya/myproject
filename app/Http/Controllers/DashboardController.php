<?php

namespace App\Http\Controllers;

use App\Models\ProfileModel;
use App\Models\Transaction;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1) Orders made by this user (using ProfileModel instead of Order)
        $orders = ProfileModel::where('user_id', $user->id)
                              ->orderBy('created_at', 'desc')
                              ->get();

        // 2) Billing / Transactions (latest 5)
        $transactions = Transaction::where('user_id', $user->id)
                                   ->orderBy('created_at', 'desc')
                                   ->take(5)
                                   ->get();

        // 3) Notifications for this user
        $notifications = $user->notifications()
                              ->orderBy('created_at', 'desc')
                              ->get();

        // 4) Settings / Preferences (assuming these columns exist on the users table)
        $preferences = [
            'language'              => $user->language ?? 'English',
            'timezone'              => $user->timezone ?? 'Asia/Dhaka',
            'notifications_enabled' => $user->notifications_enabled ?? true,
        ];

        // 5) Support Tickets submitted by this user
        $supportTickets = SupportTicket::where('user_id', $user->id)
                                       ->orderBy('created_at', 'desc')
                                       ->get();

        // 6) Security / Session info (assuming these columns exist on the users table)
        $security = [
            'last_login_at'     => $user->last_login_at?->format('Y-m-d H:i') ?? null,
            'last_login_ip'     => $user->last_login_ip,
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

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return redirect()->route('dashboard')
                         ->with('status', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboard')
                         ->with('status_password', 'Password changed successfully.');
    }
}
