<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamController extends Controller
{
    /**
     * Menampilkan Halaman Dashboard Peminjam
     */
    public function dashboard()
    {
        $userId = Auth::id();

        // 📊 Statistik
        $totalPeminjaman = Peminjaman::where('user_id', $userId)->count();
        $menunggu        = Peminjaman::where('user_id', $userId)->where('status', 'menunggu')->count();
        $disetujui       = Peminjaman::where('user_id', $userId)->where('status', 'disetujui')->count();
        $ditolak         = Peminjaman::where('user_id', $userId)->where('status', 'ditolak')->count();

        // 📌 Peminjaman terakhir (5 data)
        $peminjamanTerbaru = Peminjaman::with('alat')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // 🔔 Belum dikembalikan
        $belumKembali = Peminjaman::with('alat')
            ->where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->get();

        return view('peminjam.dashboard', compact(
            'totalPeminjaman',
            'menunggu',
            'disetujui',
            'ditolak',
            'peminjamanTerbaru',
            'belumKembali'
        ));
    }

    /**
     * Menampilkan Daftar Semua Buku/Alat
     */
    public function alat()
    {
        $alats = Alat::all();
        return view('peminjam.alat.index', compact('alats'));
    }

    /**
     * Menampilkan Form Peminjaman
     */
    public function peminjaman()
    {
        $alats = Alat::where('stok', '>', 0)->get();

        $peminjaman = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjam.peminjaman', compact('alats', 'peminjaman'));
    }

    /**
     * Menampilkan Daftar Buku yang Sedang Dipinjam (Untuk dikembalikan)
     */
    public function pengembalian()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->get();

        return view('peminjam.pengembalian', compact('peminjamans'));
    }

    /**
     * Menampilkan Riwayat Semua Aktivitas Peminjaman
     */
    public function riwayat()
    {
        $riwayats = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjam.riwayat', compact('riwayats'));
    }

    /**
     * Menyimpan data peminjaman baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'alat_id'             => 'required',
            'tgl_rencana_kembali' => 'required|date|after:today',
        ]);

        // 2. Cek Alat
        $alat = Alat::find($request->alat_id);

        // 3. Cek stok
        if (!$alat || $alat->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis atau tidak ditemukan!');
        }

        // 4. Simpan data
        Peminjaman::create([
            'user_id'             => Auth::id(),
            'alat_id'             => $request->alat_id,
            'tgl_pinjam'          => now()->toDateString(),
            'tgl_rencana_kembali' => $request->tgl_rencana_kembali,
            'status'              => 'dipinjam',
        ]);

        // 5. Kurangi stok
        $alat->decrement('stok');

        // 6. Redirect
        return redirect()->route('peminjam.riwayat')
            ->with('success', 'Berhasil meminjam buku!');
    }
}