<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShowController;


/*
|--------------------------------------------------------------------------
| USER SIDE ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/

// Welcome page as default
Route::get('/', [MovieController::class, 'welcome'])->name('welcome');

// Movie page
Route::get('/movie', [MovieController::class, 'index'])->name('movie');



// MOVIE DETAILS
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movie.details');

// SEAT SELECTION (LOGIN REQUIRED)
Route::get('/movie/{id}/seats', [MovieController::class, 'seats'])
    ->middleware('auth')
    ->name('seat.page');

// ABOUT PAGE
Route::view('/about', 'about')->name('about');


/*
|--------------------------------------------------------------------------
| USER BOOKINGS + PAYMENTS (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/book', [BookingController::class, 'store'])->name('book');

    Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.page');
    Route::post('/payment/{booking}', [PaymentController::class, 'process'])->name('payment.process');

    Route::get('/ticket/{booking}', [BookingController::class, 'ticket'])->name('ticket');
    Route::get('/ticket/{booking}/download', [BookingController::class, 'download'])->name('ticket.download');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');

    Route::put('/booking/cancel/{booking}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');

    Route::post('/booking/{booking}/rate', [BookingController::class, 'rate'])->name('booking.rate');
});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES (ADMIN ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')   // 👈 IMPORTANT
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // MOVIES MANAGEMENT (Use Admin Controller)
        Route::resource('/movies', \App\Http\Controllers\Admin\AdminMovieController::class);

        // SCREENS MANAGEMENT
        Route::resource('/screens', ScreenController::class);

        // SHOWS MANAGEMENT
        Route::resource('/shows', ShowController::class);

        // BOOKINGS MANAGEMENT
        Route::get('/bookings', [BookingController::class, 'adminBookings'])
            ->name('bookings');

        // REFUND MANAGEMENT
Route::post('/refund/{id}/approve', [BookingController::class, 'approveRefund'])
    ->name('refund.approve');

Route::post('/refund/{id}/reject', [BookingController::class, 'rejectRefund'])
    ->name('refund.reject');


        // USERS MANAGEMENT
        Route::get('/users', [UserController::class, 'index'])
            ->name('users');
    });


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
