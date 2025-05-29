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

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
