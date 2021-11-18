<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirect']);
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class, 'callback']);
Route::get('/reg/{email}/{name}', [App\Http\Controllers\Auth\LoginController::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
