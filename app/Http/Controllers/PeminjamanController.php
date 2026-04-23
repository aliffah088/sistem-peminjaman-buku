<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\LogAktivitas; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Menampilkan data peminjaman milik user yang sedang login saja (untuk peminjam)
        // Jika admin, biasanya melihat semua. Tapi ini kita buat general dulu:
        $peminjamans = Peminjaman::with(['user', 'alat'])->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id'             => 'required|exists:alats,id', // Pastikan nama tabel benar (alats atau alat)
            'tgl_rencana_kembali' => 'required|date|after:today',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < 1) {
            return back()->withErrors(['alat_id' => 'Stok alat tidak mencukupi.'])->withInput();
        }

        // 1. Simpan Data Peminjaman
        $peminjaman = Peminjaman::create([
            'user_id'             => Auth::id(),
            'alat_id'             => $request->alat_id,
            'tgl_pinjam'          => now()->toDateString(),
            'tgl_rencana_kembali' => $request->tgl_rencana_kembali,
            'status'              => 'dipinjam',
        ]);

        // 2. Kurangi Stok Alat
        $alat->decrement('stok');

        // 3. CATAT KE LOG AKTIVITAS (Agar Error Class Not Found Hilang)
        LogAktivitas::create([
            'user_id'   => Auth::id(),
            'aktivitas' => 'Meminjam Alat',
            'detail'    => Auth::user()->name . ' meminjam alat: ' . $alat->nama_alat,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil!');
    }
}