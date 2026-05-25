<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User; // 🔥 Ditambahkan agar bisa menghitung total user di dashboard
use Illuminate\Support\Facades\DB; // 🔥 Ditambahkan untuk mendukung grafik diagram bulanan
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    // ================= DASHBOARD PETUGAS (🔥 NEW FUNCTION) =================
    public function dashboard()
    {
        $totalUser = User::count();
        $totalBuku = Book::count();
        $totalPinjam = Peminjaman::count();
        
        // Status pending sesuai dengan database Oase Sastra
        $pending = Peminjaman::where('status', 'pending')->count();

        // Data Bulanan untuk Grafik - 6 bulan terakhir selalu ditampilkan
        $rawChart = Peminjaman::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan_sort'),
            DB::raw('DATE_FORMAT(created_at, "%b %Y") as bulan'),
            DB::raw('count(*) as total')
        )
        ->groupBy('bulan_sort', 'bulan')
        ->orderBy('bulan_sort', 'asc')
        ->get()
        ->keyBy('bulan_sort');

        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $key = now()->subMonths($i)->format('Y-m');
            $label = now()->subMonths($i)->format('M');
            $chartLabels[] = $label;
            $chartData[] = $rawChart->has($key) ? $rawChart[$key]->total : 0;
        }
        $chart = (object)['labels' => $chartLabels, 'data' => $chartData];

        // Menyiapkan data peminjaman agar sidebar layout petugas tidak crash panggil total()
        $peminjamans = Peminjaman::with(['user', 'book'])->latest()->paginate(5);

        return view('petugas.dashboard', compact(
            'totalUser', 'totalBuku', 'totalPinjam', 'pending', 'peminjamans', 'chart'
        ));
    }

    // ================= Halaman Utama Kelola Buku Petugas =================
    public function buku(Request $request)
    {
        $search = $request->search;
        $query = Book::query();

        if ($search) {
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%");
        }

        $books = $query->latest()->get();

        // 🔥 FIX KUNCI EMAS: Diubah pakai paginate(5) agar layout petugas baris 124 tidak crash panggil ->total()
        $peminjamans = Peminjaman::with(['user', 'book'])->latest()->paginate(5);

        return view('petugas.buku', compact('books', 'peminjamans'));
    }

    // ================= Halaman Form Tambah Buku =================
    public function tambahBuku()
    {
        $kategoris = Kategori::all();
        
        // 🔥 FIX KUNCI EMAS: Diubah pakai paginate(5) agar layout petugas baris 124 tidak crash panggil ->total()
        $peminjamans = Peminjaman::with(['user', 'book'])->latest()->paginate(5);

        return view('petugas.tambah_buku', compact('kategoris', 'peminjamans'));
    }

    // ================= Proses Simpan Buku Baru =================
    public function simpanBuku(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('petugas.buku')->with('success', '✨ Buku berhasil ditambahkan oleh petugas!');
    }

    // ================= Halaman Form Edit Buku =================
    public function editBuku($id)
    {
        $book = Book::findOrFail($id);
        $kategoris = Kategori::all();
        
        // 🔥 FIX KUNCI EMAS: Diubah pakai paginate(5) agar layout petugas baris 124 tidak crash panggil ->total()
        $peminjamans = Peminjaman::with(['user', 'book'])->latest()->paginate(5);

        return view('petugas.edit_buku', compact('book', 'kategoris', 'peminjamans'));
    }

    // ================= Proses Update Data Buku =================
    public function updateBuku(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $book = Book::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('petugas.buku')->with('success', '✅ Data buku diperbarui oleh petugas!');
    }

    // ================= Hapus Buku =================
    public function hapusBuku($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();

        return back()->with('success', '🗑️ Buku berhasil dihapus!');
    }
}