<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // proses login bawaan Laravel Breeze
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $role = strtolower(trim($user->role));

        // redirect berdasarkan role
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'petugas':
                return redirect()->route('petugas.dashboard');

            case 'peminjam':
                return redirect()->route('peminjam.dashboard');

            default:
                Auth::logout();
                abort(403, 'Role tidak dikenali');
        }
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}