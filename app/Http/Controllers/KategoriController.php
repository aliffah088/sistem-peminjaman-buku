<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // TAMPIL DATA
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategoris.index', compact('kategori'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.kategoris.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    // UPDATE DATA
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    // HAPUS DATA
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}