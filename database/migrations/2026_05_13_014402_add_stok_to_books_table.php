<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // 🔥 Menambahkan kolom stok dengan default 0
            $table->integer('stok')->default(0)->after('penerbit'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Menghapus kolom stok jika migrasi di-rollback
            $table->dropColumn('stok');
        });
    }
};