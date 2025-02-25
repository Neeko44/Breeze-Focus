<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Pastikan file Blade ada di resources/views/admin/dashboard.blade.php
    }

    public function showManageRoles()
    {
        $users = User::all();
        return view('admin.manage-roles', compact('users'));
    }

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

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('manage.roles')->with('success', 'User berhasil dihapus.');
    }
}

