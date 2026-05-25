<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController; 

// ================= LANDING =================
Route::get('/', function () {
    return view('landing');
});

// ================= ABOUT =================
Route::get('/about', function () {
    return view('about');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// 🔥 SOLUSI FINAL: Mendukung GET dan POST sekaligus agar tidak Method Not Allowed
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');


// ================= PROTECTED (USER, ADMIN, & PETUGAS) =================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [BookController::class, 'index']);

    // ================= KATALOG =================
    Route::get('/books', [BookController::class, 'index']);
    // Perbaikan kecil: menyelaraskan parameter id agar serasi
    Route::get('/books/{id}', [BookController::class, 'detail']);

    // ================= KATEGORI =================
    Route::get('/kategori/{nama}', [BookController::class, 'kategori']);

    // ================= PINJAM =================
    Route::get('/pinjam/{id}/form', [BookController::class, 'formPinjam']);
    // Menambahkan name() pada route form pinjam agar aman jika dipanggil di tempat lain
    Route::post('/pinjam/{id}', [PeminjamanController::class, 'pinjam']);

    // ================= KOLEKSI (FAVORIT) =================
    Route::get('/koleksi', [BookController::class, 'koleksi']);
    Route::post('/koleksi/{id}', [BookController::class, 'tambahKoleksi'])->name('koleksi.tambah');
    
    // 🔥 SINKRONISASI FIX: Mengubah 'koleksi.remove' menjadi 'koleksi.hapus' agar cocok dengan file Blade
    Route::delete('/koleksi/hapus/{id}', [BookController::class, 'hapusKoleksi'])->name('koleksi.hapus');

    // ================= PROFILE =================
    Route::get('/profile', [BookController::class, 'profile']);
    Route::post('/profile/update', [BookController::class, 'updateProfile'])->name('profile.update');

    // ================= KEMBALIKAN (USER SIDE) =================
    Route::get('/kembalikan/{id}', [BookController::class, 'kembalikan']);

    // ================= ULASAN & RATING =================
    Route::post('/ulasan/{id}', [BookController::class, 'kirimUlasan']);
    Route::post('/rating/{id}', [BookController::class, 'rating']);

    // ================= ADMIN AREA (🔥 RESTRICTED) =================
    Route::middleware('admin')->group(function () {

        // 🔥 DASHBOARD ADMIN
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // 🔥 KELOLA BUKU
        Route::get('/admin/buku', [AdminController::class, 'buku'])->name('admin.buku');
        Route::get('/admin/buku/tambah', [AdminController::class, 'tambahBuku'])->name('admin.buku.tambah');
        Route::post('/admin/buku/simpan', [AdminController::class, 'simpanBuku'])->name('admin.buku.simpan');
        Route::get('/admin/buku/edit/{id}', [AdminController::class, 'editBuku'])->name('admin.buku.edit');
        Route::put('/admin/buku/update/{id}', [AdminController::class, 'updateBuku'])->name('admin.buku.update');
        Route::delete('/admin/buku/hapus/{id}', [AdminController::class, 'hapusBuku'])->name('admin.buku.hapus');

        // 🔥 KELOLA KATEGORI
        Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
        Route::post('/admin/kategori', [KategoriController::class, 'store']);
        Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.hapus');

        // 🔥 KELOLA PETUGAS
        Route::get('/admin/petugas', [AdminController::class, 'petugas'])->name('admin.petugas');
        Route::post('/admin/petugas', [AdminController::class, 'simpanPetugas'])->name('petugas.simpan');
        Route::delete('/admin/petugas/{id}', [AdminController::class, 'hapusPetugas'])->name('petugas.hapus');

        // 🔥 KELOLA USER
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::delete('/admin/users/{id}', [AdminController::class, 'hapusUser']);

        // 🔥 KELOLA ULASAN
        Route::get('/admin/ulasan', [AdminController::class, 'ulasan'])->name('admin.ulasan');
        Route::delete('/admin/ulasan/{id}', [AdminController::class, 'hapusUlasan']);

        // 🔥 SIRKULASI PEMINJAMAN (SINKRONISASI COCOK SAMA BLADE)
        Route::get('/admin/peminjaman', [AdminController::class, 'index'])->name('admin.peminjaman');
        Route::get('/admin/setujui/{id}', [AdminController::class, 'setujui'])->name('admin.setujui');
        Route::get('/admin/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.tolak');
        
        // 🌟 ACTION ACC KONFIRMASI PENGEMBALIAN BUKU ADMIN
        Route::post('/admin/konfirmasi-kembali/{id}', [AdminController::class, 'konfirmasiKembali'])->name('admin.konfirmasi_kembali');
        
        Route::get('/admin/kembali/{id}', [PeminjamanController::class, 'kembalikan'])->name('admin.kembali');
        
        // 🔥 GENERATE LAPORAN
        Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
        Route::get('/admin/laporan/export', [AdminController::class, 'exportExcel'])->name('laporan.export');
        Route::get('/admin/laporan/export-buku', [AdminController::class, 'exportBuku'])->name('laporan.exportBuku');
    });

    // ================= PETUGAS AREA =================
    Route::middleware('petugas')->group(function () {
        
        // DASHBOARD PETUGAS
        Route::get('/petugas/dashboard', [AdminController::class, 'dashboard'])->name('petugas.dashboard');

        // KELOLA BUKU (CRUD Petugas)
        Route::get('/petugas/buku', [AdminController::class, 'buku'])->name('petugas.buku');
        Route::get('/petugas/buku/tambah', [AdminController::class, 'tambahBuku'])->name('petugas.buku.tambah');
        Route::post('/petugas/buku/simpan', [AdminController::class, 'simpanBuku'])->name('petugas.buku.simpan');
        Route::get('/petugas/buku/edit/{id}', [AdminController::class, 'editBuku'])->name('petugas.buku.edit');
        Route::put('/petugas/buku/update/{id}', [AdminController::class, 'updateBuku'])->name('petugas.buku.update');
        Route::delete('/petugas/buku/hapus/{id}', [AdminController::class, 'hapusBuku'])->name('petugas.buku.hapus');

        // SIRKULASI (Pinjam & Kembali)
        Route::get('/petugas/peminjaman', [AdminController::class, 'index'])->name('petugas.peminjaman');
        Route::get('/petugas/setujui/{id}', [AdminController::class, 'setujui'])->name('petugas.setujui');
        Route::get('/petugas/tolak/{id}', [AdminController::class, 'tolak'])->name('petugas.tolak');
        
        // 🌟 ACTION ACC KONFIRMASI PENGEMBALIAN BUKU PETUGAS
        Route::post('/petugas/konfirmasi-kembali/{id}', [AdminController::class, 'konfirmasiKembali'])->name('petugas.konfirmasi_kembali');

        Route::get('/petugas/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('petugas.kembali');

        // GENERATE LAPORAN
        Route::get('/petugas/laporan', [AdminController::class, 'laporan'])->name('petugas.laporan');
        Route::get('/petugas/laporan/export-buku', [AdminController::class, 'exportBuku'])->name('petugas.exportBuku');
    });

});