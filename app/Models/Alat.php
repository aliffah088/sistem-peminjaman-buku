<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    public function detailPeminjaman()
{
    return $this->hasMany(DetailPeminjaman::class, 'id_alat', 'id_alat');
}
    // Tambahkan baris ini agar Laravel tidak mencari tabel 'alats'
    protected $table = 'alat'; 
    
    // Pastikan juga primary key-nya sesuai ERD kamu
    protected $primaryKey = 'id_alat'; 

    protected $fillable = ['id_kategori', 'nama_alat', 'kondisi', 'stok'];
    
// Relasi ke Kategori
public function kategori() {
    return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}