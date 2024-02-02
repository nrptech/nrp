<?php

use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->get('/products', [Product::class, 'showProducts'])->name("products");

Route::middleware(["auth"])->get('/cart', [CartController::class, 'showCart'])->name('cart');

Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart', [CartController::class, 'updateCart'])->name('cart.update');

Route::put('/productos/{product}', [ProductController::class, 'update'])->name('productos.update');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('productos', ProductController::class);
    Route::resource('users', UserController::class);
});
