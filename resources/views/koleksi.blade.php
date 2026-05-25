@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    :root {
        --bg: #f5efe6; 
        --primary: #2c1f17; 
        --coklat: #8B5E3C; 
        --coklat-light: #c89f72; 
        --accent: #d4a373;
        --white: #ffffff;
        --border-soft: rgba(62, 44, 35, 0.06);
    }

    body { background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; color: var(--primary); -webkit-font-smoothing: antialiased; }
    .viewport { max-width: 1300px; margin: 60px auto; padding: 0 40px; }

    /* --- HEADER --- */
    .header-box { margin-bottom: 60px; }
    .header-box h1 {
        font-size: 56px; font-weight: 800; letter-spacing: -3px; margin: 0;
        background: linear-gradient(to bottom, var(--primary), var(--coklat));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .header-box p { font-size: 17px; font-weight: 500; color: var(--coklat); margin-top: 10px; opacity: 0.8; }

    /* --- GRID --- */
    .grid-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px; }

    /* --- CARD PREMIUM REFINED --- */
    .book-card {
        background: var(--white); 
        border: 1.5px solid var(--border-soft); 
        border-radius: 40px; padding: 30px;
        display: flex; gap: 25px; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 15px 40px rgba(44, 31, 23, 0.02);
    }
    .book-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 30px 60px rgba(44, 31, 23, 0.08); 
        border-color: var(--coklat-light); 
    }

    .cover-img { 
        width: 120px; 
        height: 170px; 
        object-fit: cover; 
        border-radius: 20px; 
        box-shadow: 0 12px 25px rgba(44, 31, 23, 0.12); 
        border: 1px solid var(--border-soft);
        transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); 
    }
    .book-card:hover .cover-img { transform: scale(1.03); }

    .content-box { display: flex; flex-direction: column; justify-content: space-between; min-width: 0; flex: 1; }
    .content-box h3 { font-size: 21px; font-weight: 800; margin: 0; color: var(--primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: -0.5px; }
    .content-box .author { font-size: 14px; color: var(--coklat); margin-top: 5px; font-weight: 600; }

    .tag { 
        display: inline-block; 
        padding: 5px 14px; 
        background: rgba(212, 163, 115, 0.12); 
        color: #B58255; 
        font-size: 10px; 
        font-weight: 800; 
        border-radius: 10px; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        margin-bottom: 12px; 
    }

    /* --- BUTTONS REFINED --- */
    .action-row { display: flex; gap: 12px; margin-top: 15px; align-items: center; }
    
    .btn-main { 
        flex: 1; 
        background: var(--primary); 
        color: var(--accent); 
        padding: 14px; 
        border-radius: 16px; 
        text-decoration: none; 
        font-size: 13px; 
        font-weight: 800; 
        text-align: center; 
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s ease; 
    }
    .btn-main:hover { background: #000000; transform: translateY(-2px); }

    .btn-del { 
        background: #fff; 
        color: #c0392b; 
        border: 1.5px solid var(--border-soft); 
        width: 48px; 
        height: 48px; 
        border-radius: 16px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer; 
        transition: 0.3s ease; 
    }
    .btn-del:hover { background: #c0392b; color: white; border-color: #c0392b; transform: translateY(-2px); }
</style>

<div class="viewport">
    <div class="header-box">
        <h1>Koleksi <span>Pribadi.</span></h1>
        <p>Arsip kurasi buku-buku terbaik pilihan Anda.</p>
    </div>

    <div class="grid-container">
        @forelse($data as $item)
        <article class="book-card">
            <div class="cover-box">
                <img class="cover-img" src="{{ asset('storage/'.$item->cover) }}" onerror="this.src='https://via.placeholder.com/150x220?text=No+Cover'">
            </div>

            <div class="content-box">
                <div>
                    <span class="tag">Favorit</span>
                    <h3>{{ $item->judul }}</h3>
                    <div class="author">by {{ $item->penulis }}</div>
                </div>

                <div class="action-row">
                    <a href="/books/{{ $item->id }}" class="btn-main">Lihat Detail</a>
                    
                    {{-- 🔥 FIX FINAL: Form menembak route 'koleksi.hapus' (URL: /koleksi/hapus/{id}) --}}
                    <form id="delete-form-{{ $item->fav_id }}" action="{{ route('koleksi.hapus', $item->fav_id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-del" onclick="confirmDelete('{{ $item->fav_id }}', '{{ $item->judul }}')">
                            <i class="ri-delete-bin-7-line" style="font-size: 18px;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </article>
        @empty
        <div style="grid-column: 1/-1; padding: 100px; text-align: center; opacity: 0.5;">
            <i class="ri-archive-line" style="font-size: 50px; color: var(--coklat);"></i>
            <p style="margin-top: 20px; font-weight: 700; color: var(--primary);">Belum ada arsip yang disimpan.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    function confirmDelete(id, judul) {
        Swal.fire({
            title: 'Hapus Koleksi?',
            text: `Karya "${judul}" akan dilepaskan dari arsip pribadi Anda.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2c1f17', 
            cancelButtonColor: '#dcd7d2', 
            confirmButtonText: 'Ya, Lepaskan',
            cancelButtonText: 'Batal',
            iconColor: '#d4a373', 
            reverseButtons: true,
            background: '#ffffff',
            customClass: {
                popup: 'premium-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#2c1f17',
            customClass: { popup: 'premium-popup' },
            timer: 2000
        });
    @endif
</script>

<style>
    .premium-popup {
        border-radius: 32px !important;
        padding: 2em !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .swal2-cancel {
        color: #2c1f17 !important;
        font-weight: 700 !important;
        border-radius: 15px !important;
    }
    .swal2-confirm {
        border-radius: 15px !important;
        font-weight: 700 !important;
    }
</style>
@endsection