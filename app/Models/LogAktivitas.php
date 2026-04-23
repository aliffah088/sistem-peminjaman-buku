<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    // Sesuaikan dengan nama kolom di foto TablePlus kamu
    protected $fillable = [
        'nama_user', // sebelumnya user_id
        'aksi',      // sebelumnya aktivitas
        'deskripsi', // sebelumnya detail
    ];

    public static function catat($aktivitas, $detail = null)
    {
        return self::create([
            'nama_user' => Auth::user()->name, // Simpan nama user
            'aksi'      => $aktivitas,         // Simpan jenis aksi
            'deskripsi' => $detail,            // Simpan detailnya
        ]);
    }

    public function user()
    {
        // Karena kamu pakai nama_user (string), relasi ini mungkin perlu disesuaikan nanti
        // Tapi untuk sekarang, ini sudah cukup untuk menghilangkan error.
        return $this->belongsTo(User::class, 'nama_user', 'name');
    }
}