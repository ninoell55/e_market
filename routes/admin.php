<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPDF'])->name('report.pdf');
});

Route::middleware(['auth', 'role:admin,courier'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{id}/approve', [CheckoutController::class, 'approvePayment'])->name('checkout.approve');
    Route::post('/checkout/{id}/ship', [CheckoutController::class, 'shipOrder'])->name('checkout.ship');
    Route::post('/checkout/{id}/complete', [CheckoutController::class, 'completeOrder'])->name('checkout.complete');
    Route::post('/checkout/{id}/cancel', [CheckoutController::class, 'cancelOrder'])->name('checkout.cancel');
});
