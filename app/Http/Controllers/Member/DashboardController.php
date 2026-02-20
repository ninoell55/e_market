<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('member.dashboard', [
            'title' => 'Dashboard - Member Panel',
        ]);
    }
}
