<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{   
    use HasFactory, Notifiable;

    // Jika primary key di database bukan 'id', ganti ini
    protected $primaryKey = 'id'; // contoh: 'user_id'

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'name',      // ganti 'name' jadi 'username' kalau sesuai ERD
        'email',
        'password',
        'role',
    ];

    // Kolom yang disembunyikan saat fetch data
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting kolom
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
