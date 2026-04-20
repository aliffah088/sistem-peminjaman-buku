<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->latest()->get();

        return view('admin.peminjaman.index', compact('peminjaman'));
    }
}