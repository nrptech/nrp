<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\LanguageLocale;


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

Route::get('/(dashboard)', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/header', [CartController::class, 'showCart']);

    Route::get('/products/index', [ProductController::class, 'showProducts'])->name("products.index");
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/order', [CartController::class, 'showOrder'])->name('order.show');


    Route::post('/order/savePayMethod', [UserController::class, 'savePayMethod'])->name('savePay');
    Route::post('/order/saveAddress', [UserController::class, 'saveAddress'])->name('saveAddress');

    Route::middleware(["auth"])->get('/cart', [CartController::class, 'showCart'])->name('cart');

    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/substrac-amount/{product}', [CartController::class, 'substracAmount'])->name('cart.substracAmount');

    Route::prefix('wishlist')->group(function () {
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
        Route::post('/remove/{productId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    });


    // Route::post('/cart/remove/{product}', 'CartController@removeFromCart')->name('cart.remove');

    Route::get('/checkout', 'CheckoutController@index')->name('checkout');

    Route::get('/productos/{producto}/add-category', [ProductController::class, 'addCategory'])->name('productos.addCategory');
    Route::put('/productos/{product}/update-categories', [ProductController::class, 'updateCategories'])->name('productos.updateCategories');
    Route::put('/productos/{product}/add-category', [ProductController::class, 'deleteCategory'])->name('productos.deleteCategory');

    Route::get('/users/{user}/delete-pay-method', [UserController::class, 'removePayMethod'])->name('users.removePayMethod');
    Route::put('/users/{user}/delete-pay', [UserController::class, 'deletePayMethod'])->name('users.deletePayMethods');

    Route::get('/users/{user}/delete-addresses', [UserController::class, 'removeAddresses'])->name('users.removeAddresses');
    Route::put('/users/{user}/delete-address', [UserController::class, 'deleteAddress'])->name('users.deleteAddress');
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');
    Route::get('ordershipped/{order}', [CartController::class, 'ordershipped']);

    Route::prefix('order')->group(function () {
        Route::post('/savePayMethod', [UserController::class, 'savePayMethod'])->name('savePay'); // Sin cambios necesarios aquí
    });

    Route::post('/order/confirm', [CartController::class, 'confirmOrder'])->name('confirmOrder');
    Route::post('/order/reject', [CartController::class, 'rejectOrder'])->name('rejectOrder');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::get('/invoice', [OrderController::class, 'showInvoice'])->name('invoice.show');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('/invoice/show', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/gracias-por-comprar', [CartController::class, 'mostrarAgradecimiento'])->name('agradecimiento');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.index');
    Route::get('/profile/{user}/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/profile/{user}/update', [UserController::class, 'profileUpdate'])->name('profile.update');

    Route::delete('/profile/deletePayMethod', [UserController::class, 'deletePayMethod'])->name('profile.deletePayMethod');
    Route::delete('/profile/deleteAddress', [UserController::class, 'deleteAddress'])->name('profile.deleteAddress');

    Route::post('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('productos', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('coupons', CouponController::class);

    Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('productos.destroy');
    Route::put('/productos/{product}', [ProductController::class, 'update'])->name('productos.update');

    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
});


Route::middleware([LanguageLocale::class])->group(function () {
    Route::get('/switch-language/{language}', [LanguageController::class, 'switchLanguage'])->name('switch.language');
});

// Register Route for verification notice
Route::get('/verify', function () {
    return view('auth.verify');
})->name('verification.notice');

Route::get('/forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/reset-password/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/reset-password', 'ResetPasswordController@reset')->name('password.update');
