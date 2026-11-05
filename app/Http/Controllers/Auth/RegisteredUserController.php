<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Memproses registrasi pengguna baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data registrasi.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        // Membuat pengguna dan memberikan role default.
        $user = DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Semua pengguna yang mendaftar otomatis menjadi Mahasiswa.
            $user->assignRole('Mahasiswa');

            return $user;
        });

        // Mengirimkan event setelah registrasi berhasil.
        event(new Registered($user));

        // Login otomatis setelah registrasi.
        Auth::login($user);

        // Memperbarui session untuk keamanan.
        $request->session()->regenerate();

        // Mengarahkan pengguna ke dashboard.
        return redirect()->route('dashboard');
    }
}
