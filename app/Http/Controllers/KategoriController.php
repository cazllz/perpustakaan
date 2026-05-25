<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Menampilkan halaman kelola kategori dengan fitur pencarian data.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = DB::table('kategoris');

        if ($search) {
            $query->where('nama_kategori', 'like', '%' . $search . '%');
        }

        $kategoris = $query->orderBy('created_at', 'desc')->get();

        return view('admin.kategori', compact('kategoris'));
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);

        DB::table('kategoris')->insert([
            'nama_kategori' => $request->nama_kategori,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', '✨ Kategori baru berhasil ditambahkan!');
    }

    /**
     * 🔥 FITUR TAMBAHAN: Memperbarui nama kategori (Edit)
     */
    public function update(Request $request, $id)
    {
        // Validasi agar nama kategori tidak boleh kosong, dan harus unik kecuali untuk data kategori itu sendiri
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id,
        ]);

        DB::table('kategoris')->where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            'updated_at' => now(),
        ]);

        return back()->with('success', '✨ Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus data kategori dari database.
     */
    public function destroy($id)
    {
        DB::table('kategoris')->where('id', $id)->delete();

        return back()->with('success', '❌ Kategori berhasil dihapus!');
    }
}