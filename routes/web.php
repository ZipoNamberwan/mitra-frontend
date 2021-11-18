<?php

use App\Http\Controllers\UserController;
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


Route::get('/', [App\Http\Controllers\MainController::class, 'index']);

Route::get('/register', [App\Http\Controllers\UserController::class, 'create']);

Route::get('/register/village/{id}', [App\Http\Controllers\UserController::class, 'getVillage']);

Route::resources([
    'create' => UserController::class,
]);