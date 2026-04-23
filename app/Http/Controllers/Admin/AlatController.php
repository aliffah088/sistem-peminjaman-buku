<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogAktivitas;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('admin.alat.index', compact('alat', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'required',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_buku'), $filename);
            $gambar = 'gambar_buku/' . $filename;
        }

        $alat = Alat::create([
            'nama_alat'    => $request->nama_alat,
            'stok'         => $request->stok,
            'kategori_id'  => $request->kategori_id,
            'kondisi'      => $request->kondisi,
            'penulis'      => $request->penulis,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn'         => $request->isbn,
            'gambar'       => $gambar,
        ]);

        // ✅ Catat log
        LogAktivitas::catat('Tambah Buku', 'Menambahkan buku: ' . $alat->nama_alat);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show($id)
    {
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat'   => 'required',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'required',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $alat = Alat::findOrFail($id);

        $gambar = $alat->gambar;
        if ($request->hasFile('gambar')) {
            if ($gambar && file_exists(public_path($gambar))) {
                unlink(public_path($gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_buku'), $filename);
            $gambar = 'gambar_buku/' . $filename;
        }

        $alat->update([
            'nama_alat'    => $request->nama_alat,
            'stok'         => $request->stok,
            'kategori_id'  => $request->kategori_id,
            'kondisi'      => $request->kondisi,
            'penulis'      => $request->penulis,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'isbn'         => $request->isbn,
            'gambar'       => $gambar,
        ]);

        // ✅ Catat log
        LogAktivitas::catat('Edit Buku', 'Mengedit buku: ' . $alat->nama_alat);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        // ✅ Catat log sebelum hapus
        LogAktivitas::catat('Hapus Buku', 'Menghapus buku: ' . $alat->nama_alat);

        if ($alat->gambar && file_exists(public_path($alat->gambar))) {
            unlink(public_path($alat->gambar));
        }

        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}