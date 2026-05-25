<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ulasan ke user (opsional, jika ingin tahu siapa yang mengulas)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Menghubungkan ulasan ke buku
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->text('komentar');
            $table->integer('rating')->default(5); // Tambahan rating untuk ulasan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};