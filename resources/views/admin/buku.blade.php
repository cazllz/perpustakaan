@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

    :root{

        --primary:#261A14;
        --secondary:#38261D;

        --accent:#C89A6A;
        --accent-soft:#E7C6A1;

        --bg:#F6F1EB;
        --white:#ffffff;

        --danger:#E74C3C;
        --success:#42D68B;

        --text-soft:#8A7C72;

        --border-soft:rgba(62,44,35,0.08);

        --spring-curve:cubic-bezier(.34,1.56,.64,1);
        --smooth-curve:cubic-bezier(.16,1,.3,1);
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{

        background:
            radial-gradient(circle at top left, rgba(255,255,255,.8), transparent 28%),
            radial-gradient(circle at bottom right, rgba(212,163,115,.08), transparent 22%),
            linear-gradient(180deg,#F8F4EF 0%, #EFE5D8 100%);
    }

    .content-area{
        padding:0 !important;
    }

    .card-inner{
        background:transparent !important;
        box-shadow:none !important;
        border:none !important;
        padding:0 !important;
    }

    .oase-workspace{

        font-family:'Plus Jakarta Sans', sans-serif;

        max-width:1350px;

        margin:auto;

        padding:32px;

        color:var(--primary);

        animation:fadeIn .7s ease;
    }

    @keyframes fadeIn{

        from{
            opacity:0;
            transform:translateY(16px);
        }

        to{
            opacity:1;
            transform:translateY(0);
        }

    }

    /* =========================
       HERO
    ========================= */

    .hero-panel{

        position:relative;

        overflow:hidden;

        background:
            linear-gradient(
                145deg,
                #231711 0%,
                #38261D 48%,
                #4B3528 100%
            );

        border-radius:40px;

        padding:38px 40px;

        margin-bottom:34px;

        border:1px solid rgba(255,255,255,.05);

        box-shadow:
            0 28px 70px rgba(35,23,17,.22);

        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:25px;
    }

    .hero-panel::before{

        content:'';

        position:absolute;

        width:420px;
        height:420px;

        right:-180px;
        top:-220px;

        border-radius:50%;

        background:
            radial-gradient(
                circle,
                rgba(255,255,255,.06),
                transparent 72%
            );
    }

    .hero-panel::after{

        content:'';

        position:absolute;

        width:260px;
        height:260px;

        left:45%;
        bottom:-160px;

        border-radius:50%;

        background:
            radial-gradient(
                circle,
                rgba(200,154,106,.12),
                transparent 72%
            );
    }

    .hero-left{

        display:flex;
        align-items:center;
        gap:20px;

        z-index:2;
    }

    .hero-icon{

        width:72px;
        height:72px;

        border-radius:26px;

        background:
            linear-gradient(
                145deg,
                rgba(255,255,255,.12),
                rgba(255,255,255,.04)
            );

        border:1px solid rgba(255,255,255,.08);

        display:flex;
        align-items:center;
        justify-content:center;

        backdrop-filter:blur(14px);

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.08),
            0 10px 24px rgba(0,0,0,.18);
    }

    .hero-icon i{

        color:#fff;

        font-size:32px;
    }

    .hero-title{

        font-size:34px;
        font-weight:900;

        color:#fff;

        letter-spacing:-1px;

        margin:0;
    }

    .hero-desc{

        margin-top:7px;

        color:#DFC3A3;

        font-size:14px;
        font-weight:500;

        line-height:1.7;
    }

    /* =========================
       BADGE
    ========================= */

    .hero-badge{

        position:relative;

        z-index:2;

        display:flex;
        align-items:center;
        gap:12px;

        padding:14px 24px 14px 18px;

        background:
            linear-gradient(
                145deg,
                rgba(255,255,255,.13),
                rgba(255,255,255,.04)
            );

        border:1px solid rgba(255,255,255,.08);

        backdrop-filter:blur(16px);

        color:#fff;

        font-size:11px;
        font-weight:800;

        letter-spacing:2px;

        overflow:hidden;

        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.06),
            0 14px 30px rgba(0,0,0,.18);

        border-radius:
            18px 44px 18px 44px /
            44px 18px 44px 18px;

        transition:.45s var(--spring-curve);
    }

    .hero-badge::before{

        content:'';

        position:absolute;

        width:120px;
        height:120px;

        right:-45px;
        top:-55px;

        border-radius:50%;

        background:
            radial-gradient(
                circle,
                rgba(255,255,255,.16),
                transparent 70%
            );
    }

    .hero-badge:hover{

        transform:
            translateY(-4px)
            rotate(-2deg);
    }

    .hero-badge span{

        width:11px;
        height:11px;

        border-radius:50%;

        background:var(--success);

        box-shadow:
            0 0 0 4px rgba(66,214,139,.12),
            0 0 18px rgba(66,214,139,.9);

        animation:livePulse 1.8s infinite;
    }

    @keyframes livePulse{

        0%{
            transform:scale(1);
        }

        50%{
            transform:scale(1.25);
        }

        100%{
            transform:scale(1);
        }

    }

    /* =========================
       STATS
    ========================= */

    .stats-container{

        display:grid;

        grid-template-columns:repeat(3,1fr);

        gap:22px;

        margin-bottom:30px;
    }

    .stat-box{

        position:relative;

        overflow:hidden;

        background:rgba(255,255,255,.78);

        backdrop-filter:blur(18px);

        border-radius:32px;

        padding:28px;

        border:1px solid rgba(255,255,255,.7);

        box-shadow:
            0 18px 50px rgba(44,31,23,.06);

        transition:.4s var(--smooth-curve);
    }

    .stat-box::before{

        content:'';

        position:absolute;

        width:140px;
        height:140px;

        top:-70px;
        right:-60px;

        border-radius:50%;

        background:
            radial-gradient(
                circle,
                rgba(200,154,106,.10),
                transparent 70%
            );
    }

    .stat-box:hover{

        transform:translateY(-7px);

        box-shadow:
            0 28px 60px rgba(44,31,23,.10);
    }

    .stat-flex{

        display:flex;
        align-items:center;
        gap:18px;

        position:relative;
        z-index:2;
    }

    .stat-icon{

        width:62px;
        height:62px;

        border-radius:22px;

        background:
            linear-gradient(
                145deg,
                #2C1F17,
                #4B3528
            );

        display:flex;
        align-items:center;
        justify-content:center;

        color:var(--accent);

        font-size:25px;

        box-shadow:
            0 14px 28px rgba(44,31,23,.18);
    }

    .stat-label{

        font-size:11px;
        font-weight:800;

        letter-spacing:1.8px;

        text-transform:uppercase;

        color:var(--text-soft);

        margin-bottom:5px;
    }

    .stat-value{

        font-size:28px;
        font-weight:900;

        letter-spacing:-1px;

        color:var(--primary);
    }

    .stat-sub{

        margin-top:5px;

        font-size:13px;
        font-weight:700;

        color:var(--text-soft);
    }

    /* =========================
       PANEL
    ========================= */

    .bento-panel{

        background:rgba(255,255,255,.84);

        backdrop-filter:blur(20px);

        border-radius:36px;

        padding:36px;

        border:1px solid rgba(255,255,255,.75);

        box-shadow:
            0 22px 60px rgba(44,31,23,.06);

        margin-bottom:30px;
    }

    .section-head{

        display:flex;
        justify-content:space-between;
        align-items:center;

        gap:20px;

        margin-bottom:28px;

        padding-bottom:20px;

        border-bottom:1px solid rgba(44,31,23,.06);

        flex-wrap:wrap;
    }

    .section-title{

        font-size:20px;
        font-weight:900;

        display:flex;
        align-items:center;
        gap:12px;

        margin:0;
    }

    .section-title i{

        color:var(--accent);

        font-size:24px;
    }

    .section-desc{

        margin-top:6px;

        font-size:13px;
        font-weight:600;

        color:var(--text-soft);
    }

    /* =========================
       SEARCH
    ========================= */

    .search-box{

        position:relative;

        width:100%;
        max-width:340px;
    }

    .search-box i{

        position:absolute;

        top:50%;
        left:18px;

        transform:translateY(-50%);

        color:var(--accent);

        font-size:18px;
    }

    .luxe-input{

        width:100%;

        height:60px;

        border-radius:20px;

        border:1.5px solid #E8DED4;

        background:#FBF8F5;

        padding:0 22px 0 56px;

        font-family:'Plus Jakarta Sans', sans-serif;

        font-size:14px;
        font-weight:700;

        color:var(--primary);

        outline:none;

        transition:.35s;
    }

    .luxe-input:focus{

        background:#fff;

        border-color:var(--accent);

        box-shadow:
            0 12px 30px rgba(212,163,115,.12);
    }

    /* =========================
       BUTTON
    ========================= */

    .btn-action{
    height:60px;
    border:none;
    border-radius:20px;

    background: linear-gradient(145deg, #F6EFE8, #E7C6A1);

    color:#261A14;

    font-family:'Plus Jakarta Sans', sans-serif;
    font-weight:900;
    font-size:12px;
    letter-spacing:1.4px;

    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    transition:.4s var(--spring-curve);

    box-shadow: 0 12px 30px rgba(44,31,23,.10);

    padding:0 26px;

    text-decoration:none;

    border:1px solid rgba(38,26,20,.08);
}
.btn-action:hover{
    transform: translateY(-3px);
    background: linear-gradient(145deg, #E7C6A1, #F6EFE8);
    box-shadow: 0 18px 40px rgba(44,31,23,.18);
}

    .btn-action:hover{

        transform:
            translateY(-4px)
            scale(1.01);

        box-shadow:
            0 24px 46px rgba(44,31,23,.25);
    }

    /* =========================
       TABLE
    ========================= */

    .table-container{
        overflow-x:auto;
    }

    .table-luxe{

        width:100%;

        border-collapse:separate;

        border-spacing:0 14px;
    }

    .table-luxe th{

        font-size:11px;
        font-weight:800;

        letter-spacing:1.7px;

        color:var(--text-soft);

        text-transform:uppercase;

        padding:0 24px 6px;

        text-align:left;
    }

    .table-luxe td{

        background:rgba(255,255,255,.95);

        padding:22px 24px;

        border-top:1px solid rgba(44,31,23,.06);
        border-bottom:1px solid rgba(44,31,23,.06);

        font-size:14px;
        font-weight:700;

        transition:.3s;

        vertical-align:middle;
    }

    .table-luxe tr td:first-child{

        border-left:5px solid var(--primary);

        border-radius:20px 0 0 20px;

        background:#FCF8F4;
    }

    .table-luxe tr td:last-child{

        border-radius:0 20px 20px 0;

        border-right:1px solid rgba(44,31,23,.06);
    }

    .table-luxe tr:hover td{

        background:#FFFDFC;

        border-color:rgba(212,163,115,.22);

        transform:scale(1.003);
    }

    /* =========================
       BOOK ITEM
    ========================= */

    .book-item{
        display:flex;
        align-items:center;
        gap:18px;
    }

    .book-cover{

        width:68px;
        height:92px;

        border-radius:18px;

        overflow:hidden;

        flex-shrink:0;

        position:relative;

        border:1px solid rgba(44,31,23,.08);

        background:#fff;

        box-shadow:
            0 12px 28px rgba(44,31,23,.12);

        transition:.45s var(--smooth-curve);
    }

    .book-cover img{

        width:100%;
        height:100%;

        object-fit:cover;
    }

    .kat-row:hover .book-cover{

        transform:
            rotate(-4deg)
            scale(1.06);

        box-shadow:
            0 18px 34px rgba(44,31,23,.18);
    }

    .book-title{

        font-size:15px;
        font-weight:900;

        color:var(--primary);

        line-height:1.5;
    }

    .book-sub{

        margin-top:5px;

        font-size:12px;
        font-weight:700;

        color:var(--text-soft);
    }

    .book-sub span{
        color:var(--accent);
    }

    /* =========================
       STOCK BADGE
    ========================= */

    .badge-stock{

        display:inline-flex;
        align-items:center;
        gap:8px;

        padding:10px 16px;

        border-radius:16px;

        font-size:11px;
        font-weight:800;

        letter-spacing:.5px;
    }

    .badge-safe{

        background:#EFFAF3;

        color:#31A866;

        border:1px solid rgba(49,168,102,.12);
    }

    .badge-warning{

        background:#FFF4F1;

        color:#D86C56;

        border:1px solid rgba(216,108,86,.12);
    }

    /* =========================
       ACTION BUTTON
    ========================= */

    .btn-icon-control{

        width:44px;
        height:44px;

        border-radius:16px;

        border:none;

        display:inline-flex;
        align-items:center;
        justify-content:center;

        cursor:pointer;

        transition:.35s var(--spring-curve);

        font-size:17px;
    }

    .btn-edit-luxe{

        background:#F6EFE8;

        color:var(--primary);
    }

    .btn-delete-luxe{

        background:#FFF1EF;

        color:#C0392B;
    }

    .btn-edit-luxe:hover{

        background:var(--primary);

        color:#fff;

        transform:
            rotate(-5deg)
            scale(1.08);
    }

    .btn-delete-luxe:hover{

        background:var(--danger);

        color:#fff;

        transform:
            rotate(5deg)
            scale(1.08);
    }

    .oase-popup{

        border-radius:28px !important;

        font-family:'Plus Jakarta Sans', sans-serif !important;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width:991px){

        .stats-container{
            grid-template-columns:1fr;
        }

        .hero-panel{
            padding:30px;
        }

        .hero-title{
            font-size:28px;
        }

        .bento-panel{
            padding:28px 24px;
        }

        .oase-workspace{
            padding:18px;
        }

    }

</style>

<div class="oase-workspace">

    <!-- HERO -->
    <div class="hero-panel">

        <div class="hero-left">

            <div class="hero-icon">
                <i class="ri-book-read-line"></i>
            </div>

            <div>

                <h1 class="hero-title">
                    Galeri Koleksi
                </h1>

                <div class="hero-desc">
                    Manajemen bahan pustaka dan inventaris buku digital Oase Sastra.
                </div>

            </div>

        </div>

        <div class="hero-badge">
            <span></span>
            LIBRARY ACTIVE
        </div>

    </div>

    <!-- STATS -->
    <div class="stats-container">

        <div class="stat-box">

            <div class="stat-flex">

                <div class="stat-icon">
                    <i class="ri-book-3-fill"></i>
                </div>

                <div>

                    <div class="stat-label">
                        Total Koleksi
                    </div>

                    <div class="stat-value">
                        {{ count($books) }}
                    </div>

                    <div class="stat-sub">
                        Judul buku aktif
                    </div>

                </div>

            </div>

        </div>

        <div class="stat-box">

            <div class="stat-flex">

                <div class="stat-icon">
                    <i class="ri-stack-fill"></i>
                </div>

                <div>

                    <div class="stat-label">
                        Total Stok
                    </div>

                    <div class="stat-value">
                        {{ $books->sum('stok') }}
                    </div>

                    <div class="stat-sub">
                        Eksemplar tersedia
                    </div>

                </div>

            </div>

        </div>

        <div class="stat-box">

            <div class="stat-flex">

                <div class="stat-icon">
                    <i class="ri-shield-check-fill"></i>
                </div>

                <div>

                    <div class="stat-label">
                        Status Sistem
                    </div>

                    <div class="stat-value" style="font-size:18px;">
                        Stabil
                    </div>

                    <div class="stat-sub" style="color:var(--success);">
                        ● Database tersinkron
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE PANEL -->
    <main class="bento-panel">

        <div class="section-head">

            <div>

                <h3 class="section-title">

                    <i class="ri-layout-grid-fill"></i>

                    Daftar Koleksi Buku

                </h3>

                <div class="section-desc">
                    Struktur data pustaka aktif yang tersimpan dalam sistem.
                </div>

            </div>

           <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap; width:100%;">

                <div class="search-box">

                    <i class="ri-search-line"></i>

                    <input
                        type="text"
                        id="searchInput"
                        class="luxe-input"
                        placeholder="Cari koleksi buku..."
                    >

                </div>

                <a href="{{ route('admin.buku.tambah') }}" class="btn-action">

                    <i class="ri-add-circle-fill"></i>

                    TAMBAH BUKU

                </a>

            </div>

        </div>

        <div class="table-container">

            <table class="table-luxe" id="booksTable">

                <thead>

                    <tr>

                        <th width="420">
                            Informasi Buku
                        </th>

                        <th>
                            Penulis
                        </th>

                        <th>
                            Status Stok
                        </th>

                        <th>
                            Penerbit
                        </th>

                        <th style="text-align:right; padding-right:24px;">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($books as $b)

                    <tr class="kat-row">

                        <td>

                            <div class="book-item">

                                <div class="book-cover">

                                    <img
                                        src="{{ asset('storage/'.$b->cover) }}"
                                        onerror="this.src='https://via.placeholder.com/150x220?text=No+Cover'"
                                    >

                                </div>

                                <div>

                                    <div class="book-title">
                                        {{ $b->judul }}
                                    </div>

                            <div class="book-sub">
    REF #{{ str_pad($b->id,4,'0',STR_PAD_LEFT) }}
    •

    <span>
        {{ $b->kategori->nama_kategori ?? 'Tanpa Kategori' }}
    </span>
</div>

                                </div>

                            </div>

                        </td>

                        <td style="color:#6B5E55;">
                            {{ $b->penulis }}
                        </td>

                        <td>

                            @if($b->stok <= 2)

                                <span class="badge-stock badge-warning">

                                    <i class="ri-error-warning-line"></i>

                                    Sisa {{ $b->stok }} Unit

                                </span>

                            @else

                                <span class="badge-stock badge-safe">

                                    <i class="ri-checkbox-circle-line"></i>

                                    {{ $b->stok }} Unit Tersedia

                                </span>

                            @endif

                        </td>

                        <td>

                            <div style="font-weight:800;">
                                {{ $b->penerbit }}
                            </div>

                            <div class="book-sub">
                                Tahun {{ $b->tahun }}
                            </div>

                        </td>

                        <td>

                            <div style="display:flex; justify-content:flex-end; gap:10px;">

                                <a
                                    href="{{ route('admin.buku.edit', $b->id) }}"
                                    class="btn-icon-control btn-edit-luxe"
                                    title="Edit"
                                >
                                    <i class="ri-pencil-line"></i>
                                </a>

                                <form
                                    action="{{ route('admin.buku.hapus', $b->id) }}"
                                    method="POST"
                                    id="delete-form-{{ $b->id }}"
                                    style="margin:0;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        onclick="confirmDelete('{{ $b->id }}', '{{ $b->judul }}')"
                                        class="btn-icon-control btn-delete-luxe"
                                        title="Hapus"
                                    >
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" align="center" style="padding:80px 0; color:#A89C90;">

                            <i class="ri-inbox-archive-line" style="font-size:52px; display:block; margin-bottom:14px; color:var(--accent); opacity:.5;"></i>

                            Belum ada data buku tersimpan di dalam sistem.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

<script>

    // SEARCH FILTER
    document.getElementById('searchInput').addEventListener('keyup', function () {

        let filter = this.value.toLowerCase();

        document.querySelectorAll('.kat-row').forEach(row => {

            row.style.display = row.innerText.toLowerCase().includes(filter)
                ? ''
                : 'none';

        });

    });

    // DELETE ALERT
    function confirmDelete(id, title) {

        Swal.fire({

            title: 'Hapus Buku?',
            text: `Buku "${title}" akan dihapus permanen dari sistem.`,
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#E74C3C',
            cancelButtonColor: '#2C1F17',

            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',

            customClass: {
                popup: 'oase-popup'
            }

        }).then((result) => {

            if (result.isConfirmed) {

                document
                    .getElementById('delete-form-' + id)
                    .submit();

            }

        });

    }

    // SUCCESS ALERT
    @if(session('success'))

        Swal.fire({

            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',

            confirmButtonColor: '#2C1F17',

            customClass: {
                popup: 'oase-popup'
            }

        });

    @endif

</script>

@endsection