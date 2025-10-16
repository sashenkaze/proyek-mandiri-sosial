<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

//redirect ke home
Route::get('/', [ActivityController::class, 'home'])->name('home');

//route untuk login/signup user
Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/signup', [UserController::class, 'store'])->name('signup.store');
Route::post('/login', [UserController::class, 'login'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

route::prefix('/admin')->name('admin.')->group(function () {
    route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
