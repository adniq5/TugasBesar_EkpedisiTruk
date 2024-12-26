<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingTransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\ProgrammerController;
use App\Http\Controllers\FrontendController;

// Rute untuk halaman utama
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

// Rute resource untuk TruckController
Route::resource('trucks', TruckController::class);

// Rute resource untuk CustomerController
Route::resource('customers', CustomerController::class);

// Rute resource untuk OrderController
Route::resource('orders', OrderController::class);

// Rute resource untuk BookingTransactionController
Route::resource('booking-transactions', BookingTransactionController::class);

// Rute resource untuk ProgrammerController
Route::resource('programmers', ProgrammerController::class);
