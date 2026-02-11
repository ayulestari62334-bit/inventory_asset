<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalUser'  => User::count(),
            'totalAdmin' => User::where('role', 'admin')->count(),
            'totalStaff' => User::where('role', 'user')->count(),
        ]);
    }
}
