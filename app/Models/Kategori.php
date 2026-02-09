<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori'];

    // Relasi: Satu kategori punya banyak alat
    public function alats()
    {
        return $this->hasMany(Alat::class, 'id_kategori');
    }
}