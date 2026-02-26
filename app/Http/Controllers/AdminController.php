<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Booking;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard', [
            'movies' => Movie::count(),
            'bookings' => Booking::count(),
            'users' => User::count(),
            'revenue' => Booking::where('status', 'paid')->sum('total')
        ]);
    }
}
