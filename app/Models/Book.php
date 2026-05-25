<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'status',
        'cover',
        'rating',
        'stok',
        'sinopsis' // 🔥 FIX DATA GA KEBAWAH: Wajib diubah jadi 'sinopsis' agar Eloquent mengizinkan data baru masuk ke tabel books!
    ];

    // 🔥 RELASI ULASAN
    public function ulasan()
    {
        return $this->hasMany(\App\Models\Ulasan::class, 'book_id');
    }

    // 🔥 RELASI KATEGORI (WAJIB)
    public function kategori()
    {
        return $this->belongsToMany(
            \App\Models\Kategori::class,
            'kategoribuku_relasi',
            'id_buku',
            'id_kategori'
        );
    }
}