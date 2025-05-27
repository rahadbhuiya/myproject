<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameDettailsController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExchangeRateController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TopUpProductController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Auth routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Authenticated user dashboard
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->get('/dashboard', fn() => view('dashboard'))->name('dashboard');

// Game-related routes
Route::get('/category/{id}/games', [GameDettailsController::class, 'categoryGames'])->name('category.games');
Route::get('/order/product/{id}', [GameDettailsController::class, 'gameProducts'])->name('game.products');

// Order routes
Route::get('/order/create/{id}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

// Payment routes
Route::get('/payment/{product}', [PageController::class, 'payment'])->name('payment');
Route::get('/payment/{product}/success', [PageController::class, 'success'])->name('payment.success');

// Public admin-viewable routes (optional)
Route::get('/features', [FeatureController::class, 'index'])->name('features.index');
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/products', [TopUpProductController::class, 'index'])->name('products.index');
Route::get('/exchange-rates', [ExchangeRateController::class, 'index'])->name('exchange-rates.index');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('banners', BannerController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('games', GameController::class);
    Route::resource('products', TopUpProductController::class);
    Route::resource('exchange-rates', ExchangeRateController::class);
    Route::resource('orders', OrderController::class);

    // Additional admin-specific routes if needed
    Route::post('/exchange-rates/update', [ExchangeRateController::class, 'update'])->name('exchange_rates.update');
});