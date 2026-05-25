@extends('layouts.admin') {{-- 🔥 FIX PAMUNGKAS: Memakai layout admin yang terbukti kebal crash agar halaman langsung terbuka --}}

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* MASTER WORKSPACE - High End & Full Layout */
    .workspace-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2C1F17;
        padding: 10px;
        /* Menghilangkan risiko konten terpotong */
        overflow: visible !important;
        animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* STATS STRIP - Video Style Shadows & Border */
    .stats-container {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 30px;
    }
    .stat-card-premium {
        background: white; padding: 28px; border-radius: 32px; 
        display: flex; align-items: center; gap: 20px; 
        border: 1.5px solid rgba(62, 44, 35, 0.08); /* Garis cokelat tipis */
        box-shadow: 0 15px 35px rgba(62, 44, 35, 0.04), 0 5px 15px rgba(62, 44, 35, 0.02);
        transition: all 0.3s ease;
    }
    .stat-card-premium:hover { transform: translateY(-5px); border-color: #D4A373; box-shadow: 0 20px 45px rgba(62, 44, 35, 0.08); }

    /* PANEL DESIGN */
    .premium-panel {
        background: white; padding: 40px; border-radius: 40px; 
        border: 1.5px solid rgba(62, 44, 35, 0.08); 
        box-shadow: 0 25px 60px rgba(62, 44, 35, 0.03);
        overflow: visible !important; /* Biar bayangan & hover tidak terpotong */
    }

    /* TABLE DESIGN - Fixed Clipping Issues */
    .premium-table { width: 100%; border-collapse: separate; border-spacing: 0 18px; text-align: left; }
    .premium-table th { font-size: 11px; font-weight: 800; color: #a89c90; text-transform: uppercase; letter-spacing: 2px; padding: 0 25px 12px; }
    
    .premium-table tbody tr td {
        background: #ffffff; padding: 25px; font-size: 14px; font-weight: 700; transition: 0.4s;
        border-top: 1.5px solid rgba(62, 44, 35, 0.08); 
        border-bottom: 1.5px solid rgba(62, 44, 35, 0.08);
        vertical-align: middle;
    }
    
    .premium-table tr td:first-child { 
        border-radius: 25px 0 0 25px; 
        border-left: 1.5px solid rgba(62, 44, 35, 0.08); 
    }
    .premium-table tr td:last-child { 
        border-radius: 0 25px 25px 0; 
        border-right: 1.5px solid rgba(62, 44, 35, 0.08); 
    }

    /* Row Hover Effect */
    .premium-table tr:hover td { 
        background: #FCFAF8; 
        border-color: #D4A373;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(62, 44, 35, 0.03);
    }

    /* BOOK IDENTITAS & TILT EFFECT */
    .book-identitas { display: flex; align-items: center; gap: 20px; }
    
    .book-cover-wrapper {
        width: 60px; height: 85px; flex-shrink: 0;
        border-radius: 12px; overflow: hidden;
        box-shadow: 5px 10px 20px rgba(44, 31, 23, 0.15);
        transition: 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        border: 1px solid rgba(62, 44, 35, 0.1);
    }
    .book-cover-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    
    /* Hover effect persis video */
    .kat-row:hover .book-cover-wrapper { 
        transform: rotateY(-15deg) scale(1.1); 
        box-shadow: 15px 15px 30px rgba(44, 31, 23, 0.2);
    }

    .sub-info { font-size: 11px; color: #a89c90; font-weight: 600; margin-top: 4px; }

    /* BADGE STOK - Formal & Professional */
    .badge-stok {
        padding: 8px 14px; border-radius: 12px; font-size: 11px; font-weight: 800;
        display: inline-flex; align-items: center; gap: 6px; border-width: 1.5px; border-style: solid;
    }

    /* BUTTONS & CONTROLS */
    .btn-action-premium {
        background: #2C1F17; color: #D4A373; padding: 16px 28px; border-radius: 20px; 
        font-weight: 800; font-size: 12px; border: 1px solid rgba(212, 163, 115, 0.2); 
        cursor: pointer; transition: 0.4s; text-decoration: none; 
        display: inline-flex; align-items: center; gap: 10px;
        box-shadow: 0 10px 20px rgba(44, 31, 23, 0.1);
    }
    .btn-action-premium:hover { background: #000; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(0,0,0,0.2); }

    .control-icon {
        width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
        border-radius: 14px; transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        text-decoration: none; border: 1.5px solid rgba(62, 44, 35, 0.08);
    }
    .icon-edit { background: #FDF9F4; color: #2C1F17; }
    .icon-delete { background: #FFF4F2; color: #D48E7E; border-color: rgba(212, 142, 126, 0.1); }
    
    .icon-edit:hover { background: #2C1F17; color: #D4A373; transform: scale(1.1) rotate(-8deg); }
    .icon-delete:hover { background: #D48E7E; color: white; transform: scale(1.1) rotate(8deg); }

    /* SEARCH INPUT */
    .search-wrapper input {
        width: 100%; padding: 18px 25px 18px 60px; border-radius: 22px; 
        border: 2px solid #F8F5F2; outline: none; font-weight: 700; 
        font-size: 14px; color: #2C1F17; background: #FBFAFA; transition: 0.3s;
    }
    .search-wrapper input:focus { border-color: #D4A373; background: white; box-shadow: 0 10px 25px rgba(212, 163, 115, 0.08); }
</style>

<div class="workspace-wrapper">
    <div class="stats-container">
        <div class="stat-card-premium">
            <div style="background: #FAF6F1; color: #D4A373; padding: 18px; border-radius: 20px;"><i class="ri-book-3-fill" style="font-size: 26px;"></i></div>
            <div>
                <p style="font-size: 11px; font-weight: 800; color: #a89c90; margin: 0; letter-spacing: 1px;">TOTAL JUDUL</p>
                <h3 style="font-size: 28px; font-weight: 900; margin: 0;">{{ count($books) }} <small style="font-size: 14px; font-weight: 500; color: #A89C90;">Buku</small></h3>
            </div>
        </div>
        <div class="stat-card-premium">
            <div style="background: #F0F4FF; color: #5C7CFA; padding: 18px; border-radius: 20px;"><i class="ri-stack-fill" style="font-size: 26px;"></i></div>
            <div>
                <p style="font-size: 11px; font-weight: 800; color: #a89c90; margin: 0; letter-spacing: 1px;">TOTAL STOK FISIK</p>
                <h3 style="font-size: 28px; font-weight: 900; margin: 0;">{{ $books->sum('stok') }} <small style="font-size: 14px; font-weight: 500; color: #A89C90;">Eks.</small></h3>
            </div>
        </div>
        <div class="stat-card-premium">
            <div style="background: #EAF6EC; color: #6DBB80; padding: 18px; border-radius: 20px;"><i class="ri-checkbox-circle-fill" style="font-size: 26px;"></i></div>
            <div>
                <p style="font-size: 11px; font-weight: 800; color: #a89c90; margin: 0; letter-spacing: 1px;">STATUS LAYOUT</p>
                <h3 style="font-size: 22px; font-weight: 900; margin: 0; color: #6DBB80;">STABLE</h3>
            </div>
        </div>
    </div>

    <div class="premium-panel">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <div class="search-wrapper" style="position: relative; width: 400px;">
                <i class="ri-search-eye-line" style="position: absolute; left: 22px; top: 50%; transform: translateY(-50%); color: #D4A373; font-size: 20px;"></i>
                <input type="text" id="searchInput" placeholder="Cari data koleksi...">
            </div>
            {{-- 🔥 FIXED: Mengarah lurus ke rute petugas tanpa bentrok --}}
            <a href="{{ route('petugas.buku.tambah') }}" class="btn-action-premium">
                <i class="ri-add-circle-fill"></i> TAMBAH BUKU BARU
            </a>
        </div>

        <div style="overflow-x: auto; padding: 5px;">
            <table class="premium-table" id="booksTable">
                <thead>
                    <tr>
                        <th width="380">Informasi Buku</th>
                        <th>Penulis</th>
                        <th>Status Stok</th>
                        <th>Penerbit</th>
                        <th style="text-align: right;">Kendali Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $b)
                    <tr class="kat-row">
                        <td>
                            <div class="book-identitas">
                                <div class="book-cover-wrapper">
                                    <img src="{{ asset('storage/'.$b->cover) }}" 
                                         onerror="this.src='https://via.placeholder.com/150x220?text=No+Cover'">
                                </div>
                                <div>
                                    <span style="font-weight: 900; color: #2C1F17; font-size: 15px; display: block; line-height: 1.2;">{{ $b->judul }}</span>
                                    <div class="sub-info">REF: #{{ str_pad($b->id, 4, '0', STR_PAD_LEFT) }} • <span style="color: #D4A373;">{{ $b->kategori }}</span></div>
                                </div>
                            </div>
                        </td>
                        <td style="color: #6B5E55; font-weight: 600;">{{ $b->penulis }}</td>
                        <td>
                            @if($b->stok <= 2)
                                <span class="badge-stok" style="background: #FFF4F2; color: #D48E7E; border-color: rgba(212,142,126,0.2);">
                                    <i class="ri-error-warning-line"></i> Sisa {{ $b->stok }} Unit
                                </span>
                            @else
                                <span class="badge-stok" style="background: #F0FAF2; color: #6DBB80; border-color: rgba(109,187,128,0.2);">
                                    <i class="ri-checkbox-circle-line"></i> {{ $b->stok }} Unit Tersedia
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="color: #2C1F17; font-weight: 700;">{{ $b->penerbit }}</div>
                            <div class="sub-info">{{ $b->tahun_terbit }}</div>
                        </td>
                        <td align="right">
                            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                                {{-- 🔥 FIXED: Tombol Edit mengarah ke rute petugas --}}
                                <a href="{{ route('petugas.buku.edit', $b->id) }}" class="control-icon icon-edit" title="Edit">
                                    <i class="ri-pencil-fill"></i>
                                </a>
                                {{-- 🔥 FIXED: Tombol Hapus mengarah ke rute petugas --}}
                                <form action="{{ route('petugas.buku.hapus', $b->id) }}" method="POST" id="delete-form-{{ $b->id }}" style="margin: 0;">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $b->id }}', '{{ $b->judul }}')" class="control-icon icon-delete" title="Hapus">
                                        <i class="ri-delete-bin-7-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" align="center" style="padding: 120px 0; color: #a89c90;">
                            <i class="ri-inbox-archive-line" style="font-size: 48px; display: block; margin-bottom: 15px;"></i>
                            BELUM ADA DATA BUKU
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.kat-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
        });
    });

    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Hapus Data?',
            text: `Buku "${title}" akan dihapus dari sistem.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#D48E7E',
            cancelButtonColor: '#2C1F17',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('delete-form-' + id).submit();
        });
    }

    @if(session('success'))
        Swal.fire({ title: 'Berhasil!', text: "{{ session('success') }}", icon: 'success', confirmButtonColor: '#2C1F17' });
    @endif
</script>
@endsection