<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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
Route::get('/mysurvey-data', [App\Http\Controllers\MainController::class, 'data']);
Route::get('/assess', [App\Http\Controllers\MainController::class, 'showasses']);
Route::get('/statusdaftar', [App\Http\Controllers\MainController::class, 'showstatusses']);

Route::resources(['dash'=> MainController::class]);
