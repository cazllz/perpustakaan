@extends('layouts.admin')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>

    :root {
        --primary: #261A14;
        --secondary: #38261D;
        --accent: #C89A6A;
        --accent-soft: #E7C6A1;
        --bg: #F6F1EB;
        --white: #ffffff;
        --danger: #E74C3C;
        --success: #42D68B;
        --text-soft: #8A7C72;
        --border-soft: rgba(62,44,35,0.08);
        --spring-curve: cubic-bezier(.34,1.56,.64,1);
        --smooth-curve: cubic-bezier(.16,1,.3,1);
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
       BADGE CUSTOM PREMIUM
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
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.06),
            0 18px 42px rgba(0,0,0,.24);
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
        0%{ transform:scale(1); }
        50%{ transform:scale(1.25); }
        100%{ transform:scale(1); }
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

    .mini-chip{
        padding:10px 16px;
        border-radius:16px;
        background:#F8F2EC;
        border:1px solid rgba(44,31,23,.05);
        color:#9B7D61;
        font-size:10px;
        font-weight:800;
        letter-spacing:1.5px;
    }

    /* =========================
       FORM
    ========================= */
    .form-grid-layout{
        display:grid;
        grid-template-columns:1fr 240px;
        gap:24px;
        align-items:end;
    }

    .luxe-label{
        font-size:11px;
        font-weight:800;
        letter-spacing:1.5px;
        text-transform:uppercase;
        color:var(--text-soft);
        margin-bottom:10px;
        display:block;
    }

    .luxe-input-wrapper{
        position:relative;
    }

    .luxe-input-wrapper i{
        position:absolute;
        top:50%;
        left:20px;
        transform:translateY(-50%);
        color:var(--accent);
        font-size:18px;
        transition:.3s;
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

    .luxe-input-wrapper:focus-within i{
        color:var(--primary);
    }

    .btn-action{
        height:60px;
        border:none;
        border-radius:20px;
        background:
            linear-gradient(
                145deg,
                #2C1F17,
                #4A3327
            );
        color:#fff;
        font-family:'Plus Jakarta Sans', sans-serif;
        font-weight:800;
        font-size:12px;
        letter-spacing:1.4px;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        transition:.4s var(--spring-curve);
        box-shadow:
            0 18px 36px rgba(44,31,23,.18);
    }

    .btn-action:hover{
        transform:
            translateY(-4px)
            scale(1.01);
        box-shadow:
            0 24px 46px rgba(44,31,23,.25);
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
        color:var(--accent);
        font-family:monospace;
        font-size:13px;
        font-weight:900;
        text-align:center;
    }

    .table-luxe tr td:last-child{
        border-radius:0 20px 20px 0;
        text-align:right;
        border-right:1px solid rgba(44,31,23,.06);
    }

    .table-luxe tr:hover td{
        background:#FFFDFC;
        border-color:rgba(212,163,115,.22);
        transform:scale(1.003);
    }

    .kat-name{
        text-transform:uppercase;
        letter-spacing:.5px;
        color:var(--primary);
    }

    /* =========================
       BUTTON ACTION
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

    /* =========================
       MODAL POP-UP BLADE EDIT
    ========================= */
    #editModal{
        position:fixed;
        inset:0;
        background:rgba(25,18,14,.45);
        backdrop-filter:blur(12px);
        display:none;
        justify-content:center;
        align-items:center;
        z-index:999;
        padding:20px;
    }

    .modal-box{
        width:100%;
        max-width:470px;
    }

    .modal-actions{
        display:flex;
        gap:12px;
        margin-top:20px;
    }

    .btn-cancel{
        flex:1;
        height:60px;
        border:none;
        border-radius:20px;
        background:#F4F0EC;
        color:var(--text-soft);
        font-weight:800;
        font-family:'Plus Jakarta Sans', sans-serif;
        font-size:12px;
        letter-spacing:1.4px;
        cursor:pointer;
        transition:.3s;
    }
    .btn-cancel:hover{
        background:#EAE3DB;
        color:var(--primary);
    }

    /* =========================
       SWEETALERT CUSTOM
    ========================= */
    .swal-custom-title {
        color: #211916 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 26px !important;
        padding-top: 10px !important;
    }
    .swal-custom-text {
        color: #211916 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px !important;
        opacity: 0.85;
        margin-top: 8px !important;
    }
    .swal2-actions {
        gap: 15px !important;
    }

    @media (max-width:991px){
        .stats-container{ grid-template-columns:1fr; }
        .form-grid-layout{ grid-template-columns:1fr; }
        .hero-panel{ padding:30px; }
        .hero-title{ font-size:28px; }
        .bento-panel{ padding:28px 24px; }
        .oase-workspace{ padding:18px; }
    }
