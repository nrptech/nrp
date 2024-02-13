<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
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

Route::middleware(['auth'])->get('/products/index', [ProductController::class, 'showProducts'])->name("products.index");

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('/order/savePayMethod', [UserController::class, 'savePayMethod'])->name('savePay');

Route::post('/order/saveAddress', [UserController::class, 'saveAddress'])->name('saveAddress');

Route::get('/header', [CartController::class, 'showCart']);

Route::middleware(["auth"])->get('/cart', [CartController::class, 'showCart'])->name('cart');

Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart', [CartController::class, 'updateCart'])->name('cart.update');

Route::post('/substrac-amount/{product}', [CartController::class, 'substracAmount'])->name('cart.substracAmount');

// Route::post('/cart/remove/{product}', 'CartController@removeFromCart')->name('cart.remove');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');

Route::get('/productos/{producto}/add-category', [ProductController::class, 'addCategory'])->name('productos.addCategory');
Route::put('/productos/{product}/update-categories', [ProductController::class, 'updateCategories'])->name('productos.updateCategories');
Route::put('/productos/{product}/add-category', [ProductController::class, 'deleteCategory'])->name('productos.deleteCategory');

Route::get('/users/{user}/delete-pay-method', [UserController::class, 'removePayMethod'])->name('users.removePayMethod');
Route::put('/users/{user}/delete-pay', [UserController::class, 'deletePayMethod'])->name('users.deletePayMethods');

Route::get('/users/{user}/delete-addresses', [UserController::class, 'removeAddresses'])->name('users.removeAddresses');
Route::put('/users/{user}/delete-address', [UserController::class, 'deleteAddress'])->name('users.deleteAddress');


Route::get('/order', [CartController::class, 'showOrder'])->name('order.show');

Route::post('/order/confirm', [CartController::class, 'confirmOrder'])->name('confirmOrder');
Route::post('/order/reject', [CartController::class, 'rejectOrder'])->name('rejectOrder');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/invoice', [OrderController::class, 'showInvoice'])->name('invoice.show');
Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
Route::get('/invoice/show', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('/gracias-por-comprar', [CartController::class, 'mostrarAgradecimiento'])->name('agradecimiento');
Route::put('/productos/{product}', [ProductController::class, 'update'])->name('productos.update');

Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');

Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('productos.destroy');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('productos', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin');
});
