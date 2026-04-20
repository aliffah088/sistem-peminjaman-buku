<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::latest()->get();

        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,dipinjam,dikembalikan,ditolak'
        ]);

        $peminjaman->status = $request->status;
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }
}