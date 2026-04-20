<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Data dasar
        $data = [
            'totalAlat' => Alat::count(),
            'totalUser' => User::count(),
        ];

        if ($user->role === 'peminjam') {

            // Peminjam: hanya data miliknya
            $data['pinjamanAktif'] = Peminjaman::where('user_id', $user->id)
                ->where('status', 'dipinjam')
                ->count();

            $data['totalRiwayat'] = Peminjaman::where('user_id', $user->id)->count();

        } else {

            // Admin & Petugas
            $data['pinjamanAktif'] = Peminjaman::where('status', 'dipinjam')->count();

            $data['perluDikembalikan'] = Peminjaman::where('status', 'dipinjam')
                ->where('tanggal_kembali', '<', now())
                ->count();
        }

        return view('dashboard', $data);
    }
}