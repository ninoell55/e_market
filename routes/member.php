<?php

use App\Http\Controllers\Member\ArchiveController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/collection/{slug}', [ProductController::class, 'index'])->name('collection');

    // Resource Archive (Orders & Addresses Index)
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
    Route::prefix('archive/address')->name('archive.')->group(function () {
        // Create & Store
        Route::get('/create', [ArchiveController::class, 'createAddress'])->name('create_address');
        Route::post('/', [ArchiveController::class, 'storeAddress'])->name('store_address');

        // Edit & Update (Menggunakan ID {address})
        Route::get('/{address}/edit', [ArchiveController::class, 'editAddress'])->name('edit_address');
        Route::put('/{address}', [ArchiveController::class, 'updateAddress'])->name('update_address');

        // Set Default (Gunakan Patch karena hanya update satu field status)
        Route::patch('/{address}/default', [ArchiveController::class, 'setDefaultAddress'])->name('set_default');

        // Delete
        Route::delete('/{address}', [ArchiveController::class, 'deleteAddress'])->name('delete_address');
    });
});
