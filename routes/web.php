<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToyyibPayController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use Tarsoft\Toyyibpay\Toyyibpay;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

/* SHOPPING CART */

// Show cart
Route::get('/cart', [ListingController::class, 'cart']);

// Add to cart
Route::get('/addCart', [ListingController::class, 'addToCart'])->middleware('auth');

// Delete Listing
Route::delete('/cart/remove/{item}', [ListingController::class, 'destroyCart'])->middleware('auth');



//Payment

//checkout
Route::post('/checkout', [ToyyibPayController::class, 'checkout'])->middleware('auth');

//pending
Route::post('/pending', [ToyyibPayController::class, 'pending'])->middleware('auth');

//Toyyibpay Create Bill
Route::get('/toyyibpay', [ToyyibPayController::class, 'createBill'])->name('toyyibpay-create');

//Toyyibpay Payment Status
Route::get('/toyyibpay/status', [ToyyibPayController::class, 'paymentStatus'])->name('toyyibpay-status');

//Toyyibpay Callback
Route::post('/toyyibpay/callback', [ToyyibPayController::class, 'callback'])->name('toyyibpay-callback');






// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->name('create')->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Store price in DB
Route::post('/price', [UserController::class, 'storePrice'])->middleware('auth');



//Profile

// Show User Profile
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

//Show User Address Section
Route::get('/address', [UserController::class, 'showAddress'])->middleware('auth');

//Show My Purchase Section
Route::get('/toReceive', [UserController::class, 'showMyPurchase'])->middleware('auth');

//Update Profile
Route::post('/profile/update', [UserController::class, 'updateProfile'])->middleware('auth');



//Seller

//Register Seller
Route::get('/registerSeller', [UserController::class, 'registerSeller'])->middleware('auth');

//Seller Page
Route::get('/sellers/{seller}', [UserController::class, 'sellerPage'])->middleware('auth');

//Show Seller Register Page
Route::get('/sellerRegister', [UserController::class, 'showSellerRegister'])->middleware('auth');

//Store Seller Data
Route::post('/seller', [UserController::class, 'storeSeller'])->middleware('auth');


//Show Seller Product Dashboard
Route::get('/sellers/dashboard/{seller}/product', [UserController::class, 'showSellerProductDashboard'])->middleware('auth');

//Show Seller Order Dashboard
Route::get('/sellers/dashboard/{seller}/order', [UserController::class, 'showSellerOrderDashboard'])->middleware('auth');


//Show Seller Finance Dashboard
Route::get('/sellers/dashboard/{seller}/finance', [UserController::class, 'showSellerFinanceDashboard'])->middleware('auth');

//Show Seller Shipment Dashboard
Route::get('/sellers/dashboard/{seller}/shipment', [UserController::class, 'showSellerShipmentDashboard'])->middleware('auth');




//Update ship status
Route::post('/ship',[ListingController::class, 'updateStatus'])->middleware('auth');


//Show To Pay Section
Route::get('/toPay', [UserController::class, 'showToPay'])->name('toPay')->middleware('auth');

//Show To Receive Section
Route::get('/toReceive', [UserController::class, 'showToReceive'])->name('toReceive')->middleware('auth');

//Show To Ship Section
Route::get('/toShip', [UserController::class, 'showToShip'])->name('toShip')->middleware('auth');

//Show Completed Section
Route::get('/completed', [UserController::class, 'showCompleted'])->name('completed')->middleware('auth');

//Show Cancelled Section
Route::get('/cancelled', [UserController::class, 'showCancelled'])->name('cancelled')->middleware('auth');

//Update status to receive
Route::get('/receiveOrder', [UserController::class, 'receiveOrder'])->name('receiveOrder')->middleware('auth');

//Update Status to cancel
Route::get('/cancelOrder', [UserController::class, 'cancelOrder'])->name('cancelOrder')->middleware('auth');




//Admin

use App\Http\Middleware\AdminMiddleware;

// Show Admin Dashboard
Route::get('/admin', [UserController::class, 'showAdmin'])->name('admin')->middleware(AdminMiddleware::class);