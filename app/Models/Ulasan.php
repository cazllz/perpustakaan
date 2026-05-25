<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasans'; // Nama tabel di database kamu

    protected $fillable = [
        'user_id',  // FK ke tabel users
        'komentar',
        'book_id',
        'rating' 
    ];

    /**
     * Relasi ke Buku (Agar judul & cover muncul)
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Relasi ke User
     * Catatan: Karena di tabel kamu pakai kolom 'nama' (string), 
     * bukan 'user_id', relasi ini mungkin akan mengembalikan null 
     * kecuali kamu punya user_id di tabel tersebut.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}