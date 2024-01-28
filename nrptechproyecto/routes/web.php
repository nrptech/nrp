<?php

use App\Http\Controllers\loginsController;
use App\Http\Controllers\signUpsController;
use Illuminate\Support\Facades\Route;

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
Route::get('logins', [ loginsController::class, 'logins' ]);
Route::get('signUps', [ signUpsController::class, 'signUps' ]);
Route::post('signUps', [ signUpsController::class, 'crear' ]) -> name('signUps.crear');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('auth.dashboard');
    })->middleware('aut');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
