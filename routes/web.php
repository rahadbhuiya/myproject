<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExchangeRateController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TopUpProductController;
use App\Http\Controllers\GameDettailsController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Auth (login/logout) routes - publicly accessible
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Customer authenticated dashboard example
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

// Public game-related routes
Route::get('/category/{id}/games', [GameDettailsController::class, 'categoryGames'])->name('category.games');
Route::get('/order/product/{id}', [GameDettailsController::class, 'gameProducts'])->name('game.products');
Route::get('/admin/top-up-products', [TopUpProductController::class, 'index'])->name('admin.top_up_products.index');
Route::get('/order/create', [GameDettailsController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

// Admin routes group: prefix /admin + middleware auth + role:admin + route name prefix admin.
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Resource routes
    Route::resource('banners', BannerController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('games', GameController::class);
    Route::resource('products', TopUpProductController::class);
    Route::resource('exchange-rates', ExchangeRateController::class);
    Route::resource('orders', OrderController::class);

});



Route::get('/features', [FeatureController::class, 'index'])->name('features.index');
// Using resource controller
Route::resource('banners', BannerController::class);

// Or manual route definition
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/games', [GameController::class, 'index'])->name('games.index');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/admin/exchange-rates', [App\Http\Controllers\Admin\ExchangeRateController::class, 'index'])->name('admin.exchange-rates.index');
Route::resource('features', App\Http\Controllers\Admin\FeatureController::class);

Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('exchange-rates', \App\Http\Controllers\ExchangeRateController::class);
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('games', GameController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('games', \App\Http\Controllers\Admin\GameController::class);
});
Route::resource('games', \App\Http\Controllers\Admin\GameController::class);

Route::resource('products', ProductController::class);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange_rate.index');
    Route::post('/exchange-rates/update', [ExchangeRateController::class, 'update'])->name('exchange_rate.update');
});

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');





Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('topups', TopUpProductController::class);
});


Route::resource('products', TopUpProductController::class);


Route::get('/exchange-rate', [ExchangeRateController::class, 'index']);



Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange-rates.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange_rate.index');
    Route::post('/exchange-rates', [ExchangeRateController::class, 'update'])->name('exchange_rate.update');
});




Route::get('/order/{product}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');



Route::get('/order/{id}', [GameDettailsController::class, 'gameProducts'])->name('order.create');


// Show the payment form for a specific product
Route::get('/order/create/{id}', [GameDettailsController::class, 'create'])->name('order.create');

// Store the order
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/create/{id}', [OrderController::class, 'create'])->name('order.create');


Route::get('/order/create/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');



Route::get('/order/create/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');


Route::get('/order/create/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

use App\Http\Controllers\Web\PageController;

Route::get('/payment/{product}', [PageController::class, 'payment'])->name('payment');




Route::get('/order/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/payment/{product}', [PageController::class, 'payment'])->name('payment');
Route::get('/payment/{product}/success', [PageController::class, 'success'])->name('payment.success');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});

Route::get('admin/exchange-rates/create', [ExchangeRateController::class, 'create'])->name('admin.exchange_rate.create');
Route::post('admin/exchange-rates', [ExchangeRateController::class, 'store'])->name('admin.exchange_rate.store');
Route::get('admin/exchange-rates', [ExchangeRateController::class, 'index'])->name('admin.exchange_rate.index');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange_rate.index');
    Route::get('/exchange-rate/create', [ExchangeRateController::class, 'create'])->name('exchange_rate.create');
    Route::post('/exchange-rate/store', [ExchangeRateController::class, 'store'])->name('exchange_rate.store');
});

Route::get('/exchange-rate', [PageController::class, 'exchangeRate'])->name('frontend.exchange.rate');

Route::get('/exchange-rate', [PageController::class, 'exchangeRate'])->name('frontend.exchange.rate');
Route::post('/admin/orders/{id}/complete', [OrderController::class, 'markAsComplete'])->name('admin.orders.complete');
Route::post('/admin/orders/{id}/complete', [\App\Http\Controllers\Admin\OrderController::class, 'markAsComplete'])->name('admin.orders.complete');
Route::get('/exchange-rate', [PageController::class, 'exchangeRate'])->name('exchange.rate');

Route::get('/exchange-rate', [PageController::class, 'exchangeRate'])->name('frontend.exchange.rate');
Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');



// Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');
// Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');
// web.php
Route::get('/order-success', [OrderController::class, 'success'])->name('order.success');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


use App\Http\Controllers\Admin\SettingsController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});


Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');


Route::get('/profile', [YourController::class, 'profile'])->middleware('auth');


use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'profile'])->middleware('auth');


use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', compact('user'));
})->middleware(['auth'])->name('dashboard');



Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});



Route::middleware(['auth'])->group(function () {
    // Show dashboard
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');

    // Handle “Update Profile” form (name, email, phone)
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])
         ->name('profile.update');

    // Handle “Change Password” form
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
         ->name('profile.password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');

    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});


use App\Http\Controllers\DashboardController;


Route::middleware(['auth'])->group(function () {
    // Show dashboard (all sections)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile update
    Route::post('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // Password update
    Route::post('/profile/password', [DashboardController::class, 'updatePassword'])
         ->name('profile.password.update');

    // (Optional) Other AJAX or form routes if you need them, e.g. to mark notifications as read, etc.
});


Route::put('/user/password', [DashboardController::class, 'updatePassword'])->name('password.update')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/orders/{order}/complete', [AdminController::class, 'completeOrder'])->name('admin.orders.complete');
});
Route::post('/admin/orders/{id}/complete', [OrderController::class, 'markAsComplete'])->name('admin.orders.complete');
Route::post('/notifications/{id}/read', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return back();
})->name('notification.read');


Route::post('/notifications/{id}/read', [App\Http\Controllers\DashboardController::class, 'markNotificationRead'])
     ->name('notification.read')
     ->middleware('auth');
Route::post('/notifications/{id}/mark-read', [DashboardController::class, 'markNotificationRead'])
    ->name('notifications.markRead')
    ->middleware('auth');




use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// 1. Show the "verify your email" notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 2. Handle the verification link click
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Marks user as verified

    return redirect('/dashboard'); // Redirect after verification
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. Resend the verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/dashboard', function () {
    $user = Auth::user();
    $orders = $user->orders()->with('product')->get(); // assuming user hasMany orders

    return view('dashboard', compact('user', 'orders'));
})->middleware(['auth', 'verified'])->name('dashboard');



use App\Models\Order;

Route::get('/dashboard', function () {
    $user = Auth::user();
    $transactions = Order::where('user_id', $user->id)->get();

    return view('dashboard', compact('user', 'transactions'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
use App\Http\Controllers\Auth\EmailVerificationController;

Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');
Route::get('/email/verified', function () {
    return view('auth.verified');
})->middleware('auth');

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function() {
    Mail::raw('Test email content', function($message) {
        $message->to('kalachanstore33@gmail.com')
                ->subject('Test Email');
    });
    return 'Test email sent';
});




use App\Mail\NewOrderMail;

Route::get('/send-test-mail', function () {
    $order = Order::latest()->first(); // Or use a specific order ID

    if (!$order) {
        abort(404, 'No order found to test email.');
    }

    Mail::to('kalachanstore@gmail.com')->send(new NewOrderMail($order));

    return 'Test email sent!';
});


// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('categories', CategoryController::class);
// });

// Route::middleware(['web', 'auth', 'admin'])->group(function () {
//     Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
// });

