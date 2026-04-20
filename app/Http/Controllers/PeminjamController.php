<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $total     = Peminjaman::where('user_id', $userId)->count();
        $menunggu  = Peminjaman::where('user_id', $userId)->where('status', 'menunggu')->count();
        $disetujui = Peminjaman::where('user_id', $userId)->where('status', 'disetujui')->count();

        return view('peminjam.dashboard', compact('total', 'menunggu', 'disetujui'));
    }

    public function alat()
    {
        $alat = Alat::all();
        return view('peminjam.alat', compact('alat'));
    }

    public function peminjaman(Request $request)
    {
        $userId = auth()->id();

        $alat = Alat::all();

        $peminjaman = Peminjaman::where('user_id', $userId)
                        ->latest()
                        ->get();

        return view('peminjam.peminjaman', compact('alat', 'peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alat'             => 'required',
            'tgl_rencana_kembali' => 'required|date|after_or_equal:today',
        ]);

        DB::beginTransaction();

        try {
            $alat = Alat::findOrFail($request->id_alat);

            if ($alat->stok <= 0) {
                return back()->with('error', 'Stok alat habis!');
            }

            Peminjaman::create([
                'user_id' => auth()->id(),
                'nama_peminjam' => auth()->user()->name,
                'nama_alat' => $alat->nama_alat,
                'tgl_pinjam' => now()->toDateString(),
                'tgl_rencana_kembali' => $request->tgl_rencana_kembali,
                'status' => 'dipinjam',
            ]);

            $alat->decrement('stok');

            DB::commit();

            return redirect()->route('peminjam.peminjaman')
                ->with('success', 'Berhasil pinjam!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function riwayat()
    {
        $userId = auth()->id();

        $riwayat = Peminjaman::where('user_id', $userId)
                    ->whereNotNull('tgl_pinjam')
                    ->latest()
                    ->get();

        return view('peminjam.riwayat', compact('riwayat'));
    }
}