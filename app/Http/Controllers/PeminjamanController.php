<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Book; // 🔥 Tambahkan ini agar bisa memanggil Model Book

class PeminjamanController extends Controller
{
    public function pinjam(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam'
        ]);

        // CEK STOK BUKU TERLEBIH DAHULU
        $buku = Book::findOrFail($id);
        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis!');
        }

        // CEK MASIH PINJAM (STATUS DIPINJAM)
        $masihPinjam = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->exists();

        if ($masihPinjam) {
            return back()->with('error', 'Kamu masih memiliki buku yang sedang dipinjam.');
        }

        // CEK MASIH ADA PENGAJUAN PENDING
        $masihPending = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->exists();

        if ($masihPending) {
            return back()->with('error', 'Masih ada pengajuan yang belum disetujui admin.');
        }

        // SIMPAN DATA (STATUS PENDING)
        Peminjaman::create([
            'user_id' => auth()->id(),
            'book_id' => $id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'pending'
        ]);

        // 🔥 FIX LOGIKA: Perintah decrement di bawah ini dihapus/dikomentari.
        // Stok tidak boleh berkurang di sini karena statusnya baru dikirim ke admin (belum di-ACC).
        // $buku->decrement('stok');

        // 🔥 SOLUSI UTAMA: Mengubah redirect dari '/profil' menjadi back() agar user tidak terlempar ke halaman 404
        return back()->with('success', 'Pengajuan peminjaman berhasil dikirim! Silakan tunggu konfirmasi admin.');
    }
}