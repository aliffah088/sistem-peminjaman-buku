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
        $request->validate([
            'nama_alat'   => 'required',
            'stok'        => 'required|integer|min:0',
            'id_kategori' => 'required',
            'kondisi'     => 'required'
        ]);

        // 🔥 SIMPAN MANUAL (LEBIH AMAN DARI $request->all())
        Alat::create([
            'nama_alat'   => $request->nama_alat,
            'stok'        => $request->stok,
            'id_kategori' => $request->id_kategori,
            'kondisi'     => $request->kondisi,
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    // 🔥 DETAIL
    public function show($id)
    {
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    // 🔥 FORM EDIT
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
            'id_kategori' => 'required',
            'kondisi'     => 'required'
        ]);

        $alat = Alat::findOrFail($id);

        $alat->update([
            'nama_alat'   => $request->nama_alat,
            'stok'        => $request->stok,
            'id_kategori' => $request->id_kategori,
            'kondisi'     => $request->kondisi,
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    // 🔥 HAPUS
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}