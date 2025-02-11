<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function updateRole(Request $request, User $user)
    {
        if (Auth::user()->role !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengubah role.');
        }

        $request->validate([
            'role' => 'required|in:admin,museum,user',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', 'Role berhasil diperbarui.');
    }
}
