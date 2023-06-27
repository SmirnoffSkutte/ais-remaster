<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([])->group(function (){
    Route::get('/', [\App\Http\Controllers\Front\IndexController::class, 'index'])->name('home');
    Route::get('/users', [\App\Http\Controllers\Front\IndexController::class, 'users']);
    Route::get('/register', [\App\Http\Controllers\Front\IndexController::class, 'register']);
    Route::get('/login', [\App\Http\Controllers\Front\IndexController::class, 'login']);
    Route::get('/index', [\App\Http\Controllers\Front\IndexController::class, 'index']);
    Route::get('/shop', [\App\Http\Controllers\Front\IndexController::class, 'shop']);
});

/**
 *
 * @phpdocs
 *
 *
 */
