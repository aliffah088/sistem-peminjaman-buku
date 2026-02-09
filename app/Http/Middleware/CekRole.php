<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string[] ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login atau belum
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah role user ada di dalam daftar role yang diperbolehkan
        // Misal: Middleware dipanggil dengan 'admin', maka cek user->role == 'admin'
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // 3. Jika tidak punya akses, lempar ke dashboard dengan pesan error
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}