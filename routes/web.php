<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LocationTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventFormatController;
use App\Http\Controllers\EventTableController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuctionTableController;
use App\Http\Controllers\UserTableController;
use App\Http\Controllers\AuctionRemoveFileController;
use App\Http\Controllers\AuctionBasedOnAttachmentController;
use App\Http\Controllers\AuctionItemBidController;
use App\Http\Controllers\AuctionItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransmartController;
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

// User Section
Route::get('/clear', function() {
    Auth::logout();
});

Route::middleware(['guest'])->group(function() {
    Route::get('/', [TransmartController::class, 'index'])->name('/');

    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/users/{user}/code', [UserLoginCodeController::class, 'index']);
    Route::get('/users/{user}/login', [UserLoginController::class, 'index']);
    Route::post('/users/{user}/login', [UserLoginController::class, 'store']);
});

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/auction-items', [AuctionItemController::class, 'index']);
    Route::get('/auction-items/{auction_item}', [AuctionItemController::class, 'show']);

    Route::post('/auction-items/{auction_item}/bids', [AuctionItemBidController::class, 'store']);
    Route::get('/auction-items/{auction_item}/bids', [AuctionItemBidController::class, 'index']);

    Route::post('/logout', [LoginController::class, 'destroy']);
});


// Admin section

/*
* User
*/
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
Route::get('/users/{userId}/show', [UserController::class, 'show'])->name('user.show');
Route::post('/users', [UserController::class, 'store'])->name('user.post');
Route::delete('/users/{userId}', [UserController::class, 'destroy'])->name('user.delete');
Route::get('/user-table', [UserTableController::class, 'index'])->name('user.table');


/*
* Profile
*/
Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profiles/{profileId}/show', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profiles', [ProfileController::class, 'store'])->name('profile.create');
Route::delete('/profiles/{profileId}', [ProfileController::class, 'destroy'])->name('user.delete');

/*
* Auction
*/
Route::get('/auctions', [AuctionController::class, 'index'])->name('auction.index');
Route::post('/auctions', [AuctionController::class, 'store'])->name('auction.store');
Route::get('/auctions/{auctionId}/edit', [AuctionController::class, 'edit'])->name('auction.edit');
Route::get('/auctions/{auctionId}/show', [AuctionController::class, 'show'])->name('auction.show');
Route::post('/auctions/{auctionId}', [AuctionController::class, 'update'])->name('auction.update');
Route::delete('/auctions/{auctionId}', [AuctionController::class, 'destroy'])->name('auction.delete');
Route::get('/auction-table', [AuctionTableController::class, 'index'])->name('auction.table');
Route::delete('/auction/{auctionAttachmentid}/remove-file', [AuctionRemoveFileController::class, 'destroy'])->name('auction-file.delete');
Route::get('/auctions/{auctionId}/based-on-attachment', [AuctionBasedOnAttachmentController::class, 'index']);



/*
* Event
*/
Route::get('/events', [EventController::class, 'index'])->name('event.index');
Route::get('/events/{eventId}/show', [EventController::class, 'show'])->name('event.show');
Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
Route::post('/events', [EventController::class, 'store'])->name('event.post');
Route::delete('/events/{eventId}', [EventController::class, 'destroy'])->name('event.delete');
Route::get('/event-table', [EventTableController::class, 'index'])->name('event.table');



/*
* Dashboard
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

/*
* Attendance
*/
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendance.index');

/**
 * Location type
 */
Route::post('/location-types', [LocationTypeController::class, 'store'])->name('location-type.create');

/**
 * Event Category
 */
Route::post('/event-categories', [EventCategoryController::class, 'store'])->name('event-category.create');
Route::get('/event-category-list', [EventCategoryListController::class, 'store'])->name('event-category.list');

/**
 * Event Format
 */
Route::post('/event-formats', [EventFormatController::class, 'store'])->name('event-format.create');
