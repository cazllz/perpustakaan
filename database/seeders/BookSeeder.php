<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'judul'      => 'Bumi Manusia',
                'penulis'    => 'Pramoedya Ananta Toer',
                'penerbit'   => 'Lentera Dipantara',
                'stok'       => 10,
                'tahun'      => 1980,
                'status'     => 'tersedia',
                'kategori'   => 'Sejarah',
                'cover'      => 'phpbumi_manusia.jpg',
                'rating'     => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Laskar Pelangi',
                'judul'      => 'Laskar Pelangi',
                'penulis'    => 'Andrea Hirata',
                'penerbit'   => 'Bentang Pustaka',
                'stok'       => 15,
                'tahun'      => 2005,
                'status'     => 'tersedia',
                'kategori'   => 'Fiksi',
                'cover'      => 'laskar_pelangi.jpg',
                'rating'     => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Harry Potter',
                'penulis'    => 'J.K. Rowling',
                'penerbit'   => 'Bloomsbury',
                'stok'       => 8,
                'tahun'      => 1997,
                'status'     => 'tersedia',
                'kategori'   => 'Fantasi',
                'cover'      => 'harry_potter.webp',
                'rating'     => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Kamu bisa tambahkan buku lainnya di bawah sini dengan format yang sama
        ]);
    }
}