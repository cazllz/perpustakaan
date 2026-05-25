@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<style>
    :root {
        --primary: #2c1f17;    /* Deep Cocoa Solid */
        --accent: #d4a373;     /* Silk Gold */
        --bg-app: #f5efe6;     /* Krem Linen */
        --white: #ffffff;
    }

    body {
        background-color: var(--bg-app);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .form-wrapper {
        max-width: 700px;
        margin: 60px auto;
        padding: 0 25px;
    }

    .premium-card {
        background: var(--white);
        padding: 50px;
        border-radius: 45px;
        box-shadow: 0 30px 60px rgba(44, 31, 23, 0.08);
        border: 1px solid rgba(0,0,0,0.02);
        position: relative;
    }

    .form-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .form-header h2 {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -1.5px;
        margin-bottom: 10px;
    }

    .book-summary {
        display: flex;
        align-items: center;
        gap: 25px;
        background: #fdfaf7;
        padding: 25px;
        border-radius: 30px;
        margin-bottom: 40px;
        border: 1px dashed var(--accent);
    }

    .summary-cover {
        width: 100px;
        height: 140px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(44, 31, 23, 0.15);
    }

    .badge-category {
        display: inline-block;
        padding: 6px 14px;
        background: var(--primary);
        color: var(--accent);
        font-size: 10px;
        font-weight: 800;
        border-radius: 10px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .input-group { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }

    .input-group label {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #a89c90;
    }

    .premium-input {
        width: 100%;
        background: #f9f7f5;
        border: 1.5px solid #eee;
        padding: 16px 20px;
        border-radius: 20px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 700;
        color: var(--primary);
        outline: none;
        transition: 0.3s;
    }

    .premium-input:focus {
        border-color: var(--accent);
        background: white;
    }

    .input-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .action-row {
        display: flex;
        gap: 15px;
        margin-top: 35px;
    }

    .btn-action {
        width: 100%;
        padding: 20px;
        border-radius: 22px;
        border: none;
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .btn-submit { background: var(--primary); color: var(--accent); }
    .btn-action:hover { transform: translateY(-4px); }

    .policy-info {
        margin-top: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #8b5e3c;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .oase-popup {
        border-radius: 40px !important;
        padding: 2em !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
</style>

<div class="form-wrapper">
    <div class="premium-card">
        
        <div class="form-header">
            <i class="ri-quill-pen-fill" style="font-size: 40px; color: var(--accent); margin-bottom: 15px; display: block;"></i>
            <h2>Konfirmasi Pinjaman</h2>
            <p>Maksimal durasi peminjaman adalah 7 hari.</p>
        </div>

        <div class="book-summary">
            <img src="{{ asset('storage/' . $book->cover) }}" class="summary-cover" onerror="this.src='https://via.placeholder.com/100x140'">
            <div class="summary-info">
                <span class="badge-category">{{ $book->kategori }}</span>
                <h3 style="margin:0; font-size: 20px; font-weight: 800;">{{ $book->judul }}</h3>
                <p style="margin:5px 0; color: var(--accent); font-weight: 700;">oleh {{ $book->penulis }}</p>
            </div>
        </div>

        <form id="loanForm" method="POST" action="/pinjam/{{ $book->id }}">
            @csrf

            <div class="input-grid">
                <div class="input-group">
                    <label><i class="ri-calendar-line"></i> Tanggal Pinjam</label>
                    <input type="date" id="tgl_pinjam" name="tanggal_pinjam" class="premium-input" required>
                </div>

                <div class="input-group">
                    <label><i class="ri-calendar-check-line"></i> Tanggal Kembali</label>
                    <input type="date" id="tgl_kembali" name="tanggal_kembali" class="premium-input" required>
                </div>
            </div>

            <div class="policy-info">
                <i class="ri-information-line"></i>
                <span>Sistem akan otomatis membatasi durasi maksimal 7 hari.</span>
            </div>

            <div class="action-row">
                <button type="submit" class="btn-action btn-submit">
                    Ajukan Peminjaman <i class="ri-arrow-right-line"></i>
                </button>
            </div>

            <a href="/books/{{ $book->id }}" class="btn-cancel" style="display: block; text-align: center; margin-top: 20px; text-decoration: none; font-size: 12px; font-weight: 700; color: #a89c90;">
                Batalkan dan Kembali
            </a>
        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tglPinjam = document.getElementById('tgl_pinjam');
    const tglKembali = document.getElementById('tgl_kembali');
    const loanForm = document.getElementById('loanForm');

    // CEK STATUS DARI DATABASE (Via Model Laravel)
    const masihPending = {{ \App\Models\Peminjaman::where('user_id', auth()->id())->where('status', 'pending')->exists() ? 'true' : 'false' }};
    const masihPinjam = {{ \App\Models\Peminjaman::where('user_id', auth()->id())->where('status', 'dipinjam')->exists() ? 'true' : 'false' }};
    const currentUserName = "{{ auth()->user()->name }}";

    // Inisialisasi Tanggal
    let today = new Date().toISOString().split('T')[0];
    tglPinjam.setAttribute('min', today);
    tglPinjam.value = today;

    function hitungBatas(startDateStr) {
        let start = new Date(startDateStr);
        let minReturn = new Date(start);
        minReturn.setDate(minReturn.getDate() + 1);
        let maxReturn = new Date(start);
        maxReturn.setDate(maxReturn.getDate() + 7);

        tglKembali.setAttribute('min', minReturn.toISOString().split('T')[0]);
        tglKembali.setAttribute('max', maxReturn.toISOString().split('T')[0]);
        tglKembali.value = maxReturn.toISOString().split('T')[0];
    }

    hitungBatas(today);

    tglPinjam.addEventListener('change', function() {
        hitungBatas(this.value);
    });

    loanForm.addEventListener('submit', function(e) {
        // 1. CEK JIKA MASIH ADA PENGAJUAN PENDING
        if (masihPending) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Mohon Tunggu, ' + currentUserName,
                text: 'Kamu masih memiliki pengajuan yang menunggu persetujuan admin. Selesaikan dulu ya!',
                confirmButtonColor: '#2c1f17',
                customClass: { popup: 'oase-popup' }
            });
            return;
        }

        // 2. CEK JIKA MASIH MEMBAWA BUKU
        if (masihPinjam) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Batas Pinjam Terdeteksi',
                text: 'Kamu masih memiliki buku yang belum dikembalikan. Kembalikan dulu sebelum pinjam lagi!',
                confirmButtonColor: '#2c1f17',
                customClass: { popup: 'oase-popup' }
            });
            return;
        }

        // 3. VALIDASI DURASI TANGGAL
        let start = new Date(tglPinjam.value);
        let end = new Date(tglKembali.value);
        let selisih = (end - start) / (1000 * 60 * 60 * 24);

        if (selisih > 7 || selisih <= 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Tanggal Tidak Valid',
                text: 'Durasi peminjaman minimal 1 hari dan maksimal 7 hari.',
                confirmButtonColor: '#2c1f17',
                customClass: { popup: 'oase-popup' }
            });
            return;
        }

        // 🔥 FORM SUBMIT SECARA ALAMI KE BACKEND
        // Tidak ada SweetAlert sukses buatan di sini. Pop-up sukses murni di-handle tunggal oleh layouts.app setelah refresh halaman.
    });
});
</script>
@endsection