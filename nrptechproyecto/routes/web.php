<?php

use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LanguageController;

Route::middleware(['CheckLocale'])->group(function () {
    Route::get('/switch-language/{language}', [LanguageController::class, 'switchLanguage'])->name('switch.language');
});
// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// Middleware for setting the locale
Route::get('/home', [LanguageController::class, 'header']);

// Authenticated routes
Route::middleware(['auth', 'CheckLocale'])->group(function () {
    // Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Products
    Route::get('/products', [Product::class, 'showProducts'])->name("products");

    // Cart routes
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/substrac-amount/{product}', [CartController::class, 'substracAmount'])->name('cart.substracAmount');

    // Checkout
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');

    // Messages
    Route::post('/messages/store', [MessagesController::class, 'store'])->name('messages.store');

    // Order
    Route::get('/order', [CartController::class, 'showOrder'])->name('order.show');

    // Invoice
    Route::get('/invoice', [OrderController::class, 'showInvoice'])->name('invoice.show');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('/invoice/show', [InvoiceController::class, 'show'])->name('invoice.show');

    // Gracias por comprar
    Route::get('/gracias-por-comprar', [CartController::class, 'mostrarAgradecimiento'])->name('agradecimiento');

    // Product update and destroy
    Route::put('/productos/{product}', [ProductController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('productos.destroy');

    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        // Roles, Users, and Category
        Route::resource('roles', RoleController::class);
        Route::resource('productos', ProductController::class);
        Route::resource('users', UserController::class);
        Route::resource('category', ProductController::class);
    });
});

