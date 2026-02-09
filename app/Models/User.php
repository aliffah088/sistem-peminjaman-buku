<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Sesuaikan primary key jika di ERD bukan 'id' (misal 'id_user')
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name', // Ganti 'name' jadi 'username' sesuai ERD kamu
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}