</style>

<div class="oase-workspace">

    <div class="hero-panel">
        <div class="hero-left">
            <div class="hero-icon">
                <i class="ri-book-3-line"></i>
            </div>
            <div>
                <h1 class="hero-title">Pusat Kategori</h1>
                <div class="hero-desc">
                    Manajemen dan tata klasifikasi koleksi digital Oase Sastra.
                </div>
            </div>
        </div>
        <div class="hero-badge">
            <span></span>
            SYSTEM ONLINE
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-box">
            <div class="stat-flex">
                <div class="stat-icon">
                    <i class="ri-folder-chart-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Total Kategori</div>
                    <div class="stat-value">{{ count($kategoris) }}</div>
                    <div class="stat-sub">Klasifikasi aktif</div>
                </div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-flex">
                <div class="stat-icon">
                    <i class="ri-radar-line"></i>
                </div>
                <div>
                    <div class="stat-label">Status Sistem</div>
                    <div class="stat-value" style="font-size:18px;">Sinkronisasi</div>
                    <div class="stat-sub" style="color: var(--success);">
                        ● Engine berjalan normal
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-flex">
                <div class="stat-icon">
                    <i class="ri-shield-user-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Hak Akses</div>
                    <div class="stat-value" style="font-size:18px;">Administrator</div>
                    <div class="stat-sub">Kontrol penuh sistem</div>
                </div>
            </div>
        </div>
    </div>

    <aside class="bento-panel">
        <div class="section-head">
            <div>
                <h3 class="section-title">
                    <i class="ri-add-circle-fill"></i>
                    Tambah Kategori Baru
                </h3>
                <div class="section-desc">
                    Tambahkan klasifikasi baru ke dalam sistem perpustakaan.
                </div>
            </div>
            <div class="mini-chip">AUTO GENERATED ID</div>
        </div>

        <form action="/admin/kategori" method="POST" class="form-grid-layout">
            @csrf
            <div>
                <label class="luxe-label">Nama Kategori</label>
                <div class="luxe-input-wrapper">
                    <i class="ri-price-tag-3-line"></i>
                    <input
                        type="text"
                        name="nama_kategori"
                        class="luxe-input"
                        placeholder="Contoh: Sastra, Komik, Biografi"
                        required
                        autocomplete="off"
                    >
                </div>
            </div>
            <button type="submit" class="btn-action">
                <i class="ri-save-3-fill"></i>
                SIMPAN DATA
            </button>
        </form>
    </aside>

    <main class="bento-panel">
        <div class="section-head">
            <div>
                <h3 class="section-title">
                    <i class="ri-layout-grid-fill"></i>
                    Daftar Kategori
                </h3>
                <div class="section-desc">
                    Struktur kategori aktif yang digunakan dalam sistem.
                </div>
            </div>
            <div class="search-box">
                <i class="ri-search-line"></i>
                <input
                    type="text"
                    id="searchInput"
                    class="luxe-input"
                    placeholder="Cari kategori..."
                    style="padding-left:50px;"
                >
            </div>
        </div>

        <div class="table-container">
            <table class="table-luxe" id="kategoriTable">
                <thead>
                    <tr>
                        <th width="110">ID REF</th>
                        <th>Nama Kategori</th>
                        <th style="text-align:right; padding-right:24px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $k)
                    <tr class="kat-row">
                        <td>#{{ sprintf('%03d', $k->id) }}</td>
                        <td class="kat-name">{{ $k->nama_kategori }}</td>
                        <td>
                            <div style="display:flex; justify-content:flex-end; gap:10px;">
                                <button
                                    onclick="openEditModal({{ $k->id }}, '{{ $k->nama_kategori }}')"
                                    class="btn-icon-control btn-edit-luxe"
                                    title="Edit"
                                >
                                    <i class="ri-pencil-line"></i>
                                </button>

                                <form
                                    id="delete-form-{{ $k->id }}"
                                    action="/admin/kategori/{{ $k->id }}"
                                    method="POST"
                                    style="margin:0;"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        onclick="confirmDelete('{{ $k->id }}', '{{ $k->nama_kategori }}')"
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
                        <td colspan="3" align="center" style="padding:80px 0; color:#A89C90;">
                            <i class="ri-inbox-archive-line" style="font-size:52px; display:block; margin-bottom:14px; color:var(--accent); opacity:.5;"></i>
                            Belum ada kategori tersimpan di dalam sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>

