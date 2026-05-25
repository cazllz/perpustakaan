<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use App\Models\Kategori; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');
        $query = Book::query();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }
        if ($kategori) {
            $kat = Kategori::where('nama_kategori', $kategori)->first();
            if ($kat) {
                $query->where('kategori_id', $kat->id);
            }
        }

        $books = $query->with('kategori')->latest()->get();

        // Ambil data kategori agar muncul secara dinamis di dashboard user
        $kategoris = Kategori::all();

        return view('books', compact('books', 'kategoris'));
    }

    public function kategori($nama)
    {
        // Cari kategori by nama dulu, lalu filter by kategori_id
        $kat = \App\Models\Kategori::where('nama_kategori', $nama)->first();
        
        if (!$kat) {
            $books = collect();
        } else {
            $books = Book::where('kategori_id', $kat->id)->latest()->get();
        }

        $kategoris = \App\Models\Kategori::all();

        return view('books', compact('books', 'kategoris'));
    }

    // ================= DETAIL (LOGIC UPDATED: 1 USER 1 BOOK) =================
    public function detail($id)
    {
        $book = Book::findOrFail($id);

        // Ambil ulasan terbaru terkait buku ini
        $ulasan = Ulasan::where('book_id', $id)->latest()->get();

        // Ambil rata-rata rating untuk ditampilkan di detail
        $averageRating = Ulasan::where('book_id', $id)->avg('rating');
        $displayRating = $averageRating ? number_format($averageRating, 1) : '0';

        $pernahPinjam = false;
        if (auth()->check()) {
            // User dianggap sedang meminjam jika statusnya 'dipinjam', 'diajukan', atau sedang 'menunggu_kembali'
            $pernahPinjam = Peminjaman::where('user_id', auth()->id())
                ->whereIn('status', ['dipinjam', 'diajukan', 'menunggu_kembali'])
                ->exists();
        }

        return view('detail', compact('book', 'pernahPinjam', 'ulasan', 'displayRating'));
    }

    public function formPinjam($id)
    {
        $book = Book::findOrFail($id);
        
        // Cek ulang di server side untuk mencegah akses langsung via URL
        $masihPinjam = Peminjaman::where('user_id', auth()->id())
            ->whereIn('status', ['dipinjam', 'diajukan', 'menunggu_kembali'])
            ->exists();

        if ($masihPinjam) {
            return redirect('/books/' . $id)->with('error', '❌ Selesaikan atau batalkan pengajuan peminjaman sebelumnya!');
        }

        return view('form_pinjam', compact('book'));
    }

    // ================= KOLEKSI (FAVORIT) =================
    public function koleksi()
    {
        $data = DB::table('favorites')
            ->join('bukus', 'favorites.book_id', '=', 'bukus.id')
            ->where('favorites.user_id', auth()->id())
            ->select('bukus.*', 'favorites.id as fav_id') // fav_id sebagai kunci hapus
            ->latest('favorites.created_at')
            ->get();

        return view('koleksi', compact('data'));
    }

    public function tambahKoleksi($id)
    {
        $user = auth()->user();
        $cek = DB::table('favorites')->where('user_id', $user->id)->where('book_id', $id)->exists();

        if ($cek) {
            return back()->with('error', 'Buku sudah ada di koleksi!');
        }

        DB::table('favorites')->insert([
            'user_id' => $user->id,
            'book_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', '❤️ Buku ditambahkan ke koleksi!');
    }

    public function hapusKoleksi($id)
    {
        // Menghapus berdasarkan ID di tabel favorites (bukan book_id)
        DB::table('favorites')->where('id', $id)->where('user_id', auth()->id())->delete();
        return back()->with('success', '❌ Buku dihapus dari koleksi!');
    }

    public function profile()
    {
        $user = auth()->user();
        $riwayat = Peminjaman::with('book')->where('user_id', $user->id)->latest()->get();
        return view('profile', compact('user', 'riwayat'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'alamat' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', '✨ Profil sastra Anda berhasil diperbarui!');
    }

    // ================= KIRIM ULASAN =================
    public function kirimUlasan(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $pernahPinjam = Peminjaman::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->where('status', 'dikembalikan')
            ->exists();

        if (!$pernahPinjam) {
            return back()->with('error', '❌ Harus menyelesaikan peminjaman dulu!');
        }

        Ulasan::create([
            'user_id' => auth()->id(),
            'komentar' => $request->komentar,
            'rating' => $request->rating,
            'book_id' => $id
        ]);

        return back()->with('success', '✅ Ulasan dan Rating berhasil dikirim!');
    }

    public function rating(Request $request, $id)
    {
        $pernahPinjam = Peminjaman::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->where('status', 'dikembalikan')
            ->exists();

        if (!$pernahPinjam) {
            return back()->with('error', '❌ Harus menyelesaikan peminjaman dulu!');
        }

        $book = Book::findOrFail($id);
        $book->rating = $request->rating;
        $book->save();

        return back()->with('success', '⭐ Rating berhasil diberikan!');
    }

    public function kembalikan($id)
    {
        $pinjam = Peminjaman::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->first();

        if (!$pinjam) {
            return back()->with('error', '❌ Data peminjaman aktif tidak ditemukan.');
        }

        $pinjam->update([
            'status' => 'menunggu_kembali'
        ]);

        return back()->with('success', '✨ Pengajuan berhasil dikirim! Silakan kembalikan buku fisik ke petugas.');
    }

    // ================= ADMIN AREA =================
    public function adminBuku(Request $request)
    {
        $search = $request->input('search');
        $query = Book::query();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%');
        }

        $books = $query->with('kategori')->latest()->get();

        return view('admin.buku', compact('books'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.tambah-buku', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1000|max:' . date('Y'),
            'kategori_id' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $coverName = null;
        if ($request->hasFile('cover')) {
            $coverFile = $request->file('cover');
            $coverName = time() . '_' . $coverFile->getClientOriginalName();
            $coverFile->move(public_path('assets/img'), $coverName);
        }

        DB::table('books')->insert([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'cover' => $coverName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/buku')->with('success', '✨ Buku baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return back()->with('success', '❌ Buku berhasil dihapus dari sistem!');
    }
}