<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Alat;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'alat_id',
        'tgl_pinjam',
        'tgl_rencana_kembali',
        'status'
    ];

    // 🔗 KE USER
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // 🔥 KE ALAT (INI YANG PENTING)
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id', 'id_alat');
    }
}