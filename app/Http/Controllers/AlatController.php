<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;

class AlatController extends Controller
{
    // 🔥 TAMPIL DATA
    public function index()
    {
        $alat = Alat::with('kategori')->get();

        return view('admin.alat.index', compact('alat'));
    }

    // 🔥 FORM TAMBAH
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    // 🔥 SIMPAN DATA
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'nama_alat'   => 'required',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'nullable',
        ]);

        // SIMPAN
        Alat::create([
            'nama_alat'   => $request->nama_alat,
            'stok'        => $request->stok,
            'kategori_id' => $request->kategori_id,
            'kondisi'     => $request->kondisi ?? 'baik',
        ]);

        return redirect()->route('alat.index')
            ->with('success', 'Data berhasil disimpan');
    }

    // 🔥 DETAIL
    public function show($id)
    {
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    // 🔥 EDIT
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    // 🔥 UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat'   => 'required',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'nullable',
        ]);

        $alat = Alat::findOrFail($id);

        $alat->update([
            'nama_alat'   => $request->nama_alat,
            'stok'        => $request->stok,
            'kategori_id' => $request->kategori_id,
            'kondisi'     => $request->kondisi ?? 'baik',
        ]);

        return redirect()->route('alat.index')
            ->with('success', 'Data berhasil diupdate');
    }

    // 🔥 DELETE
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')
            ->with('success', 'Data berhasil dihapus');
    }
}