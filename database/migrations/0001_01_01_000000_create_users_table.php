<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user'); // Dari migrasi add_role
            $table->string('username')->nullable();  // Dari migrasi add_username
            $table->text('alamat')->nullable();      // Dari migrasi add_alamat
            $table->timestamps();
        });

        // 2. Tabel Books
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('stok')->default(0);
            $table->integer('tahun');
            $table->string('status')->default('tersedia');
            $table->string('kategori')->nullable(); // Gabungan kategori
            $table->string('cover')->nullable();    // Dari migrasi add_cover
            $table->integer('rating')->default(0);  // Dari migrasi add_rating
            $table->text('deskripsi')->nullable();  // Pastikan ini 'deskripsi', bukan 'sinopsis'
            $table->timestamps();
        });

        // 3. Tabel Kategori (Jika perlu)
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('books');
        Schema::dropIfExists('kategoris');
    }
};