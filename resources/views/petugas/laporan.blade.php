@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* ==========================================================================
       1. LUXURY INDUSTRIAL LUXE THEME WORKSPACE (SCREEN VIEW)
       ========================================================================== */
    :root {
        --primary: #2C1F17;
        --accent: #D4A373;
        --cream-bg: #FAF6F0;
        --surface-marmer: #FDFCFB;
        --border-luxe: rgba(62, 44, 35, 0.08);
        --wood-gradient: linear-gradient(135deg, #3E2C23 0%, #211610 100%);
    }

    .admin-workspace { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        padding: 30px; 
        color: var(--primary);
        background: #F6F4F0;
        min-height: 100vh;
    }

    .bento-report-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 40px;
    }

    .bento-report-card {
        background: var(--wood-gradient);
        padding: 30px 25px;
        border-radius: 24px;
        border: 1px solid rgba(212, 163, 115, 0.15);
        box-shadow: 0 15px 35px rgba(33, 22, 16, 0.15);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
    }
    .bento-report-card::after {
        content: ''; position: absolute; inset: 0; border-radius: 24px;
        box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.1); pointer-events: none;
    }
    .bento-report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 45px rgba(33, 22, 16, 0.25), 0 0 15px rgba(212, 163, 115, 0.2);
        border-color: var(--accent);
    }
    
    .bento-report-card.tab-active {
        background: #ffffff;
        border-color: var(--accent);
        box-shadow: 0 15px 40px rgba(212, 163, 115, 0.15);
    }
    .bento-report-card.tab-active::after { box-shadow: none; }

    .bento-icon-box {
        width: 50px; height: 50px; 
        background: rgba(255, 255, 255, 0.06); color: var(--accent);
        border-radius: 16px; 
        display: flex; align-items: center; justify-content: center; 
        font-size: 22px;
        transition: 0.3s;
    }
    .bento-report-card.tab-active .bento-icon-box { 
        background: var(--primary); 
        color: var(--accent); 
        box-shadow: 0 8px 15px rgba(44, 31, 23, 0.15);
    }

    .bento-report-card h3 { font-size: 14px; font-weight: 800; margin: 0; color: #FAF6F0; letter-spacing: -0.2px; }
    .bento-report-card p { font-size: 11px; color: var(--accent); margin: 0 0 3px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
    
    .bento-report-card.tab-active h3 { color: var(--primary); }
    .bento-report-card.tab-active p { color: #A89C90; }

    .preview-container {
        background: var(--surface-marmer);
        border-radius: 32px;
        padding: 45px 50px;
        border: 1px solid var(--border-luxe);
        box-shadow: 0 30px 70px rgba(62, 44, 35, 0.03);
    }

    .preview-header-ui {
        display: flex; justify-content: space-between; align-items: center;
        border-bottom: 2px solid #F3EFEA; padding-bottom: 25px; margin-bottom: 20px;
    }
    .preview-header-ui h2 { font-size: 26px; margin: 0; font-weight: 800; letter-spacing: -1px; color: var(--primary); }

    .mini-stats-wrapper {
        display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;
    }
    .mini-stat-tag {
        background: #FDFBF9;
        border: 1.5px solid rgba(212, 163, 115, 0.18);
        padding: 14px 22px;
        border-radius: 16px;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--primary);
    }
    .mini-stat-tag i { color: var(--accent); font-size: 18px; }
    .mini-stat-tag span { 
        font-weight: 900; color: #000000; 
        background: rgba(212, 163, 115, 0.12); 
        padding: 2px 10px; border-radius: 8px; 
    }

    .btn-print-action {
        padding: 15px 28px; border-radius: 16px; font-weight: 800; font-size: 11px;
        display: flex; align-items: center; gap: 10px; border: none; cursor: pointer;
        background: var(--primary); color: var(--accent); text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;
        box-shadow: 0 10px 25px rgba(44, 31, 23, 0.15);
    }
    .btn-print-action:hover { 
        background: #000000;
        transform: translateY(-3px); 
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25); 
    }

    .screen-table { width: 100%; border-collapse: collapse; }
    .screen-table th { text-align: left; font-size: 11px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1.5px; padding-bottom: 18px; border-bottom: 2px solid var(--primary); }
    .screen-table td { padding: 22px 10px; border-bottom: 1px solid #F3EFEA; font-weight: 700; font-size: 14px; color: var(--primary); vertical-align: middle; }
    .screen-table tbody tr:hover td { background: rgba(212, 163, 115, 0.02); }

    .badge-status { padding: 6px 14px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; border: 1.5px solid currentColor; display: inline-block; }
    .status-dipinjam { color: #0984E3; background: #E5F9FF; }
    .status-kembali { color: #27AE60; background: #E5FFF1; }

    .report-view-block {
        animation: smoothFadeUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    @keyframes smoothFadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

    /* ==========================================================================
       2. STRUKTUR PRINTING HARDCOPY SYSTEM (🔥 FIXED FOR A4 PORTRAIT)
       ========================================================================== */
    .print-only-section { display: none; }

    @media print {
        html, body, .admin-workspace, .content-wrapper, main, #app, .wrapper {
            height: auto !important; min-height: auto !important; overflow: visible !important; display: block !important; position: static !important; background: white !important;
        }
        .sidebar, .navbar, .bento-report-grid, .preview-container, nav, aside, footer { display: none !important; }
        
        .print-only-section.active-print { display: block !important; width: 100% !important; height: auto !important; overflow: visible !important; }
        
        .official-header { border-top: 4px solid black; padding: 20px 0 10px; border-bottom: 2px double black; text-align: center; margin-bottom: 30px; }
        .official-header h1 { font-family: 'Playfair Display', serif; font-size: 28pt; color: black !important; margin: 0; }
        .official-header p { font-size: 9pt; font-weight: 700; letter-spacing: 3px; color: black !important; text-transform: uppercase; margin: 4px 0 0; }

        /* Mengunci tabel agar pas di lebar A4 Tegak */
        .print-table { width: 100% !important; border-collapse: collapse; margin-top: 10px; table-layout: fixed; }
        
        .print-table th { 
            border-bottom: 2px solid black; 
            padding: 10px 4px; 
            text-align: left; 
            font-size: 9.5pt; 
            color: black !important; 
            text-transform: uppercase; 
            font-weight: 800;
            white-space: nowrap !important; /* Biar judul TGL PINJAM ga nekuk kebawah */
        }
        
        /* 🔥 SETING WIDTH KOLOM PRESISI BIAR SEJAJAR DI A4 PORTRAIT */
        .print-table th:nth-child(1), .print-table td:nth-child(1) { width: 18% !important; } /* Peminjam */
        .print-table th:nth-child(2), .print-table td:nth-child(2) { width: 24% !important; } /* Judul Buku */
        .print-table th:nth-child(3), .print-table td:nth-child(3) { width: 21% !important; white-space: nowrap !important; } /* Tgl Pinjam (Dilebarin) */
        .print-table th:nth-child(4), .print-table td:nth-child(4) { width: 21% !important; white-space: nowrap !important; } /* Tgl Kembali (Dilebarin) */
        .print-table th:nth-child(5), .print-table td:nth-child(5) { width: 16% !important; text-align: right; } /* Status */

        .print-table td { border-bottom: 1px solid #ddd; padding: 12px 4px; font-size: 9.5pt; color: black !important; font-weight: 700; word-wrap: break-word; }
        .print-table tr { page-break-inside: avoid !important; page-break-after: auto !important; }

        .print-footer { display: flex; justify-content: space-between; margin-top: 40px; page-break-inside: avoid !important; }
        .print-sign { text-align: center; width: 180px; font-size: 11px; }
        .print-sign p { margin: 0; color: black !important; font-weight: 600; }
        .print-sign b { border-top: 1.5px solid black; padding-top: 6px; display: block; width: 100%; margin-top: 65px; color: black !important; font-weight: 800; }
        
        /* 🔥 PAKSA FORMAT KERTAS A4 PORTRAIT (TEGAK) */
        @page { size: A4 portrait; margin: 1.2cm; }
    }
</style>

<div class="admin-workspace">
    <div style="margin-bottom: 40px; border-left: 5px solid var(--accent); padding-left: 25px;">
        <h2 style="font-weight: 900; font-size: 38px; letter-spacing: -1.5px; margin: 0; font-family: 'Plus Jakarta Sans', sans-serif;">Report Center.</h2>
        <p style="color: #A89C90; font-size: 14px; font-weight: 500; margin-top: 5px; letter-spacing: 0.2px;">Pusat Ekstraksi Laporan dan Dokumentasi Arsip Oase Sastra.</p>
    </div>

    <div class="bento-report-grid">
        <div class="bento-report-card tab-active" id="tab-buku" onclick="switchReportTab('buku')">
            <div class="bento-icon-box"><i class="ri-book-3-line"></i></div>
            <div>
                <p>Katalog</p>
                <h3>Data Inventaris Buku</h3>
            </div>
        </div>
        <div class="bento-report-card" id="tab-sirkulasi" onclick="switchReportTab('sirkulasi')">
            <div class="bento-icon-box"><i class="ri-exchange-funds-line"></i></div>
            <div>
                <p>Sirkulasi</p>
                <h3>Peminjaman & Pengembalian</h3>
            </div>
        </div>
    </div>

    <div class="preview-container">
        
        <div class="report-view-block" id="view-buku">
            <div class="preview-header-ui">
                <div>
                    <h2>Pratinjau Dokumen Buku</h2>
                    <small style="color: #A89C90; font-weight: 600; letter-spacing: 0.3px;">Arsip log inventarisasi pustaka oase sastra</small>
                </div>
                <button onclick="triggerSystemPrint('print-buku-section')" class="btn-print-action">
                    <i class="ri-printer-line"></i> CETAK DATA BUKU
                </button>
            </div>

            <div class="mini-stats-wrapper">
                <div class="mini-stat-tag">
                    <i class="ri-git-repository-line"></i> Ragam Judul Buku: <span>{{ $books->count() }}</span>
                </div>
                <div class="mini-stat-tag">
                    <i class="ri-stack-line"></i> Akumulasi Total Stok: <span>{{ $books->sum('stok') }} Eks</span>
                </div>
            </div>

            <table class="screen-table">
                <thead>
                    <tr>
                        <th>JUDUL BUKU</th>
                        <th>PENULIS</th>
                        <th>PENERBIT</th>
                        <th>TAHUN TERBIT</th>
                        <th style="text-align: right;">STOK BARANG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $b)
                    <tr>
                        <td><b>{{ $b->judul }}</b></td>
                        <td>{{ $b->penulis }}</td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tahun_terbit }}</td>
                        <td align="right">{{ $b->stok }} Buku</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="report-view-block" id="view-sirkulasi" style="display: none;">
            <div class="preview-header-ui">
                <div>
                    <h2>Pratinjau Dokumen Sirkulasi</h2>
                    <small style="color: #A89C90; font-weight: 600; letter-spacing: 0.3px;">Arsip mutasi aktivitas sirkulasi buku (Peminjaman & Pengembalian)</small>
                </div>
                <button onclick="triggerSystemPrint('print-sirkulasi-section')" class="btn-print-action">
                    <i class="ri-printer-line"></i> CETAK SIRKULASI
                </button>
            </div>

            @php
                $filtered_sirkulasi = $peminjamans->filter(function($p) {
                    $st = strtolower($p->status);
                    return $st == 'dipinjam' || $st == 'kembali' || $st == 'dikembalikan';
                });
            @endphp

            <div class="mini-stats-wrapper">
                <div class="mini-stat-tag">
                    <i class="ri-folder-open-line"></i> Total Log Sirkulasi: <span>{{ $filtered_sirkulasi->count() }}</span>
                </div>
                <div class="mini-stat-tag">
                    <i class="ri-book-open-line"></i> Sedang Dipinjam: <span>{{ $filtered_sirkulasi->where('status', 'dipinjam')->count() }}</span>
                </div>
                <div class="mini-stat-tag">
                    <i class="ri-checkbox-circle-line"></i> Telah Dikembalikan: <span>{{ $filtered_sirkulasi->filter(function($p){ $s=strtolower($p->status); return $s=='kembali'||$s=='dikembalikan'; })->count() }}</span>
                </div>
            </div>

            <table class="screen-table">
                <thead>
                    <tr>
                        <th>PEMINJAM</th>
                        <th>JUDUL BUKU</th>
                        <th>TGL PINJAM</th>
                        <th>TGL KEMBALI</th>
                        <th style="text-align: right;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($filtered_sirkulasi as $p)
                        @php $status_clean = strtolower($p->status); @endphp
                        <tr>
                            <td><b>{{ $p->user->name ?? '-' }}</b><br><small style="color: #A89C90; font-size: 11px;">ID: USR-{{ str_pad($p->user_id, 4, '0', STR_PAD_LEFT) }}</small></td>
                            <td>{{ $p->book->judul ?? '-' }}</td>
                            <td>{{ $p->tanggal_pinjam }}</td>
                            <td>{{ $p->tanggal_kembali ?? '— (Belum Kembali)' }}</td>
                            <td align="right">
                                <span class="badge-status {{ ($status_clean == 'kembali' || $status_clean == 'dikembalikan') ? 'status-kembali' : 'status-dipinjam' }}">
                                    {{ ($status_clean == 'kembali' || $status_clean == 'dikembalikan') ? 'DIKEMBALIKAN' : 'DIPINJAM' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" align="center" style="padding: 50px; color: #A89C90;">Tidak ada arsip sirkulasi aktif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div id="print-buku-section" class="print-only-section">
        <div class="official-header"><h1>Oase Sastra.</h1><p>LAPORAN DATA KATALOG & INVENTARISASI BUKU BACAAN</p></div>
        <table class="print-table">
            <thead>
                <tr><th>JUDUL BUKU</th><th>PENULIS</th><th>PENERBIT</th><th>TAHUN TERBIT</th><th style="text-align: right;">STOK BARANG</th></tr>
            </thead>
            <tbody>
                @foreach($books as $b)
                <tr><td><b>{{ $b->judul }}</b></td><td>{{ $b->penulis }}</td><td>{{ $b->penerbit }}</td><td>{{ $b->tahun_terbit }}</td><td align="right">{{ $b->stok }} Buku</td></tr>
                @endforeach
            </tbody>
        </table>
        <div class="print-footer">
            <div class="print-sign"><p>Petugas Inventaris,</p><b>{{ auth()->user()->name }}</b></div>
            <div class="print-sign"><p>Mengetahui, Kepala Perpustakaan</p><b>____________________</b></div>
        </div>
    </div>

    <div id="print-sirkulasi-section" class="print-only-section">
        <div class="official-header"><h1>Oase Sastra.</h1><p>LAPORAN RESMI SIRKULASI PEMINJAMAN & PENGEMBALIAN</p></div>
        <table class="print-table">
            <thead>
                <tr>
                    <th>PEMINJAM</th>
                    <th>JUDUL BUKU</th>
                    <th>TGL PINJAM</th>
                    <th>TGL KEMBALI</th>
                    <th style="text-align: right;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filtered_sirkulasi as $p)
                    @php $sc = strtolower($p->status); @endphp
                    <tr>
                        <td><b>{{ $p->user->name ?? '-' }}</b><br><small style="color: #555;">ID: USR-{{ str_pad($p->user_id, 4, '0', STR_PAD_LEFT) }}</small></td>
                        <td>{{ $p->book->judul ?? '-' }}</td>
                        <td>{{ $p->tanggal_pinjam }}</td>
                        <td>{{ $p->tanggal_kembali ?? '— (Belum Kembali)' }}</td>
                        <td align="right"><b>{{ ($sc == 'kembali' || $sc == 'dikembalikan') ? 'DIKEMBALIKAN' : 'DIPINJAM' }}</b></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="print-footer">
            <div class="print-sign"><p>Dicetak Oleh,</p><b>{{ auth()->user()->name }}</b></div>
            <div class="print-sign"><p>Mengetahui, Kepala Perpustakaan</p><b>____________________</b></div>
        </div>
    </div>

</div>

<script>
    function switchReportTab(type) {
        document.querySelectorAll('.bento-report-card').forEach(card => card.classList.remove('tab-active'));
        document.querySelectorAll('.report-view-block').forEach(view => view.style.display = 'none');

        document.getElementById('tab-' + type).classList.add('tab-active');
        document.getElementById('view-' + type).style.display = 'block';
    }

    function triggerSystemPrint(printSectionId) {
        document.querySelectorAll('.print-only-section').forEach(el => el.classList.remove('active-print'));
        
        const targetPrintElement = document.getElementById(printSectionId);
        targetPrintElement.classList.add('active-print');
        
        window.print();
    }
</script>
@endsection