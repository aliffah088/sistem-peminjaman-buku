<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori; 
use Illuminate\Http\Request;

class AlatController extends Controller
{
    // 1. Tampil Data Alat
    public function index()
    {
        $alats = Alat::with('kategori')->get();
        return view('alat.index', compact('alats'));
    }

    // 2. Form Tambah Alat
    public function create()
    {
        // Mengambil semua kategori untuk dropdown
        $kategoris = Kategori::all();
        return view('alat.create', compact('kategoris'));
    }

    // 3. Simpan ke Database
    public function store(Request $request)
    {
        // Validasi sesuai kolom di ERD kamu
        $request->validate([
            'nama_alat'   => 'required',
            'id_kategori' => 'required',
            'kondisi'     => 'required',
            'stok'        => 'required|numeric',
        ]);

        // Simpan data
        Alat::create($request->all());

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    // 4. Form Edit Alat
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    // 5. Update Data Alat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat'   => 'required',
            'id_kategori' => 'required',
            'kondisi'     => 'required',
            'stok'        => 'required|numeric',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui!');
    }

    // 6. Hapus Alat
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}