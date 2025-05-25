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

Route::get('/',[HomeController::class,'index'])->name('home'); 




Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');



Route::get('/category/{id}/games', [GameDettailsController::class, 'categoryGames'])->name('category.games');
Route::get('/order/product/{id}', [GameDettailsController::class, 'gameProducts'])->name('game.products');
Route::get('/order/create', [GameDettailsController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/admin/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
Route::get('/admin/top-up-products', [TopUpProductController::class, 'index'])->name('admin.top_up_products.index');

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');


Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('order.store');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('banners', BannerController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('games', GameController::class);
    Route::resource('products', TopUpProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('exchange-rates', ExchangeRateController::class);
    
    // Route::resource('settings', SettingsController::class);


   
});











//customer dashboard
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});
