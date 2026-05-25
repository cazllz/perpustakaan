<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Book;
use App\Models\Kategori;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ================= DASHBOARD (ADMIN & PETUGAS) =================
    public function dashboard()
    {
        $totalUser = User::count();
        
        // 🔥 FIX DASHBOARD VISUAL: Menghitung total akumulasi sisa stok fisik buku di rak, bukan jumlah variasi judul
        $totalBuku = Book::sum('stok');
        
        $totalPinjam = Peminjaman::count();
        
        // 🔥 PERBAIKAN: Mengubah status dari 'diajukan' menjadi 'pending' agar sesuai dengan status di database kamu
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

        // Generate 6 bulan terakhir
        $chartLabels = [];
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $key = now()->subMonths($i)->format('Y-m');
            $label = now()->subMonths($i)->format('M');
            $chartLabels[] = $label;
            $chartData[] = $rawChart->has($key) ? $rawChart[$key]->total : 0;
        }
        $chart = (object)['labels' => $chartLabels, 'data' => $chartData];

        // 🔥 KUNCI UTAMA: Memastikan relasi 'book' ikut dipanggil
        $peminjamans = Peminjaman::with(['user', 'book'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUser', 'totalBuku', 'totalPinjam', 'pending', 'peminjamans', 'chart' 
        ));
    }

    // ================= LIST EMPTY PEMINJAMAN =================
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $query = Peminjaman::with(['book', 'user']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                })
                ->orWhereHas('book', function($q2) use ($search) {
                    $q2->where('judul', 'like', "%$search%");
                });
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $peminjamans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.peminjaman', compact('peminjamans'));
    }

    // ================= KELOLA BUKU (CRUD) =================
    public function buku(Request $request)
    {
        $search = $request->search;
        $query = Book::query();

        if ($search) {
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%")
                  ->orWhere('isbn', 'like', "%$search%");
        }

        $books = $query->latest()->get();

        return view('admin.buku', compact('books'));
    }

    public function tambahBuku()
    {
        $kategoris = Kategori::all(); 
        return view('admin.tambah_buku', compact('kategoris'));
    }

    public function simpanBuku(Request $request)
    {
        $request->validate([
            'judul'      => 'required',
            'penulis'    => 'required',
            'penerbit'   => 'required',
            'tahun'      => 'required|integer',
            'stok'       => 'required|integer|min:0',
            'kategori_id'=> 'required|integer',
            'deskripsi'  => 'nullable|string',
            'cover'      => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun', 'stok', 'kategori_id', 'deskripsi']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        $prefix = auth()->user()->role == 'admin' ? 'admin' : 'petugas';
        return redirect($prefix . '/buku')->with('success', '✨ Buku berhasil ditambahkan!');
    }

    public function editBuku($id)
    {
        $book = Book::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.edit_buku', compact('book', 'kategoris'));
    }

    public function updateBuku(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required',
            'penulis'    => 'required',
            'penerbit'   => 'required',
            'tahun'      => 'required|integer',
            'stok'       => 'required|integer|min:0',
            'kategori_id'=> 'required|integer',
            'deskripsi'  => 'nullable|string',
            'cover'      => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        $book = Book::findOrFail($id);
        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun', 'stok', 'kategori_id', 'deskripsi']);

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($data);

        $prefix = auth()->user()->role == 'admin' ? 'admin' : 'petugas';
        return redirect($prefix . '/buku')->with('success', '✅ Data buku diperbarui!');
    }

    public function hapusBuku($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();

        return back()->with('success', '🗑️ Buku berhasil dihapus!');
    }

    // ================= SETUJUI / VERIFIKASI PINJAM =================
    public function setujui($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->update(['status' => 'dipinjam']);

        // 🔥 FIX LOGIKA SIRKULASI: Potong stok fisik buku sebesar 1 saat resmi di-ACC pinjam oleh admin/petugas
        if ($pinjam->book) {
            $pinjam->book->decrement('stok');
        }

        return back()->with('success', '👍 Pengajuan peminjaman disetujui');
    }

    // ================= TOLAK =================
    public function tolak($id)
    {
        $pinjam = Peminjaman::findOrFail($id);
        $pinjam->update(['status' => 'ditolak']);
        
        // 🔥 FIX SINKRONISASI NOTIFIKASI: Mengubah key dari 'error' menjadi 'success' agar SweetAlert menangkap sesi secara mulus
        return back()->with('success', '❌ Pengajuan peminjaman berhasil ditolak resmi oleh sistem.');
    }

    // ================= AKSI ACC KONFIRMASI PENGEMBALIAN BUKU =================
    public function konfirmasiKembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // 🔥 FIX SINKRONISASI: Mengubah status dari 'kembali' menjadi 'dikembalikan' sesuai ENUM database
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()->toDateString()
        ]);

        // Otomatis mengembalikan jumlah stok fisik buku yang ada di gudang katalog (+1)
        if ($peminjaman->book) {
            $peminjaman->book->increment('stok');
        }

        return back()->with('success', '✅ Konfirmasi pengembalian buku berhasil diproses!');
    }

    // ================= GENERATE LAPORAN & EXPORT =================
    public function laporan(Request $request)
    {
        // Mengambil SEMUA data peminjaman agar singkron dengan laporan
        $query = Peminjaman::with(['user', 'book']);

        if ($request->tgl_mulai && $request->tgl_selesai) {
            $query->whereBetween('tanggal_pinjam', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $peminjamans = $query->latest()->get();
        
        // Tambahkan variabel $books agar tidak error Undefined Variable
        $books = Book::all(); 

        // 🔥 FIX AKHIR SINKRONISASI VIEW: Sesuai nama file asli kamu 'laporan.blade.php'
        if (auth()->user()->role === 'petugas') {
            return view('petugas.laporan', compact('peminjamans', 'books'));
        }

        return view('admin.laporan', compact('peminjamans', 'books'));
    }

    // Export Laporan Peminjaman (Excel)
    public function exportExcel(Request $request)
    {
        $query = Peminjaman::with(['user', 'book']);

        if ($request->tgl_mulai && $request->tgl_selesai) {
            $query->whereBetween('tanggal_pinjam', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $data = $query->get();
        $filename = "laporan_sirkulasi_oase.xls";
        $headers = [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$filename"
        ];

        $callback = function() use ($data) {
            echo "<table border='1'>
                    <tr><th colspan='5' style='background-color: #2c1f17; color: white; font-size: 16px;'>LAPORAN PEMINJAMAN OASE SASTRA</th></tr>
                    <tr><th colspan='5'>Dicetak Oleh: " . auth()->user()->name . " (" . auth()->user()->role . ")</th></tr>
                    <tr>
                        <th style='background-color: #f5efe6;'>User</th>
                        <th style='background-color: #f5efe6;'>Buku</th>
                        <th style='background-color: #f5efe6;'>Tanggal Pinjam</th>
                        <th style='background-color: #f5efe6;'>Tanggal Kembali</th>
                        <th style='background-color: #f5efe6;'>Status</th>
                    </tr>";

            foreach ($data as $row) {
                echo "<tr>
                        <td>" . ($row->user->name ?? '-') . "</td>
                        <td>" . ($row->book->judul ?? '-') . "</td>
                        <td>" . $row->tanggal_pinjam . "</td>
                        <td>" . $row->tanggal_kembali . "</td>
                        <td>" . ucfirst($row->status) . "</td>
                      </tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }

    // Export Data Buku (Cetak Data Buku)
    public function exportBuku()
    {
        $books = Book::all();
        $filename = "katalog_buku_oase.xls";
        $headers = [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$filename"
        ];

        $callback = function() use ($books) {
            echo "<table border='1'>
                    <tr><th colspan='5' style='background-color: #d4a373; color: white; font-size: 16px;'>DATA KATALOG BUKU OASE SASTRA</th></tr>
                    <tr><th colspan='5'>Petugas: " . auth()->user()->name . "</th></tr>
                    <tr>
                        <th style='background-color: #f5efe6;'>Judul Buku</th>
                        <th style='background-color: #f5efe6;'>Penulis</th>
                        <th style='background-color: #f5efe6;'>Penerbit</th>
                        <th style='background-color: #f5efe6;'>Tahun Terbit</th>
                        <th style='background-color: #f5efe6;'>Stok Tersedia</th>
                    </tr>";

            foreach ($books as $b) {
                echo "<tr>
                        <td>{$b->judul}</td>
                        <td>{$b->penulis}</td>
                        <td>{$b->penerbit}</td>
                        <td>{$b->tahun_terbit}</td>
                        <td align='center'>{$b->stok}</td>
                      </tr>";
            }
            echo "</table>";
        };

        return response()->stream($callback, 200, $headers);
    }

    // ================= KELOLA PETUGAS =================
    public function petugas()
    {
        $petugas = User::whereIn('role', ['admin', 'petugas'])->latest()->get();
        return view('admin.petugas', compact('petugas'));
    }

    public function simpanPetugas(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => explode('@', $request->email)[0],
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', '👮 Petugas baru berhasil didaftarkan!');
    }

    public function hapusPetugas($id)
    {
        $user = User::findOrFail($id);
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri!');
        }
        $user->delete();
        return back()->with('success', 'Data petugas berhasil dihapus!');
    }

    // ================= KELOLA USER (PEMBACA) =================
    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function hapusUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', '👤 Akun user berhasil dihapus!');
    }

    // ================= KELOLA ULASAN =================
    public function ulasan()
    {
        $ulasans = Ulasan::with(['book'])->latest()->get();
        return view('admin.ulasan', compact('ulasans'));
    }

    public function hapusUlasan($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();
        return back()->with('success', '💬 Ulasan berhasil dihapus!');
    }
}
