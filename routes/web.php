<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// WELCOME PAGE
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// PROFILE ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// INCLUDE ADDITIONAL ROUTE FILES
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/member.php';
