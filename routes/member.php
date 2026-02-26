<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\ProductController;

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/member/collection/{slug}', [ProductController::class, 'showCategory'])
        ->name('member.collection.show');
    Route::get('/member/archive', [MemberDashboardController::class, 'archive'])->name('member.archive');
});
