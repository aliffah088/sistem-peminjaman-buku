<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->orderBy('id', 'desc')
            ->get();

        return view('petugas.pengembalian.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // ambil data peminjaman
            $peminjaman = Peminjaman::findOrFail($request->id_peminjaman);

            // ✅ SIMPAN PENGEMBALIAN (FIX SEMUA)
            Pengembalian::create([
                'peminjaman_id' => $request->id_peminjaman,
                'tgl_kembali'   => now(),
                'denda'         => $request->denda ?? 0,
            ]);

            // update status
            $peminjaman->update([
                'status'      => 'dikembalikan',
                'tgl_kembali' => now(),
            ]);

            // 🔄 KEMBALIKAN STOK BUKU SAAT PENGEMBALIAN
            if ($peminjaman->id_alat) {
                $alat = Alat::find($peminjaman->id_alat);
                if ($alat) {
                    $alat->increment('stok');
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Pengembalian berhasil');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}