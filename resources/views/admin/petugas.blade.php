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

        max-width:1400px;

        margin:auto;

        padding:32px;

        color:var(--primary);

        animation:fadeIn .7s ease;
    }

    @keyframes fadeIn{

        from{
            opacity:0;
            transform:translateY(18px);
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
       GRID PANEL
    ========================= */

    .grid-layout{

        display:grid;

        grid-template-columns:380px 1fr;

        gap:28px;

        align-items:start;
    }

    .bento-panel{

        background:rgba(255,255,255,.84);

        backdrop-filter:blur(20px);

        border-radius:36px;

        padding:36px;

        border:1px solid rgba(255,255,255,.75);

        box-shadow:
            0 22px 60px rgba(44,31,23,.06);
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
        margin-bottom:22px;
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

    .toggle-password{

        position:absolute !important;

        right:22px;
        left:auto !important;

        cursor:pointer;
    }

    .info-box{

        background:#FBF5EF;

        border:1px solid rgba(200,154,106,.18);

        border-radius:24px;

        padding:22px;

        margin-top:5px;
        margin-bottom:26px;
    }

    .info-box p:first-child{

        font-size:11px;
        font-weight:900;

        letter-spacing:1.2px;

        color:var(--primary);

        display:flex;
        align-items:center;
        gap:10px;
    }

    .info-box p:last-child{

        margin-top:10px;

        font-size:12px;
        line-height:1.8;

        color:var(--text-soft);

        font-weight:600;
    }

    .btn-action{

        width:100%;

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

    .user-profile{

        display:flex;
        align-items:center;
        gap:18px;
    }

    .user-avatar{

        width:58px;
        height:58px;

        border-radius:20px;

        background:
            linear-gradient(
                145deg,
                #2C1F17,
                #4A3327
            );

        display:flex;
        align-items:center;
        justify-content:center;

        color:var(--accent);

        font-size:20px;
        font-weight:900;

        box-shadow:
            0 12px 28px rgba(44,31,23,.16);

        flex-shrink:0;
    }

    .user-name{

        font-size:15px;
        font-weight:900;

        color:var(--primary);
    }

    .sub-data{

        margin-top:5px;

        font-size:11px;
        font-weight:700;

        color:var(--text-soft);
    }

    .role-tag{

        display:inline-flex;
        align-items:center;
        gap:8px;

        padding:10px 16px;

        border-radius:14px;

        background:#F5FBF7;

        color:#34A96A;

        border:1px solid rgba(66,214,139,.18);

        font-size:10px;
        font-weight:900;

        letter-spacing:1px;
    }

    .role-tag span{

        width:7px;
        height:7px;

        border-radius:50%;

        background:#42D68B;
    }

    .btn-icon{

        width:46px;
        height:46px;

        border:none;

        border-radius:16px;

        display:inline-flex;
        align-items:center;
        justify-content:center;

        cursor:pointer;

        transition:.35s var(--spring-curve);

        font-size:18px;
    }

    .btn-delete{

        background:#FFF1EF;

        color:#C0392B;
    }

    .btn-delete:hover{

        background:var(--danger);

        color:#fff;

        transform:
            rotate(5deg)
            scale(1.08);
    }

    .empty-state{

        padding:100px 0 !important;

        text-align:center;

        color:var(--text-soft);
    }

    .empty-state i{

        font-size:54px;

        display:block;

        margin-bottom:14px;

        color:var(--accent);

        opacity:.45;
    }

    .oase-popup{

        border-radius:28px !important;

        font-family:'Plus Jakarta Sans', sans-serif !important;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width:1100px){

        .grid-layout{
            grid-template-columns:1fr;
        }

        .stats-container{
            grid-template-columns:1fr;
        }
    }

    @media (max-width:768px){

        .oase-workspace{
            padding:18px;
        }

        .hero-panel{
            padding:28px;
        }

        .hero-title{
            font-size:28px;
        }

        .bento-panel{
            padding:28px 22px;
        }
    }

</style>

<div class="oase-workspace">

    <!-- HERO -->
    <div class="hero-panel">

        <div class="hero-left">

            <div class="hero-icon">
                <i class="ri-team-fill"></i>
            </div>

            <div>

                <h1 class="hero-title">
                    Kelola Petugas
                </h1>

                <div class="hero-desc">
                    Manajemen akses, kontrol personel, dan pengaturan akun internal Oase Sastra.
                </div>

            </div>

        </div>

        <div class="hero-badge">
            <span></span>
            SYSTEM ONLINE
        </div>

    </div>

    <!-- STATS -->
    <div class="stats-container">

        <div class="stat-box">

            <div class="stat-flex">

                <div class="stat-icon">
                    <i class="ri-user-star-fill"></i>
                </div>

                <div>

                    <div class="stat-label">
                        Petugas Aktif
                    </div>

                    <div class="stat-value">
                        {{ $petugas->where('role', 'petugas')->count() }}
                    </div>

                    <div class="stat-sub">
                        Personel sistem aktif
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
                        Keamanan Sistem
                    </div>

                    <div class="stat-value" style="font-size:18px;">
                        Sinkronisasi
                    </div>

                    <div class="stat-sub" style="color:var(--success);">
                        ● Database aman & stabil
                    </div>

                </div>

            </div>

        </div>

        <div class="stat-box">

            <div class="stat-flex">

                <div class="stat-icon">
                    <i class="ri-settings-5-fill"></i>
                </div>

                <div>

                    <div class="stat-label">
                        Hak Akses
                    </div>

                    <div class="stat-value" style="font-size:18px;">
                        Administrator
                    </div>

                    <div class="stat-sub">
                        Kontrol penuh sistem
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- GRID -->
    <div class="grid-layout">

        <!-- FORM -->
        <aside class="bento-panel">

            <div class="section-head">

                <div>

                    <h3 class="section-title">
                        <i class="ri-user-add-fill"></i>
                        Tambah Petugas
                    </h3>

                    <div class="section-desc">
                        Tambahkan akun personel baru ke sistem perpustakaan.
                    </div>

                </div>

                <div class="mini-chip">
                    ACCESS CONTROL
                </div>

            </div>

            <form action="/admin/petugas" method="POST">

                @csrf

                <label class="luxe-label">
                    Nama Lengkap
                </label>

                <div class="luxe-input-wrapper">

                    <i class="ri-user-3-line"></i>

                    <input
                        type="text"
                        name="name"
                        class="luxe-input"
                        placeholder="Masukkan nama lengkap"
                        required
                        autocomplete="off"
                    >

                </div>

                <label class="luxe-label">
                    Alamat Email
                </label>

                <div class="luxe-input-wrapper">

                    <i class="ri-mail-line"></i>

                    <input
                        type="email"
                        name="email"
                        class="luxe-input"
                        placeholder="contoh@oasesastra.com"
                        required
                        autocomplete="off"
                    >

                </div>

                <label class="luxe-label">
                    Kata Sandi
                </label>

                <div class="luxe-input-wrapper">

                    <i class="ri-lock-2-line"></i>

                    <input
                        type="password"
                        name="password"
                        id="passInput"
                        class="luxe-input"
                        placeholder="Minimal 8 karakter"
                        required
                    >

                    <i class="ri-eye-off-line toggle-password" id="togglePass"></i>

                </div>

                <input type="hidden" name="role" value="petugas">

                <div class="info-box">

                    <p>
                        <i class="ri-information-fill"></i>
                        INFORMASI AKSES
                    </p>

                    <p>
                        Akun petugas memiliki akses untuk mengelola data buku,
                        transaksi peminjaman, dan operasional sirkulasi perpustakaan.
                    </p>

                </div>

                <button type="submit" class="btn-action">

                    <i class="ri-save-3-fill"></i>

                    SIMPAN DATA PETUGAS

                </button>

            </form>

        </aside>

        <!-- TABLE -->
        <main class="bento-panel">

            <div class="section-head">

                <div>

                    <h3 class="section-title">

                        <i class="ri-team-fill"></i>

                        Daftar Personel

                    </h3>

                    <div class="section-desc">
                        Seluruh akun petugas yang terdaftar pada sistem perpustakaan.
                    </div>

                </div>

                <div class="mini-chip">
                    {{ date('d M Y') }}
                </div>

            </div>

            <div class="table-container">

                <table class="table-luxe">

                    <thead>

                        <tr>

                            <th>
                                Identitas
                            </th>

                            <th>
                                Status
                            </th>

                            <th style="text-align:right;">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($petugas->where('role', 'petugas') as $p)

                        <tr>

                            <td>

                                <div class="user-profile">

                                    <div class="user-avatar">
                                        {{ strtoupper(substr($p->name,0,1)) }}
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            {{ $p->name }}
                                        </div>

                                        <div class="sub-data">
                                            ID PETUGAS:
                                            #{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>

                                        <div class="sub-data">
                                            {{ $p->email }}
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="role-tag">

                                    <span></span>

                                    AKTIF

                                </span>

                                <div class="sub-data" style="margin-top:10px;">
                                    Bergabung:
                                    {{ $p->created_at->format('d/m/Y') }}
                                </div>

                            </td>

                            <td align="right">

                                <button
                                    type="button"
                                    onclick="confirmDelete('{{ $p->id }}', '{{ $p->name }}')"
                                    class="btn-icon btn-delete"
                                    title="Hapus"
                                >
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>

                                <form
                                    id="delete-form-{{ $p->id }}"
                                    action="/admin/petugas/{{ $p->id }}"
                                    method="POST"
                                    style="display:none;"
                                >

                                    @csrf
                                    @method('DELETE')

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="empty-state">

                                <i class="ri-user-unfollow-line"></i>

                                Belum ada petugas terdaftar di sistem.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </main>

    </div>

</div>

<script>

    document.addEventListener("DOMContentLoaded", function(){

        @if(session('success'))

            Swal.fire({
                title:'Berhasil!',
                text:"{{ session('success') }}",
                icon:'success',
                confirmButtonColor:'#2C1F17',
                customClass:{
                    popup:'oase-popup'
                }
            });

        @endif

        const togglePass = document.querySelector('#togglePass');
        const passwordInput = document.querySelector('#passInput');

        if(togglePass && passwordInput){

            togglePass.addEventListener('click', function(){

                const isPassword = passwordInput.getAttribute('type') === 'password';

                passwordInput.setAttribute(
                    'type',
                    isPassword ? 'text' : 'password'
                );

                this.classList.toggle('ri-eye-line', isPassword);
                this.classList.toggle('ri-eye-off-line', !isPassword);

            });

        }

    });

    function confirmDelete(id, name){

        Swal.fire({

            title:'Hapus Petugas?',
            text:`Akses "${name}" akan dihapus permanen dari sistem.`,
            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#C0392B',
            cancelButtonColor:'#2C1F17',

            confirmButtonText:'Ya, Hapus',
            cancelButtonText:'Batalkan',

            customClass:{
                popup:'oase-popup'
            }

        }).then((result)=>{

            if(result.isConfirmed){

                document.getElementById('delete-form-' + id).submit();

            }

        });

    }

</script>

@endsection