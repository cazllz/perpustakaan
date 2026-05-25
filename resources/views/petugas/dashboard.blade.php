@php
    // 🔥 JURUS DINAMIS: Deteksi otomatis role untuk layout dan rute kendali
    $role = auth()->user()->role;
    $prefix = ($role == 'admin') ? 'admin' : 'petugas';
@endphp

@extends('layouts.' . $prefix)

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* MASTER WORKSPACE - Industrial Luxe Edition */
    .admin-workspace { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: #2C1F17; 
        padding: 10px;
        animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

    /* STATS STRIP */
    .stats-strip { 
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 40px;
    }
    .stat-card-luxe {
        background: #ffffff; 
        padding: 28px; border-radius: 32px; 
        border: 1.5px solid rgba(212, 163, 115, 0.15); 
        display: flex; align-items: center; gap: 22px; 
        box-shadow: 0 15px 35px rgba(62, 44, 35, 0.04), 0 5px 15px rgba(62, 44, 35, 0.02);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .stat-card-luxe:hover { 
        transform: translateY(-8px); 
        border-color: #D4A373; 
        box-shadow: 0 25px 50px rgba(62, 44, 35, 0.08); 
    }

    .icon-circle {
        width: 56px; height: 56px; background: #2C1F17; color: #D4A373; 
        border-radius: 18px; display: flex; align-items: center; justify-content: center; 
        font-size: 24px; box-shadow: 0 8px 20px rgba(44, 31, 23, 0.15);
    }

    /* TABLE PANEL */
    .panel-premium {
        background: #ffffff; 
        border-radius: 40px; padding: 40px;
        border: 1.5px solid rgba(62, 44, 35, 0.08); 
        box-shadow: 0 25px 60px rgba(44, 31, 23, 0.03);
        overflow: visible !important;
    }

    /* SEARCH BAR - Dipanjangkan */
    .search-wrapper { position: relative; max-width: 650px; margin-bottom: 35px; }
    .search-wrapper input {
        width: 100%; padding: 18px 25px 18px 60px; border-radius: 100px;
        border: 2px solid #F8F5F2; background: #FBFAFA;
        font-weight: 700; font-size: 14px; outline: none; transition: 0.3s; color: #2C1F17;
    }
    .search-wrapper input:focus { border-color: #D4A373; background: white; box-shadow: 0 10px 25px rgba(212, 163, 115, 0.08); }

    /* PREMIUM TABLE STYLE */
    .table-container-luxe { padding: 5px; overflow: visible !important; }
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0 15px; }
    .premium-table th { font-size: 11px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 2px; padding: 0 25px 12px; text-align: left; }
    
    .premium-table td { 
        background: #ffffff; padding: 25px; font-size: 14px; font-weight: 700; 
        border-top: 1.5px solid rgba(62, 44, 35, 0.06); 
        border-bottom: 1.5px solid rgba(62, 44, 35, 0.06); 
        transition: all 0.3s ease;
    }
    .premium-table tr td:first-child { border-radius: 25px 0 0 25px; border-left: 1.5px solid rgba(62, 44, 35, 0.06); }
    .premium-table tr td:last-child { border-radius: 0 25px 25px 0; border-right: 1.5px solid rgba(62, 44, 35, 0.06); }
    
    .premium-table tr:hover td { 
        background: #FCFAF8; 
        border-color: #D4A373 !important; 
        transform: translateY(-2px);
    }

    .avatar-box {
        width: 52px; height: 52px; background: #2C1F17; color: #D4A373;
        border-radius: 18px; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 18px;
    }

    /* BADGE STATUS */
    .status-pill { 
        padding: 8px 18px; border-radius: 12px; font-size: 10px; font-weight: 800; text-transform: uppercase; display: inline-flex; align-items: center; gap: 8px; 
        border: 1.5px solid rgba(212, 163, 115, 0.2);
    }
    .status-diajukan, .status-pending { background: #FFF9F2; color: #D4A373; }
    .status-dipinjam { background: #EAF6EC; color: #6DBB80; }
    .status-dikembalikan { background: #F8F9FA; color: #A89C90; }

    /* SIMPLE CONTROL BUTTONS */
    .btn-action {
        width: 38px; height: 38px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; 
        transition: 0.3s; border: none; cursor: pointer; text-decoration: none; font-size: 20px;
    }
    .btn-approve { background: #EAF6EC; color: #6DBB80; border: 1px solid rgba(109, 187, 128, 0.1); }
    .btn-approve:hover { background: #6DBB80; color: white; transform: scale(1.1); }
    
    .btn-reject { background: #FFF4F2; color: #D48E7E; border: 1px solid rgba(212, 142, 126, 0.1); }
    .btn-reject:hover { background: #D48E7E; color: white; transform: scale(1.1); }

    .sub-info { font-size: 11px; color: #A89C90; font-weight: 600; margin-top: 4px; display: block; }
</style>

<div class="admin-workspace">
    {{-- 🔥 FIXED: Font diganti ke Plus Jakarta Sans tebal tanpa serif miring sesuai kemauan kamu --}}
    <div style="margin-bottom: 45px; border-left: 6px solid #D4A373; padding-left: 25px;">
        <h2 style="font-weight: 800; font-size: 38px; letter-spacing: -1.5px; margin: 0; color: #2C1F17;">Arsip Peminjaman.</h2>
        <p style="color: #A89C90; font-size: 15px; font-weight: 600; margin-top: 5px;">Otoritas Verifikasi & Kendali Sirkulasi Koleksi.</p>
    </div>

    <div class="stats-strip">
        <div class="stat-card-luxe">
            <div class="icon-circle"><i class="ri-book-read-fill"></i></div>
            <div>
                <span style="font-size: 11px; font-weight: 800; color: #A89C90; text-transform: uppercase;">TOTAL DATA</span>
                <div style="font-size: 28px; font-weight: 900;">{{ $peminjamans->total() }}</div>
            </div>
        </div>
        <div class="stat-card-luxe">
            <div class="icon-circle" style="background: #FDF9F4; color: #D4A373;"><i class="ri-timer-2-fill"></i></div>
            <div>
                <span style="font-size: 11px; font-weight: 800; color: #A89C90; text-transform: uppercase;">VERIFIKASI</span>
                <div style="font-size: 28px; font-weight: 900;">{{ $peminjamans->whereIn('status', ['diajukan', 'pending'])->count() }}</div>
            </div>
        </div>
        <div class="stat-card-luxe">
            <div class="icon-circle" style="background: #EAF6EC; color: #6DBB80;"><i class="ri-checkbox-circle-fill"></i></div>
            <div>
                <span style="font-size: 11px; font-weight: 800; color: #A89C90; text-transform: uppercase;">STATUS</span>
                <div style="font-size: 16px; font-weight: 800; color: #6DBB80; display: flex; align-items: center; gap: 8px;">
                    <span style="width: 8px; height: 8px; background: #6DBB80; border-radius: 50%; animation: pulse 2s infinite;"></span> AKTIF
                </div>
            </div>
        </div>
    </div>

    <div class="panel-premium">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 35px;">
            <div class="search-wrapper">
                <i class="ri-search-eye-line" style="position:absolute; left:22px; top:18px; color:#D4A373; font-size: 22px;"></i>
                <input type="text" id="searchInput" placeholder="Temukan nama peminjam atau judul koleksi buku...">
            </div>
            <div style="font-size: 11px; font-weight: 800; color: #A89C90; background: #F8F5F2; padding: 10px 20px; border-radius: 12px; margin-bottom: 35px; border: 1px solid rgba(62,44,35,0.05);">
                LOG PER: {{ date('d M Y') }}
            </div>
        </div>

        <div class="table-container-luxe">
            <table class="premium-table" id="peminjamanTable">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Katalog Buku</th>
                        <th>Durasi Pinjam</th>
                        <th>Status</th>
                        <th style="text-align: center;">Kendali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                    @php $st = strtolower($p->status); @endphp
                    <tr class="borrow-row">
                        <td width="25%">
                            <div style="display:flex; align-items:center; gap:20px;">
                                <div class="avatar-box">{{ strtoupper(substr($p->user->name ?? 'U', 0, 1)) }}</div>
                                <div>
                                    <b class="borrower-name" style="display:block; font-size: 16px;">{{ $p->user->name ?? 'User' }}</b>
                                    <span style="font-size:11px; color:#a89c90; font-family: 'JetBrains Mono'; font-weight: 700;">ID: USR-{{ str_pad($p->user->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </td>
                        <td width="25%">
                            <div style="font-weight: 800; color: #2C1F17;">{{ $p->book->judul ?? 'Arsip Kosong' }}</div>
                            <span class="sub-info">{{ $p->book->penulis ?? '-' }}</span>
                        </td>
                        <td>
                            <div style="font-size: 13px; font-weight: 700;">
                                {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d/m/y') }} 
                                <span style="color: #D4A373;">→</span> 
                                {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d/m/y') }}
                            </div>
                        </td>
                        <td>
                            <span class="status-pill status-{{ $st }}">
                                <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%;"></span>
                                {{ strtoupper($p->status) }}
                            </span>
                        </td>
                        <td align="center">
                            <div style="display: flex; justify-content: center; gap: 12px; align-items: center;">
                                @if($st == 'diajukan' || $st == 'pending')
                                    {{-- 🔥 FIXED: Pengalihan rute disamakan memakai route name resmi biar aman hambatannya --}}
                                    <a href="{{ route($prefix . '.setujui', $p->id) }}" class="btn-action btn-approve" title="Setujui">
                                        <i class="ri-check-line"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-reject" title="Tolak" onclick="confirmReject('{{ $p->id }}', '{{ $p->user->name }}')">
                                        <i class="ri-close-line"></i>
                                    </button>
                                @elseif($st == 'dipinjam')
                                    <form action="{{ route($prefix . '.konfirmasi_kembali', $p->id) }}" method="POST" style="display: inline-block; margin: 0;">
                                        @csrf
                                        <button type="submit" class="status-pill status-diajukan" style="border: 1px solid #D4A373; cursor: pointer; font-family: inherit; font-size: 10px; font-weight: 800; padding: 8px 16px; border-radius: 12px; transition: 0.2s;" onmouseover="this.style.background='#D4A373', this.style.color='white'" onmouseout="this.style.background='#FFF9F2', this.style.color='#D4A373'">
                                            <i class="ri-checkbox-circle-line"></i> ACC KEMBALI
                                        </button>
                                    </form>
                                @else
                                    <i class="ri-checkbox-circle-fill" style="color: #6DBB80; font-size: 26px;"></i>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" align="center" style="padding: 100px; color: #A89C90;">
                            ARSIP DATA KOSONG
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }

    document.getElementById('searchInput').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('#peminjamanTable tbody tr.borrow-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    });

    function confirmReject(id, userName) {
        let prefix = "{{ $prefix }}";
        Swal.fire({
            title: 'Tolak Pinjaman?',
            text: `Pengajuan dari "${userName}" akan ditolak.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#D48E7E', 
            cancelButtonColor: '#2C1F17', 
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // 🔥 FIXED: Menggunakan rute nama untuk penolakan
                window.location.href = `{{ url('/') }}/${prefix}/tolak/${id}`;
            }
        });
    }
</script>
@endsection