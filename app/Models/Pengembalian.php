<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';

    protected $fillable = [
        'peminjaman_id',
        'tgl_kembali',
        'denda',
        'status'
    ];

    // 🔥 RELASI KE PEMINJAMAN
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id');
    }
}