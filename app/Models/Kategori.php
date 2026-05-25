<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // 🔥 SESUAIKAN DENGAN PHPMYADMIN KAMU
    protected $table = 'kategoris'; 

    // 🔥 SESUAIKAN DENGAN KOLOM ID DI DATABASE
    protected $primaryKey = 'id'; 

    public $timestamps = false; 

    protected $fillable = [
        'nama_kategori'
    ];

    // RELASI KE BOOK
    public function books()
    {
        return $this->belongsToMany(
            \App\Models\Book::class,
            'kategoribuku_relasi',
            'id_kategori',
            'id_buku'
        );
    }
}