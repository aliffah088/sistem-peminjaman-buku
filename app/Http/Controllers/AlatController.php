<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alat'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required'
        ]);

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    public function edit(string $id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_alat' => 'required',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required'
        ]);

        $alat = Alat::findOrFail($id);

        $alat->update([
            'nama_alat' => $request->nama_alat,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
