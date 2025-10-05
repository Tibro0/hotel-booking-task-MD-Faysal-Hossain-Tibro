<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::controller(BookingController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/check-availability', 'checkAvailability')->name('bookings.check-availability');
    Route::get('/bookings/create', 'create')->name('bookings.create');
    Route::post('/bookings', 'store')->name('bookings.store');
    Route::get('/bookings/thank-you/{booking}', 'thankYou')->name('bookings.thank-you');
});
