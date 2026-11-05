<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', [
            'Admin',
            'Dosen',
            'Mahasiswa',
        ])->get();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:Admin,Dosen,Mahasiswa',
        ]);

        // Admin tidak boleh menghapus role miliknya
        // jika ia merupakan satu-satunya Admin.
        if (
            $user->hasRole('Admin') &&
            $validated['role'] !== 'Admin' &&
            User::role('Admin')->count() <= 1
        ) {
            return back()->withErrors([
                'role' => 'Minimal harus ada satu akun Admin.',
            ]);
        }

        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
