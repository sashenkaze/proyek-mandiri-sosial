<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ActivityController,
    AttendanceController,
    CertificateController,
    FeedbackController,
    RegistrationController,
    UserController
};

// Public Routes
Route::get('/', [ActivityController::class, 'home'])->name('home');

// Guest Only Routes (GET)
Route::get('/signup', function () {
    return view('signup');
})->name('signup')->middleware('isGuest');

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('isGuest');

// Authentication
Route::post('/signup', [UserController::class, 'store'])->name('signup.store');
Route::post('/login', [UserController::class, 'login'])->name('login.auth');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::prefix('/activities')->name('activities.')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/create', [ActivityController::class, 'create'])->name('create');
        Route::post('/store', [ActivityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ActivityController::class, 'update'])->name('update');
        Route::get('/export', [ActivityController::class, 'exportExcel'])->name('export');
        Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}', [ActivityController::class, 'patch'])->name('patch');
        Route::get('/trash', [ActivityController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [ActivityController::class, 'restore'])->name('restore');
        Route::delete('/delete-permanent/{id}', [ActivityController::class, 'deletePermanent'])->name('delete_permanent');
    });
});