<div id="editModal">
    <div class="bento-panel modal-box">
        <div class="section-head" style="margin-bottom:20px; padding-bottom:15px;">
            <div>
                <h3 class="section-title"><i class="ri-edit-box-fill"></i> Perbarui Kategori</h3>
                <div class="section-desc">Ubah nama klasifikasi klasifikasi buku pilihanmu.</div>
            </div>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div style="margin-bottom:15px;">
                <label class="luxe-label">Nama Kategori Baru</label>
                <div class="luxe-input-wrapper">
                    <i class="ri-price-tag-3-line"></i>
                    <input type="text" id="edit_nama_kategori" name="nama_kategori" class="luxe-input" required autocomplete="off">
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" onclick="closeEditModal()" class="btn-cancel">BATALKAN</button>
                <button type="submit" class="btn-action" style="flex:1.3;"><i class="ri-checkbox-circle-fill"></i> SIMPAN</button>
            </div>
        </form>
    </div>
</div>

<script>
    // 1. Logic Modal Edit Kategori
    function openEditModal(id, currentFormName) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const input = document.getElementById('edit_nama_kategori');
        
        form.action = '/admin/kategori/' + id; // Mengarahkan form action ke route ID kategori
        input.value = currentFormName; // Mengisi text input dengan nama kategori saat ini
        modal.style.display = 'flex'; // Tampilkan modal edit
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Menutup modal otomatis jika area luar kotak modal diklik
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // 2. Logic SweetAlert Hapus Kategori (Sesuai Referensi Gambar Minimalis Lingkaran Cokelat)
    function confirmDelete(id, categoryName) {
        Swal.fire({
            html: `
                <div style="font-size: 64px; color: #C68352; margin-bottom: 15px;">
                    <i class="ri-error-warning-line"></i>
                </div>
                <div class="swal-custom-title">Hapus Kategori?</div>
                <div class="swal-custom-text">Kategori "${categoryName}" beserta relasi bukunya akan terhapus permanen.</div>
            `,
            background: '#ffffff',
            showCancelButton: true,
            confirmButtonColor: '#C64333', // Merah bata presisi
            cancelButtonColor: '#211916',  // Hitam pekat presisi
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // 3. Logic Realtime Filter Live Search Table Kategori
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        let rows = document.querySelectorAll('#kategoriTable tbody tr.kat-row');
        
        rows.forEach(row => {
            let categoryText = row.querySelector('.kat-name').innerText.toLowerCase();
            if(categoryText.includes(val)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection