<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
});
