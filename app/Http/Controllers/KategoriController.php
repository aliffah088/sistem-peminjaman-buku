<?php

namespace App\Http\Controllers;

use App\Models\Kategori; // Pastikan model Kategori sudah ada
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori
        $kategori = Kategori::all(); 
        // Mengarahkan ke file resources/views/kategori/index.blade.php
        return view('admin.kategoris.index', compact('kategori'));
    }

    // Tambahkan method lain (create, store, dll) di bawah sini
}