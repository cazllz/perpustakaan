<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'bukus';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'status',
        'cover',
        'rating',
        'stok',
        'deskripsi',
        'kategori_id'
    ];

    // RELASI ULASAN
    public function ulasan()
    {
        return $this->hasMany(\App\Models\Ulasan::class, 'book_id');
    }

    // RELASI KATEGORI
    public function kategori()
    {
        return $this->belongsTo(\App\Models\Kategori::class, 'kategori_id');
    }
}