<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('stok')->default(0);
            $table->string('status')->default('tersedia');
            $table->string('cover')->nullable();
            $table->integer('rating')->default(0);
            $table->text('deskripsi')->nullable();
            $table->foreignId('kategori_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};