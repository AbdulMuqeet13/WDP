<?php

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserTransactionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\WithdrawalController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// About page route
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/faq', function () {
    return Inertia::render('FAQ');
})->name('faq');

Route::get('/privacy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('privacy');

Route::get('/terms', function () {
    return Inertia::render('TermsAndConditions');
})->name('terms');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('reports', [ReportController::class, 'index'])->middleware(['auth'])->name('reports');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class)->only(['index', 'show', 'update']);
    Route::resource('transactions', TransactionController::class)->only(['index', 'update']);
    Route::resource('user-transactions', UserTransactionsController::class)->only(['index']);
});


Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::resource('users', UserController::class)->only(['index']);
    Route::resource('/wallet', WalletController::class)->only(['index']);
    Route::resource('/deposits', DepositController::class)->only(['index', 'store']);
    Route::resource('/withdrawals', WithdrawalController::class)->only(['index', 'store']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
