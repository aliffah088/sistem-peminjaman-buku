<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $primaryKey = 'id'; // 🔥 INI YANG BENAR

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
}