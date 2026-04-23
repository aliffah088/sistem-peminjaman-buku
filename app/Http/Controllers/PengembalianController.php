<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function update(Request $request, $id)
    {
        // 1. Cari data peminjaman
        $peminjaman = Peminjaman::findOrFail($id);

        // 2. Hitung keterlambatan
        $tglRencana = Carbon::parse($peminjaman->tgl_rencana_kembali);
        $tglKembali = Carbon::now()->toDateString();
        $terlambat  = max(0, Carbon::now()->diffInDays($tglRencana, false) * -1);

        // 3. Update status peminjaman
        $peminjaman->update([
            'status'      => 'dikembalikan',
            'tgl_kembali' => $tglKembali,
        ]);

        // 4. Simpan ke tabel pengembalians
        Pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'tgl_kembali'   => $tglKembali,
            'terlambat'     => $terlambat,
            'denda'         => 0, // denda diisi manual oleh admin
        ]);

        // 5. Tambah stok buku
        $alat = Alat::find($peminjaman->alat_id);
        if ($alat) {
            $alat->increment('stok');
        }

        // 6. Catat log
        LogAktivitas::catat('Pengembalian', 'Mengembalikan buku: ' . ($alat->nama_alat ?? 'Buku tidak ditemukan'));

        // 7. Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan! Stok telah diperbarui.');
    }
}