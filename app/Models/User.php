<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'alamat',
        'role', // Agar fitur tambah petugas di AdminController jalan
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
    ];

    // ================= RELASI =================

    /**
     * Relasi ke Ulasan: Memastikan Nama User muncul di Moderasi Ulasan
     */
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'user_id');
    }

    /**
     * Relasi ke Peminjaman
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }
}