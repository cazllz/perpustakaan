@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&family=Playfair+Display:ital,wght=0,600;0,700;1,600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --primary: #241912;
        --primary-soft: #3A2A21;
        --accent: #D4A373;
        --accent-soft: #E7C6A5;
        --bg: #F7F2EC;
        --white: #ffffff;
        --warning: #F39C12;
        --danger: #E74C3C;
        --success: #27AE60;
        --surface-marmer: rgba(255,255,255,0.72);
        --border-soft: rgba(62, 44, 35, 0.07);
    }

    *{
        box-sizing:border-box;
    }

    html{
        scroll-behavior:smooth;
    }

    body {
        background:
            radial-gradient(circle at top left, rgba(212,163,115,0.12), transparent 35%),
            radial-gradient(circle at bottom right, rgba(44,31,23,0.08), transparent 30%),
            var(--bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--primary);
        -webkit-font-smoothing: antialiased;
        overflow-x:hidden;
    }

    .app-viewport {
        max-width: 1100px;
        margin: 45px auto 120px;
        padding: 0 24px 120px;
    }

    /* =========================
       HERO
    ========================= */

    .profile-hero {
        background: var(--surface-marmer);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 42px;
        padding: 52px;
        display: flex;
        flex-direction: column;
        gap: 38px;
        color: var(--primary);
        margin-bottom: 55px;
        position: relative;
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow:
            0 30px 60px rgba(44, 31, 23, 0.05),
            0 10px 30px rgba(212, 163, 115, 0.08);
        overflow:hidden;
    }

    .profile-hero::before{
        content:'';
        position:absolute;
        width:320px;
        height:320px;
        background: radial-gradient(circle, rgba(212,163,115,0.20), transparent 70%);
        top:-120px;
        right:-120px;
        border-radius:50%;
        pointer-events:none;
    }

    .profile-hero::after{
        content:'';
        position:absolute;
        width:220px;
        height:220px;
        background: radial-gradient(circle, rgba(44,31,23,0.08), transparent 70%);
        bottom:-80px;
        left:-80px;
        border-radius:50%;
        pointer-events:none;
    }

    .hero-main-identity {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        gap:20px;
        position:relative;
        z-index:2;
    }

    .avatar-box {
        width: 90px;
        height: 90px;
        background:
            linear-gradient(145deg,#3E2C23 0%, #1E140F 100%);
        color: var(--accent);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        font-weight: 800;
        box-shadow:
            0 18px 35px rgba(44,31,23,0.22),
            inset 0 1px 0 rgba(255,255,255,0.12);
        position:relative;
    }

    .avatar-box::before{
        content:'';
        position:absolute;
        inset:1px;
        border-radius:29px;
        border:1px solid rgba(255,255,255,0.06);
    }

    .badge-user-status {
        background: rgba(212, 163, 115, 0.14);
        color: #B58255;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        border:1px solid rgba(212,163,115,0.18);
        backdrop-filter: blur(10px);
    }

    .btn-edit-luxe {
        background: rgba(255,255,255,0.72);
        border: 1px solid rgba(255,255,255,0.8);
        color: var(--primary);
        padding: 16px 24px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.35s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        backdrop-filter: blur(12px);
    }

    .btn-edit-luxe:hover {
        transform: translateY(-3px);
        border-color: rgba(212,163,115,0.4);
        background:white;
        box-shadow: 0 18px 35px rgba(44,31,23,0.08);
    }

    .profile-bento-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        width: 100%;
        border-top: 1px solid rgba(44,31,23,0.05);
        padding-top: 35px;
        position:relative;
        z-index:2;
    }

    .stat-bento-item {
        background: rgba(255,255,255,0.78);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.8);
        box-shadow: 0 14px 35px rgba(44, 31, 23, 0.04);
        padding: 24px;
        border-radius: 28px;
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        position:relative;
        overflow:hidden;
    }

    .stat-bento-item::before{
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(135deg, rgba(212,163,115,0.08), transparent 50%);
        opacity:0;
        transition:.4s;
    }

    .stat-bento-item:hover::before{
        opacity:1;
    }

    .stat-bento-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 28px 50px rgba(44,31,23,0.08);
    }

    .stat-bento-icon {
        width: 54px;
        height: 54px;
        background: linear-gradient(145deg,#FAF7F4,#ffffff);
        color: var(--primary);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 1px solid rgba(44,31,23,0.05);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
        flex-shrink:0;
    }

    /* =========================
       SECTION TITLE
    ========================= */

    .section-label {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 28px;
        margin-top: 60px;
        display: flex;
        align-items: center;
        gap: 14px;
        letter-spacing: -0.7px;
    }

    /* =========================
       CARD
    ========================= */

    .loan-status-card {
        background: rgba(255,255,255,0.75);
        backdrop-filter: blur(18px);
        border-radius: 34px;
        padding: 35px 40px;
        margin-bottom: 26px;
        display: flex;
        align-items: center;
        gap: 35px;
        position: relative;
        border: 1px solid rgba(255,255,255,0.75);
        box-shadow:
            0 16px 40px rgba(44,31,23,0.04),
            0 2px 12px rgba(212,163,115,0.03);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow:hidden;
    }

    .loan-status-card::before{
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(135deg, rgba(212,163,115,0.05), transparent 45%);
        pointer-events:none;
    }

    .loan-status-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 32px 60px rgba(44,31,23,0.08);
    }

    .badge-label {
        position: absolute;
        top: 30px;
        right: 35px;
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        backdrop-filter: blur(10px);
    }

    .status-pending {
        border-left: 4px solid var(--warning);
    }

    .badge-pending {
        background: rgba(243,156,18,0.1);
        color: #D4A373;
        border: 1px solid rgba(212,163,115,0.2);
        animation: pulseBadge 2s infinite;
    }

    @keyframes pulseBadge{
        0%{transform:scale(1);}
        50%{transform:scale(.97);}
        100%{transform:scale(1);}
    }

    .status-active {
        border-left: 4px solid var(--success);
    }

    .badge-active {
        background: rgba(39,174,96,0.1);
        color: var(--success);
    }

    .status-rejected {
        border-left: 4px solid var(--danger);
    }

    .badge-rejected {
        background: rgba(231,76,60,0.08);
        color: var(--danger);
    }

    .status-return-process {
        border-left: 4px solid var(--primary);
    }

    .badge-return {
        background: rgba(44,31,23,0.08);
        color: var(--primary);
    }

    .loan-cover {
        width: 92px;
        height: 132px;
        border-radius: 18px;
        object-fit: cover;
        box-shadow: 0 14px 28px rgba(44,31,23,0.16);
        border: 2px solid rgba(255,255,255,0.7);
        flex-shrink:0;
    }

    .btn-action-luxe {
        padding: 15px 24px;
        border-radius: 18px;
        font-weight: 800;
        text-decoration: none;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        transition: 0.3s;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space:nowrap;
    }

    .btn-return {
        background: rgba(255,255,255,0.85);
        color: var(--primary);
        border: 1px solid rgba(44,31,23,0.06);
        box-shadow:0 8px 18px rgba(44,31,23,0.04);
    }

    .btn-return:hover {
        background: var(--primary);
        color: var(--accent);
        transform:translateY(-2px);
    }

    .btn-pdf {
        background: linear-gradient(145deg,#2C1F17,#1C130E);
        color: var(--accent);
        box-shadow: 0 12px 25px rgba(44,31,23,0.18);
    }

    .btn-pdf:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 35px rgba(44,31,23,0.22);
    }

    /* =========================
       REVIEW CARD
    ========================= */

    .review-master-card {
        background: rgba(255,255,255,0.78);
        backdrop-filter: blur(16px);
        border-radius: 38px;
        overflow: hidden;
        margin-bottom: 34px;
        border: 1px solid rgba(255,255,255,0.75);
        box-shadow: 0 16px 45px rgba(44,31,23,0.04);
        transition: all .4s ease;
    }

    .review-master-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 32px 60px rgba(44,31,23,0.08);
    }

    .book-header-box {
        padding: 34px 40px;
        background:
            linear-gradient(135deg, rgba(255,255,255,0.65), rgba(250,247,244,0.9));
        display: flex;
        align-items: center;
        gap: 24px;
        border-bottom: 1px dashed rgba(44,31,23,0.08);
    }

    .mini-cover {
        width: 74px;
        height: 104px;
        border-radius: 16px;
        object-fit: cover;
        box-shadow: 0 12px 24px rgba(44,31,23,0.12);
        border:2px solid rgba(255,255,255,0.8);
    }

    .rating-body-box {
        padding: 40px;
    }

    .stars-display {
        display: flex;
        gap: 6px;
        margin-bottom: 4px;
    }

    .stars-display i {
        font-size: 28px;
        color: #E2E8F0;
        transition: .2s ease;
    }

    .stars-display.interactive i {
        cursor: pointer;
    }

    .stars-display.interactive i:hover {
        transform: scale(1.18);
        color: #FFB800;
    }

    .stars-display i.ri-star-fill {
        color: #FFB800;
    }

    .rating-text-hint {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent);
        margin-bottom: 24px;
        display: block;
    }

    .review-bubble-card {
        background: linear-gradient(145deg,#FAF8F5,#ffffff);
        border-radius: 26px;
        padding: 26px 30px;
        border: 1px solid rgba(44,31,23,0.05);
        position: relative;
        margin-top: 16px;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
    }

    .review-bubble-card::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 35px;
        width: 20px;
        height: 20px;
        background:#FAF8F5;
        transform:rotate(45deg);
        border-left:1px solid rgba(44,31,23,0.05);
        border-top:1px solid rgba(44,31,23,0.05);
    }

    .input-premium-ulasan {
        width: 100%;
        background: rgba(255,255,255,0.9);
        border: 2px solid rgba(44,31,23,0.05);
        padding: 20px 100px 20px 25px;
        border-radius: 24px;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        transition: .3s ease;
    }

    .input-premium-ulasan:focus {
        border-color: rgba(212,163,115,0.4);
        box-shadow: 0 18px 35px rgba(212,163,115,0.08);
        background:white;
    }

    .notif-review-banner {
        background:
            linear-gradient(135deg,#3E2C23 0%, #211610 100%);
        padding: 34px 40px;
        border-radius: 34px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 38px;
        box-shadow: 0 20px 45px rgba(44,31,23,0.14);
        position:relative;
        overflow:hidden;
    }

    .notif-review-banner::before{
        content:'';
        position:absolute;
        width:220px;
        height:220px;
        background: radial-gradient(circle, rgba(255,255,255,0.10), transparent 70%);
        right:-70px;
        top:-70px;
    }

    .notif-review-banner h4 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        margin: 0 0 6px 0;
        font-weight: 700;
        color: #FAF6F0;
    }

    .notif-review-banner p {
        font-size: 13px;
        margin: 0;
        color: var(--accent);
        font-weight: 500;
        max-width:600px;
        line-height:1.7;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(44,31,23,0.45);
        backdrop-filter: blur(14px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding:20px;
    }

    .modal-content {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(18px);
        padding: 45px;
        border-radius: 40px;
        width: 500px;
        max-width:100%;
        box-shadow: 0 30px 70px rgba(0,0,0,0.18);
        border: 1px solid rgba(255,255,255,0.75);
    }

    .oase-popup {
        border-radius: 32px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }

    .print-receipt-wrapper {
        display: none;
    }

    /* =========================
       SCROLLBAR
    ========================= */

    ::-webkit-scrollbar{
        width:10px;
    }

    ::-webkit-scrollbar-track{
        background:#eee5db;
    }

    ::-webkit-scrollbar-thumb{
        background:linear-gradient(180deg,#D4A373,#9B6B43);
        border-radius:20px;
    }

    ::-webkit-scrollbar-thumb:hover{
        background:#8E5D3B;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width:980px){

        .profile-bento-stats{
            grid-template-columns:1fr;
        }

        .hero-main-identity{
            flex-direction:column;
            align-items:flex-start;
        }

        .loan-status-card{
            flex-direction:column;
            align-items:flex-start;
        }

        .loan-status-card > div{
            width:100%;
        }

        .loan-status-card .btn-action-luxe{
            width:100%;
            justify-content:center;
        }

        .loan-status-card div[style*="display: flex; gap: 12px;"]{
            flex-direction:column;
            width:100%;
            margin-top:20px;
        }

        .book-header-box{
            flex-direction:column;
            align-items:flex-start;
        }

        .book-header-box > div{
            width:100%;
        }

        .notif-review-banner{
            flex-direction:column;
            align-items:flex-start;
            gap:20px;
        }
    }

    @media(max-width:640px){

        .app-viewport{
            padding:0 16px 100px;
            margin-top:20px;
        }

        .profile-hero{
            padding:28px;
            border-radius:30px;
        }

        .loan-status-card{
            padding:28px;
        }

        .review-master-card{
            border-radius:28px;
        }

        .book-header-box,
        .rating-body-box{
            padding:26px;
        }

        .modal-content{
            padding:30px;
            border-radius:28px;
        }

        h2{
            font-size:24px !important;
        }

        .section-label{
            font-size:20px;
        }
    }

    /* ==========================================================================
       PRINT CONFIGURATION (OPTIMASI LAYOUT CETAK KONSISTEN SEMPURNA)
       ========================================================================== */

    @media print {
        @page { size: A5 landscape; margin: 0mm; }

        html, body {
            background: #ffffff !important;
            color: #2C1F17 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        nav,
        header,
        .section-label,
        .btn-action-luxe,
        .modal-overlay,
        footer,
        .status-pending,
        .status-rejected,
        .status-return-process,
        .badge-label,
        .loan-status-card,
        .profile-hero,
        h3,
        .notif-review-banner,
        .book-header-box,
        .rating-body-box,
        .notif-review-banner,
        .review-master-card {
            display: none !important;
        }

        /* Tampilkan wrapper cetak yang aktif meski parent-nya di-hide */
        .print-receipt-wrapper.active-print-wrapper {
            display: block !important;
        }

        .app-viewport {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .print-receipt-wrapper.active-print-wrapper {
            display: block !important;
            width: 185mm;
            height: 128mm;
            margin: 5mm auto;
            box-sizing: border-box;
            background: #FCFAF7 !important;
            padding: 25px 35px;
            border: 2px solid #2C1F17;
            outline: 6px double #2C1F17;
            outline-offset: -12px;
            position: relative;
        }

        .print-receipt-wrapper h1 {
            font-family: 'Playfair Display', serif;
            font-size: 26pt;
            font-weight: 700;
            margin: 0;
            text-align: center;
            color: #2C1F17 !important;
        }

        .print-receipt-wrapper p.desc {
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin: 4px 0 20px 0;
            text-align: center;
            color: #D4A373 !important;
            border-bottom: 1.5px solid #2C1F17;
            padding-bottom: 12px;
        }

        .receipt-grid-content {
            display: grid;
            grid-template-columns: 48mm 1fr;
            gap: 25px;
            align-items: start;
        }

        .print-book-info {
            display: block !important;
            text-align: center;
        }

        .print-book-info img {
            width: 44mm;
            height: 62mm;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid #2C1F17;
        }

        /* KUNCI STRUKTUR TABEL CETAK STRUK AGAR TIDAK MELAR */
        .receipt-details-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed !important; /* 🔥 MEMAKSA UKURAN STRUKTURAL TETAP STABIL */
        }

        .receipt-details-table td {
            padding: 7px 0;
            font-size: 10pt;
            font-weight: 700;
            color: #2C1F17 !important;
            border-bottom: 1px dashed rgba(44,31,23,0.15);
            /* 🔥 MITIGASI UTAMA: Memaksa judul/nama pembaca yang panjang otomatis patah baris ke bawah */
            word-wrap: break-word !important;
            word-break: break-word !important;
            white-space: normal !important;
            overflow: hidden;
        }

        .receipt-details-table td.label-receipt {
            font-size: 8pt;
            font-weight: 800;
            color: #A89C90 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 32%;
        }

        .print-status-lock {
            display: inline-block;
            background: #EAF6EC !important;
            color: #27ae60 !important;
            border: 1px solid #27ae60;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 8pt;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .receipt-footer-signature {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 9pt;
        }

        .signature-box {
            text-align: center;
            width: 140px;
            font-weight: 700;
        }

        .signature-line {
            border-top: 1.5px solid #2C1F17;
            margin-top: 45px;
            font-weight: 800;
            padding-top: 3px;
        }
    }
</style>


<div class="app-viewport">
    
    <header class="profile-hero">
        <div class="hero-main-identity">
            <div style="display: flex; align-items: center; gap: 25px;">
                <div class="avatar-box">{{ substr($user->name, 0, 1) }}</div>
                <div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <h2 style="font-size: 30px; font-weight: 800; margin: 0; letter-spacing: -0.5px;">{{ $user->name }}</h2>
                        <span class="badge-user-status">Anggota Pustaka</span>
                    </div>
                    <p style="font-size: 14px; color: #8A7E75; font-weight: 600; margin-top: 6px;"><i class="ri-mail-line" style="color: var(--accent); margin-right: 4px;"></i> {{ $user->email }}</p>
                </div>
            </div>
            <button onclick="toggleModal(true)" class="btn-edit-luxe">
                <i class="ri-edit-box-line" style="font-size: 16px;"></i> Sunting Profil
            </button>
        </div>

        <div class="profile-bento-stats">
            <div class="stat-bento-item">
                <div class="stat-bento-icon"><i class="ri-book-open-line"></i></div>
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #8A7E75; text-transform: uppercase; display: block; letter-spacing: 0.5px;">Sedang Dipinjam</span>
                    <div style="font-size: 22px; font-weight: 800; margin-top: 2px; color: var(--primary);">{{ $riwayat->where('status', 'dipinjam')->count() }} <span style="font-size:14px; font-weight:500; color:#8A7E75;">Koleksi</span></div>
                </div>
            </div>
            <div class="stat-bento-item">
                <div class="stat-bento-icon" style="color: var(--success);"><i class="ri-checkbox-circle-line"></i></div>
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #8A7E75; text-transform: uppercase; display: block; letter-spacing: 0.5px;">Selesai Dibaca</span>
                    <div style="font-size: 22px; font-weight: 800; margin-top: 2px; color: var(--primary);">{{ $riwayat->where('status', 'dikembalikan')->count() }} <span style="font-size:14px; font-weight:500; color:#8A7E75;">Buku</span></div>
                </div>
            </div>
            <div class="stat-bento-item">
                <div class="stat-bento-icon" style="color: var(--warning);"><i class="ri-history-line"></i></div>
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #8A7E75; text-transform: uppercase; display: block; letter-spacing: 0.5px;">Riwayat Baca</span>
                    <div style="font-size: 22px; font-weight: 800; margin-top: 2px; color: var(--primary);">{{ $riwayat->count() }} <span style="font-size:14px; font-weight:500; color:#8A7E75;">Berkas</span></div>
                </div>
            </div>
        </div>
    </header>

    <h3 class="section-label"><i class="ri-time-line" style="color: var(--accent);"></i> Berkas Sirkulasi Aktif</h3>

    @forelse($riwayat->whereIn('status', ['menunggu', 'pending', 'dipinjam', 'ditolak', 'menunggu_kembali']) as $r)
        
        @if($r->status == 'menunggu' || $r->status == 'pending')
            <div class="loan-status-card status-pending">
                <span class="badge-label badge-pending"><i class="ri-timer-flash-line"></i> Menunggu Konfirmasi</span>
                <img src="{{ asset('storage/'.$r->book->cover) }}" class="loan-cover">
                <div style="flex:1;">
                    <h4 style="font-size: 22px; font-weight: 800; margin:0; letter-spacing: -0.3px;">{{ $r->book->judul }}</h4>
                    <p style="font-size: 13px; color: #A89C90; margin-top: 6px; font-weight: 600;"><i class="ri-calendar-line"></i> Diajukan pada: {{ date('d M Y', strtotime($r->created_at)) }}</p>
                    <p style="color: #B58255; font-size: 13px; font-weight: 700; margin-top: 15px; display: flex; align-items: center; gap: 6px;"><i class="ri-loader-4-line ri-spin" style="color: var(--accent);"></i> Berkas peminjaman sedang diajukan dan menunggu validasi berkas fisik oleh pustakawan...</p>
                </div>
            </div>

        @elseif($r->status == 'dipinjam')
            <div class="loan-status-card status-active">
                <span class="badge-label badge-active">Sedang Dipinjam</span>
                <img src="{{ asset('storage/'.$r->book->cover) }}" class="loan-cover">
                <div style="flex:1; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h4 style="font-size: 22px; font-weight: 800; margin:0; letter-spacing: -0.3px;">{{ $r->book->judul }}</h4>
                        <div style="display: flex; gap: 20px; margin-top: 8px;">
                            <p style="font-size: 13px; color: #A89C90; font-weight: 600;"><i class="ri-calendar-todo-line"></i> Pinjam: {{ date('d M Y', strtotime($r->tanggal_pinjam)) }}</p>
                            <p style="font-size: 13px; color: var(--danger); font-weight: 700;"><i class="ri-calendar-warning-line"></i> Batas: {{ date('d M Y', strtotime($r->tanggal_kembali)) }}</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <button onclick="triggerReceiptPrint('print-receipt-{{ $r->id }}')" class="btn-action-luxe btn-pdf">
                            <i class="ri-printer-fill"></i> Cetak Bukti
                        </button>
                        <button onclick="confirmReturn('{{ $r->id }}', '{{ $r->book->judul }}')" class="btn-action-luxe btn-return">Kembalikan</button>
                    </div>
                </div>
            </div>

            {{-- TEMPLATE HARDCOPY EXCLUSIVE --}}
            <div id="print-receipt-{{ $r->id }}" class="print-receipt-wrapper">
                <h1>Oase Sastra.</h1>
                <p class="desc">Library Peminjaman Ticket</p>
                <div class="receipt-grid-content">
                    <div class="print-book-info"><img src="{{ asset('storage/'.$r->book->cover) }}"></div>
                    <div>
                        <table class="receipt-details-table">
                            <tr><td class="label-receipt">Peminjam</td><td>: <span style="font-size: 11pt; font-weight: 800;">{{ $user->name }}</span></td></tr>
                            <tr><td class="label-receipt">Judul Koleksi</td><td>: <span style="font-size: 11pt; font-weight: 800;">{{ $r->book->judul }}</span></td></tr>
                            <tr><td class="label-receipt">Karya Penulis</td><td>: {{ $r->book->penulis }}</td></tr>
                            <tr><td class="label-receipt">Penerbit Pustaka</td><td>: {{ $r->book->penerbit ?? '-' }}</td></tr>
                            <tr><td class="label-receipt">Tanggal Pinjam</td><td>: {{ date('d F Y', strtotime($r->tanggal_pinjam)) }}</td></tr>
                            <tr><td class="label-receipt">Batas Kembali</td><td>: {{ date('d F Y', strtotime($r->tanggal_kembali)) }}</td></tr>
                            <tr><td class="label-receipt">Status Berkas</td><td>:<div class="print-status-lock">DIPINJAM</div></td></tr>
                        </table>
                        <div class="receipt-footer-signature">
                            <div style="font-size: 7.5pt; color: #A89C90; font-family: 'JetBrains Mono';">ID: #BRW-{{ str_pad($r->id, 5, '0', STR_PAD_LEFT) }}</div>
                            <div class="signature-box"><span style="font-size: 8pt; color: #A89C90; text-transform: uppercase;">Sistem Otomatis</span><div class="signature-line">Oase Sastra</div></div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($r->status == 'menunggu_kembali')
            <div class="loan-status-card status-return-process">
                <span class="badge-label badge-return">Proses Retur</span>
                <img src="{{ asset('storage/'.$r->book->cover) }}" class="loan-cover">
                <div style="flex:1;">
                    <h4 style="font-size: 22px; font-weight: 800; margin:0; opacity: 0.6; letter-spacing: -0.3px;">{{ $r->book->judul }}</h4>
                    <p style="color: var(--primary); font-size: 13px; font-weight: 700; margin-top: 12px; display: flex; align-items: center; gap: 6px;"><i class="ri-refresh-line ri-spin"></i> Buku fisik sedang diperiksa pustakawan...</p>
                </div>
            </div>

        @elseif($r->status == 'ditolak')
            <div class="loan-status-card status-rejected">
                <span class="badge-label badge-rejected">Ditolak</span>
                <img src="{{ asset('storage/'.$r->book->cover) }}" class="loan-cover">
                <div style="flex:1;">
                    <h4 style="font-size: 22px; font-weight: 800; opacity: 0.5; margin:0; letter-spacing: -0.3px;">{{ $r->book->judul }}</h4>
                    <p style="color: var(--danger); font-size: 13px; font-weight: 700; margin-top: 10px;"><i class="ri-close-circle-line"></i> Permintaan peminjaman ditolak oleh admin.</p>
                </div>
            </div>
        @endif
    @empty
        <div style="text-align: center; padding: 45px; background: white; border-radius: 24px; border: 1px dashed #EFEAE4; color: #A89C90; font-weight: 600; font-size: 14px; box-shadow: 0 10px 30px rgba(44,31,23,0.01);">
            <i class="ri-inbox-line" style="font-size: 26px; display: block; margin-bottom: 8px; color: var(--accent);"></i> Tidak ada peminjaman aktif saat ini.
        </div>
    @endforelse


    <h3 class="section-label"><i class="ri-history-line" style="color: var(--accent);"></i> Arsip Literasi Pembaca</h3>

    @php
        $bukuBelumDiulas = $riwayat->where('status', 'dikembalikan')->filter(function($r) {
            return !\Illuminate\Support\Facades\DB::table('ulasans')
                ->where('book_id', $r->book_id)
                ->where(function($query) use ($r) {
                     $query->where('komentar', 'like', "%#ID-".$r->id."%")
                           ->orWhere('created_at', '>=', $r->updated_at);
                })->exists();
        })->first();
    @endphp

    @if($bukuBelumDiulas)
        <div class="notif-review-banner">
            <div>
                <h4>Buku Telah Kembali! </h4>
                <p>Bagikan impresi serta nilai kepuasan membacamu untuk buku <b>"{{ $bukuBelumDiulas->book->judul }}"</b> sekarang.</p>
            </div>
            <i class="ri-message-3-line" style="font-size: 36px; color: var(--accent); opacity: 0.8;"></i>
        </div>
    @endif

    @forelse($riwayat->where('status','dikembalikan') as $r)
        @php
            $sudahUlas = \Illuminate\Support\Facades\DB::table('ulasans')
                ->where('book_id', $r->book_id)
                ->where('komentar', 'like', "%#ID-".$r->id."%")
                ->first();
        @endphp

        <div class="review-master-card">
            <div class="book-header-box">
                <img src="{{ asset('storage/'.$r->book->cover) }}" class="mini-cover">
                <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                    <div>
                        <h4 style="font-weight: 800; margin:0; font-size: 19px; letter-spacing: -0.5px;">{{ $r->book->judul }}</h4>
                        <p style="color: var(--accent); font-weight: 700; margin: 4px 0 0 0; font-size: 14px;">oleh {{ $r->book->penulis }}</p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div style="text-align: right;">
                            <span style="font-size: 11px; color: #A89C90; font-weight: 800; background: #FAF7F4; border: 1px solid #EFEAE4; padding: 6px 14px; border-radius: 10px; font-family: 'JetBrains Mono'; display: block; margin-bottom: 5px;">
                                TRX: #BRW-{{ $r->id }}
                            </span>
                            <small style="font-size: 11px; font-weight: 700; color: #A89C90; display: block;"><i class="ri-calendar-check-line"></i> {{ date('d M Y', strtotime($r->tanggal_kembali)) }}</small>
                        </div>
                        {{-- TOMBOL CETAK BUKTI PENGEMBALIAN --}}
                        <button onclick="triggerReceiptPrint('print-return-{{ $r->id }}')" class="btn-action-luxe btn-pdf" style="white-space:nowrap;">
                            <i class="ri-printer-fill"></i> Bukti Kembali
                        </button>
                    </div>
                </div>
            </div>



            <div class="rating-body-box">
                @if($sudahUlas)
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div style="width: 42px; height: 42px; background: #F5EFE6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--primary); font-size: 14px; border: 1px solid #EFEAE4;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <span style="font-size: 14px; font-weight: 800; display: block; color: var(--primary);">{{ $user->name }}</span>
                            <div class="stars-display" style="pointer-events: none; margin-top: 2px;">
                                @for($i=1; $i<=5; $i++)
                                    <i class="{{ $i <= $sudahUlas->rating ? 'ri-star-fill' : 'ri-star-line' }}" style="font-size: 16px;"></i>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="review-bubble-card">
                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: var(--primary); line-height: 1.6;">
                            "{!! str_replace(' [#ID-'.$r->id.']', '', $sudahUlas->komentar) !!}"
                        </p>
                    </div>
                    <small style="color: var(--success); font-size: 11px; font-weight: 800; margin-top: 12px; display: flex; align-items: center; gap: 4px; padding-left: 5px;">
                        <i class="ri-shield-check-fill"></i> Ulasan terbit resmi di katalog buku global.
                    </small>

                @else
                    <form action="/ulasan/{{ $r->book->id }}" method="POST" id="form-review-{{ $r->id }}">
                        @csrf
                        <input type="hidden" name="rating" id="rating-{{ $r->id }}" value="5">
                        
                        <div style="background: #FAF8F6; padding: 30px; border-radius: 24px; border: 1px dashed #EFEAE4; text-align: center;">
                            <span style="font-size: 11px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 12px;">Ketuk Nilai Kepuasan Membaca</span>
                            
                            <div class="stars-display interactive" data-id="{{ $r->id }}" style="justify-content: center;">
                                @for($i=1; $i<=5; $i++) <i class="ri-star-fill" data-value="{{ $i }}" id="star-{{ $r->id }}-{{ $i }}"></i> @endfor
                            </div>
                            <span class="rating-text-hint" id="hint-{{ $r->id }}">SANGAT BAGUS! 🌟</span>
                            
                            <div style="position: relative; max-width: 700px; margin: 0 auto; width: 100%; box-sizing: border-box;">
                                <input type="text" name="komentar_user" maxlength="150" class="input-premium-ulasan"
                                       placeholder="Tulis pendapat jujurmu mengenai isi buku ini..." required 
                                       oninput="updateKomentarData(this, '{{ $r->id }}')">
                                
                                <small id="char-count-{{ $r->id }}" style="position: absolute; right: 25px; top: 22px; font-size: 11px; font-weight: 700; color: #A89C90; font-family: 'JetBrains Mono'; background: #FAF7F4; padding: 2px 8px; border-radius: 6px; border: 1px solid #EFEAE4;">
                                    0 / 150
                                </small>
                                <input type="hidden" name="komentar" id="hidden-komentar-{{ $r->id }}">
                            </div>

                            <button type="submit" style="margin-top: 25px; background: var(--primary); color: var(--accent); padding: 18px 55px; border: none; border-radius: 18px; font-weight: 800; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; font-size: 13px; transition: 0.3s; box-shadow: 0 10px 25px rgba(44,31,23,0.12);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                <i class="ri-send-plane-fill"></i> Kirim Ulasan Buku
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p style="text-align: center; opacity: 0.4; padding: 40px;">Belum ada riwayat buku yang selesai dibaca.</p>
    @endforelse

    {{-- SEMUA TEMPLATE CETAK BUKTI PENGEMBALIAN (di luar loop agar tidak ter-hide CSS print) --}}
    @foreach($riwayat->where('status','dikembalikan') as $r)
    <div id="print-return-{{ $r->id }}" class="print-receipt-wrapper">
        <h1>Oase Sastra.</h1>
        <p class="desc">Bukti Pengembalian Buku</p>
        <div class="receipt-grid-content">
            <div class="print-book-info">
                <img src="{{ asset('storage/'.$r->book->cover) }}">
            </div>
            <div>
                <table class="receipt-details-table">
                    <tr><td class="label-receipt">No. Transaksi</td><td>: <span style="font-weight:800;">#BRW-{{ str_pad($r->id,5,'0',STR_PAD_LEFT) }}</span></td></tr>
                    <tr><td class="label-receipt">Peminjam</td><td>: <span style="font-size:11pt; font-weight:800;">{{ $user->name }}</span></td></tr>
                    <tr><td class="label-receipt">Judul Koleksi</td><td>: <span style="font-size:11pt; font-weight:800;">{{ $r->book->judul }}</span></td></tr>
                    <tr><td class="label-receipt">Karya Penulis</td><td>: {{ $r->book->penulis }}</td></tr>
                    <tr><td class="label-receipt">Penerbit</td><td>: {{ $r->book->penerbit ?? '-' }}</td></tr>
                    <tr><td class="label-receipt">Tanggal Pinjam</td><td>: {{ date('d F Y', strtotime($r->tanggal_pinjam)) }}</td></tr>
                    <tr><td class="label-receipt">Tanggal Kembali</td><td>: {{ date('d F Y', strtotime($r->tanggal_kembali)) }}</td></tr>
                    <tr><td class="label-receipt">Status</td><td>: <div class="print-status-lock">✓ DIKEMBALIKAN</div></td></tr>
                </table>
                <div class="receipt-footer-signature">
                    <div class="signature-box">
                        <p>Peminjam,</p>
                        <div class="signature-line">{{ $user->name }}</div>
                    </div>
                    <div class="signature-box">
                        <p>Petugas Perpustakaan,</p>
                        <div class="signature-line">____________________</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="modal-overlay" id="modalEdit">
    <div class="modal-content">
        <h2 style="text-align:center; font-weight:800; margin-bottom:30px; letter-spacing:-1px; color:var(--primary); font-size: 24px;">Edit Data Profil</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div style="margin-bottom:18px;">
                <label style="font-size:11px; font-weight:800; color:var(--accent); display:block; margin-bottom:8px; letter-spacing: 0.5px;">NAMA LENGKAP</label>
                <input type="text" name="name" class="input-premium-ulasan" value="{{ $user->name }}" required style="text-align: left; padding: 20px 25px;">
            </div>
            <div style="margin-bottom:18px;">
                <label style="font-size:11px; font-weight:800; color:var(--accent); display:block; margin-bottom:8px; letter-spacing: 0.5px;">EMAIL AKTIF</label>
                <input type="email" name="email" class="input-premium-ulasan" value="{{ $user->email }}" required style="text-align: left; padding: 20px 25px;">
            </div>
            <div style="margin-bottom:28px;">
                <label style="font-size:11px; font-weight:800; color:var(--accent); display:block; margin-bottom:8px; letter-spacing: 0.5px;">ALAMAT DOMISILI</label>
                <textarea name="alamat" class="input-premium-ulasan" style="text-align: left; height: 85px; resize: none; padding: 20px 25px; line-height: 1.5;">{{ $user->alamat }}</textarea>
            </div>
            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="toggleModal(false)" style="flex:1; background:#f5efe6; border:none; padding:16px; border-radius:16px; font-weight:800; cursor:pointer; font-size: 13px;">BATAL</button>
                <button type="submit" style="flex:2; background:var(--primary); color:var(--accent); border:none; padding:16px; border-radius:16px; font-weight:800; cursor:pointer; font-size: 13px; box-shadow: 0 8px 20px rgba(44,31,23,0.12);">SIMPAN PERUBAHAN</button>
            </div>
        </form>
    </div>
</div>

<script>
    const ratingHints = {
        1: "Sangat Buruk 😞",
        2: "Kurang Memuaskan 😐",
        3: "Cukup Bagus 🙂",
        4: "Bagus & Direkomendasikan ✨",
        5: "Sangat Bagus! 🌟"
    };

    function updateKomentarData(inputElement, trxId) {
        let length = inputElement.value.length;
        document.getElementById(`char-count-${trxId}`).innerText = `${length} / 150`;
        document.getElementById(`hidden-komentar-${trxId}`).value = inputElement.value + ` [#ID-${trxId}]`;
    }

    document.querySelectorAll('.stars-display.interactive i').forEach(star => {
        star.addEventListener('click', function() {
            let container = this.parentElement;
            let val = parseInt(this.dataset.value);
            let id = container.dataset.id;
            
            document.getElementById('rating-' + id).value = val;
            document.getElementById('hint-' + id).innerText = ratingHints[val];
            
            container.querySelectorAll('i').forEach(s => {
                let sVal = parseInt(s.dataset.value);
                s.className = sVal <= val ? 'ri-star-fill' : 'ri-star-line';
            });
        });
    });

    function triggerReceiptPrint(printWrapperId) {
        document.querySelectorAll('.print-receipt-wrapper').forEach(el => el.classList.remove('active-print-wrapper'));
        const selectedReceipt = document.getElementById(printWrapperId);
        if (selectedReceipt) {
            selectedReceipt.classList.add('active-print-wrapper');
            window.print();
        }
    }

    function toggleModal(show) {
        document.getElementById('modalEdit').style.display = show ? 'flex' : 'none';
    }

    function confirmReturn(id, judul) {
        Swal.fire({
            title: 'Ajukan Pengembalian?',
            text: `Kamu akan mengajukan pengembalian buku "${judul}". Pastikan buku sudah siap dikembalikan ke perpustakaan ya!`,
            icon: 'question',
            iconColor: '#D4A373',
            showCancelButton: true,
            confirmButtonColor: '#2C1F17',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ajukan!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'oase-popup' }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/kembalikan/" + id;
            }
        })
    }
</script>
@endsection