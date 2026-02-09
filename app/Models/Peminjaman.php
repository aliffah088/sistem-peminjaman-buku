<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // 1. Kasih tau Laravel nama tabelnya (karena bukan 'peminjamans')
    protected $table = 'peminjaman';

    // 2. Kasih tau Primary Key-nya (karena bukan 'id')
    protected $primaryKey = 'id_peminjaman';

    // 3. Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'id_user',
        'tgl_pinjam',
        'tgl_rencana_kembali',
        'status'
    ];

    // 4. Relasi ke User (Siapa yang pinjam?)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}