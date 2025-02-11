<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard'); // Pastikan file Blade ada di resources/views/user/dashboard.blade.php
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,museum,user',
        ]);

        $user->update([
            'role' => $request->role, // Akan memicu mutator otomatis
        ]);

        return back()->with('success', 'Role berhasil diperbarui.');
    }
}
