<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $fillable = ['id_peminjaman', 'id_alat', 'jumlah_pinjam'];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat');
    }
}