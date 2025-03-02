<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class artwork extends Controller
{
    public function index()
    {
        return view('artwork');
    }
}
