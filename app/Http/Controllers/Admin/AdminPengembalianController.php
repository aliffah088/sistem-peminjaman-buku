<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class AdminPengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with([
            'peminjaman.user',
            'peminjaman.alat'
        ])->latest()->get();

        return view('admin.pengembalian.index', compact('pengembalian'));
    }

    public function updateDenda(Request $request, $id)
    {
        $request->validate([
            'denda'     => 'required|integer|min:0',
            'terlambat' => 'required|integer|min:0',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update([
            'denda'     => $request->denda,
            'terlambat' => $request->terlambat,
        ]);

        return redirect()->route('admin.pengembalian.index')
            ->with('success', 'Denda berhasil diupdate!');
    }
}