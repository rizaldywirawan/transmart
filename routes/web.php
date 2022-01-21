<?php

use App\Http\Controllers\AuctionItemBidController;
use App\Http\Controllers\AuctionItemController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserLoginCodeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear', function() {
    Auth::logout();
});

Route::middleware(['guest'])->group(function() {
    Route::get('/users/{user}/login', [UserLoginController::class, 'index']);
    Route::get('/users/{user}/code', [UserLoginCodeController::class, 'index']);
    Route::post('/users/{user}/login', [UserLoginController::class, 'store']);
});

Route::get('/auction-items/{auction_item}', [AuctionItemController::class, 'index']);
Route::post('/auction-items/{auction_item}/bids', [AuctionItemBidController::class, 'store']);

Route::get('/home', [HomeController::class, 'index']);
