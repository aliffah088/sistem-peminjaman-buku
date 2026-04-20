<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'id_alat';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_alat',
        'stok',
        'id_kategori',
    ];

    // 🔗 Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // 🔗 Relasi ke peminjaman (sudah benar, biarin aja)
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_alat', 'id_alat');
    }

    // 🔥 Status stok (opsional buat tampilan)
    public function getStatusStokAttribute()
    {
        return $this->stok > 0 ? 'Tersedia' : 'Habis';
    }
}