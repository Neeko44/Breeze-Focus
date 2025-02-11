<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MuseumDashboardController extends Controller
{
    public function index()
    {
        return view('museum.dashboard'); // Pastikan file Blade ada di resources/views/admin/dashboard.blade.php
    }
}
