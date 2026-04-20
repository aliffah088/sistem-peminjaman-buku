<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat']);

        // 🔍 FILTER HARIAN
        if ($request->tanggal) {
            $query->whereRaw("DATE(created_at) = ?", [$request->tanggal]);
        }

        // 🔍 FILTER BULANAN
        if ($request->bulan) {
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$request->bulan]);
        }

        $peminjaman = $query->get();

        return view('admin.laporan.index', compact('peminjaman'));
    }
}