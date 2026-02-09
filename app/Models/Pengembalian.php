<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = ['id_peminjaman', 'id_user', 'tgl_pengembalian'];

    public function denda()
    {
        return $this->hasOne(Denda::class, 'id_pengembalian');
    }
}