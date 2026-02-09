<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // 1. TAMBAHKAN INI: Untuk nampilin daftar riwayat pinjam
    public function index()
    {
        // Mengambil data peminjaman beserta data user dan alat (Eager Loading)
        $peminjamans = Peminjaman::with(['user', 'alat'])->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    // 2. TAMBAHKAN INI: Untuk nampilin form pinjam
    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alat' => 'required',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tgl_kembali' => 'required|date|after_or_equal:today', // Tambahan: tgl kembali gak boleh kemarin
        ]);

        $alat = Alat::findOrFail($request->id_alat);
        
        if ($alat->stok < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Simpan data ke tabel Peminjaman
        Peminjaman::create([
            'id_user' => Auth::id(), 
            'id_alat' => $request->id_alat,
            'tgl_pinjam' => now(), 
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'dipinjam',
            'jumlah_pinjam' => $request->jumlah_pinjam, // Pastikan kolom ini ada di migration peminjaman!
        ]);

        // Kurangi stok di tabel Alat
        $alat->stok -= $request->jumlah_pinjam;
        $alat->save();

        return redirect()->route('peminjaman.index')->with('success', 'Berhasil meminjam alat!');
    }
}