<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->get('/', [DashboardController::class, 'landing'])->name('home');

Route::middleware(['guest'])->group(function () {

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    //Reset Password Form
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

    //Reset Password Submission
    Route::post('/forgot-password', [ResetPasswordController::class, 'resetPassword']);

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passordFormReset'])->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');

    Route::controller(SocialiteController::class)->group(function () {
        /**
         * Google Login
         */
        Route::get('auth/google', 'googleLogin')->name('auth.google');
        Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');

        /**
         * Facebook Login
         */
        Route::get('auth/facebook', 'facebookLogin')->name('auth.facebook');
        Route::get('auth/facebook-callback', 'facebookAuthentication')->name('auth.facebook-callback');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
    Route::get('/brands', [DashboardController::class, 'brands'])->name('brands');
    Route::get('/listings', [DashboardController::class, 'listings'])->name('listings');
    Route::get('/blog', [DashboardController::class, 'blog'])->name('blog');

    //Email Verification Notice
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

    //Email Verification Handler
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');

    //Resending the Verification Email
    Route::post('/email/verification-notification', [AuthController::class, 'verifyNotif'])->middleware(['throttle:6,1'])->name('verification.send');

    //Logout Route
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::get('car/search', [CarController::class, 'search'])->name('car.search');

    Route::resource('profile', ProfileController::class);

    Route::resource('car', CarController::class);
    Route::resource('blogs', BlogController::class);

    Route::get('/get-models/{maker}', [CarController::class, 'getModels']);
    Route::get('/get-cities/{region}', [CarController::class, 'getCities']);
});
