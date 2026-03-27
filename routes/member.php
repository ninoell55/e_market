<?php

use App\Http\Controllers\Member\ArchiveController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/collection/{slug}', [ProductController::class, 'index'])->name('collection');

    Route::prefix('archive')->name('archive.')->group(function () {
        // --- SECTION: ADDRESSES ---
        Route::prefix('address')->group(function () {
            Route::get('/', [ArchiveController::class, 'addresses'])->name('addresses');
            // --- CRUD for addresses ---
            Route::get('/create', [ArchiveController::class, 'createAddress'])->name('create_address');
            Route::post('/', [ArchiveController::class, 'storeAddress'])->name('store_address');
            Route::get('/{address}/edit', [ArchiveController::class, 'editAddress'])->name('edit_address');
            Route::put('/{address}', [ArchiveController::class, 'updateAddress'])->name('update_address');
            Route::patch('/{address}/default', [ArchiveController::class, 'setDefaultAddress'])->name('set_default');
            Route::delete('/{address}', [ArchiveController::class, 'deleteAddress'])->name('delete_address');
        });

        // --- SECTION: ORDERS ---
        Route::prefix('order')->group(function () {
            Route::get('/', [ArchiveController::class, 'orders'])->name('orders');
            Route::get('/{order}', [ArchiveController::class, 'showOrder'])->name('show_order');
        });
    });
});
