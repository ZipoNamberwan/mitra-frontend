<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
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
Route::get('/mitra-register/village/{id}', [App\Http\Controllers\Auth\LoginController::class, 'getVillage']);
Route::get('/mitra-register/{email}/{name}', [App\Http\Controllers\Auth\LoginController::class, 'showRegistrationForm'])->where(['email' => '(.*)', 'name' => '(.*)']);
Route::post('/mitra-register', [App\Http\Controllers\Auth\LoginController::class, 'register']);

Route::get('/mitra-edit', [App\Http\Controllers\ProfileController::class, 'edit']);
Route::post('/mitras/{$id}', [App\Http\Controllers\ProfileController::class, 'update']);
Route::get('/mitras/village/{id}', [App\Http\Controllers\ProfileController::class, 'getVillage']);

Route::get('/survey-register/{survey}', [App\Http\Controllers\SurveyRegistrationController::class, 'registerNotAuthenticated']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/survey-register/auth/{survey}', [App\Http\Controllers\SurveyRegistrationController::class, 'registerAuthenticated']);
    Route::get('/mitra-view', [App\Http\Controllers\ProfileController::class, 'show']);

    Route::resources([
        'mitras' => ProfileController::class
    ]);
});
