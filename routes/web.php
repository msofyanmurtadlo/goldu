<?php

use App\Http\Controllers\BonusController;
use App\Http\Controllers\ConvertionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MyTeamController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\TrafficController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;

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
})->name('welcome');
Route::get('/redirect', [RedirectController::class, 'index'])->name('redirect');
Route::get('/postback', [PostbackController::class, 'index'])->name('postback');
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::resource('/domains', DomainController::class)->except(['create', 'show']);
        Route::resource('/networks', NetworkController::class)->except(['create', 'show']);
        Route::resource('/offers', OfferController::class)->except(['create', 'show']);
        Route::resource('/promotions', PromotionController::class)->except(['create', 'show']);
        Route::get('/transfers', [TransferController::class, 'index'])->name('transfers');
        Route::get('/transfers/{user}', [TransferController::class, 'now'])->name('transfers.now');
        Route::get('/transfer/balance/{user}', [TransferController::class, 'getBalance'])->name('get.balance');
        Route::post('/transfers', [TransferController::class, 'transfer'])->name('transfers.post');
        Route::resource('/users', UserController::class)->except(['create', 'show']);
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/smartlinks', [LinkController::class, 'smartlinks'])->name('smartlinks');
    Route::post('/smartlinks', [LinkController::class, 'gemerate'])->name('link.generate');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::get('/myteams', [MyTeamController::class, 'index'])->name('myteams.index');
    Route::get('/traffics', [TrafficController::class, 'index'])->name('traffics.index');
    Route::get('/convertions', [ConvertionController::class, 'index'])->name('convertions.index');
    Route::get('/bonuses', [BonusController::class, 'index'])->name('bonuses.index');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transaction/{id}', [TransactionController::class, 'getTransactionDetails']);
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'updatePassword'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'bank'])->name('profile.bank');
});
