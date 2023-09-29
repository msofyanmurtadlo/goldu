<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\MyTeamController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PromotionController;

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
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::resource('/domains', DomainController::class)->except(['create', 'show']);
        Route::resource('/offers', OfferController::class)->except(['create', 'show']);
        Route::resource('/promotions', PromotionController::class)->except(['create', 'show']);
        Route::resource('/users', UserController::class)->except(['create', 'show']);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/myteams', [MyTeamController::class, 'index'])->name('myteams.index');
});
