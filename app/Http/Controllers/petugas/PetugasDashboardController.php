<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PetugasDashboardController extends Controller
{
     public function index()
    {
        $user = auth()->user();
        $totalPeminjaman = Peminjaman::count();

        $sedangDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        $sudahKembali = Peminjaman::where('status', 'dikembalikan')->count();


$terlambat = Peminjaman::whereDate('tgl_rencana_kembali', '<', Carbon::today())
    ->where('status', '!=', 'kembali') // biar yang sudah balik tidak dihitung
    ->count();

        return view('petugas.dashboard', compact(
            'totalPeminjaman',
            'sedangDipinjam',
            'sudahKembali',
            'terlambat'
        ));
    }
}
