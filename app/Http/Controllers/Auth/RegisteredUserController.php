<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
     * Menangani permintaan registrasi.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDASI INPUT
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,peminjam'],
            // Kelas wajib diisi hanya jika role adalah peminjam
            'kelas' => ['required_if:role,peminjam', 'nullable', 'string', 'max:50'],
        ]);

        // 2. SIMPAN KE DATABASE
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'kelas' => $request->role === 'peminjam' ? $request->kelas : null,
        ]);

        event(new Registered($user));

        // 3. LOGIN OTOMATIS
        Auth::login($user);

        // 4. REDIRECT (CARA LARAVEL 11)
        // Mengarahkan ke route bernama 'dashboard'
        return redirect()->intended(route('dashboard', absolute: false));
    }
}