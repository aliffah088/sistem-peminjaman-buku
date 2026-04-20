<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
       
$totalPeminjam = User::where('role', 'peminjam')->count();
$totalPengguna = User::count();
        $sedangDipinjam = Peminjaman::where('status', 'dipinjam')->count();


$terlambat = Peminjaman::whereDate('tgl_rencana_kembali', '<', Carbon::today())
    ->where('status', '!=', 'kembali') // biar yang sudah balik tidak dihitung
    ->count();

        return view('admin.dashboard', compact(
            'totalPeminjam',
            'sedangDipinjam',
            'totalPengguna',
            'terlambat'
        ));
    }
    }
