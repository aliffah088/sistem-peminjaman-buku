<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'alat_id',           // ✅ wajib ada
        'tgl_pinjam',
        'tgl_rencana_kembali',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id', 'id'); // ✅ pakai 'id' bukan 'id_alat'
    }
}