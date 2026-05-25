@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    :root {
        --bg: #f5efe6;            /* Krem Linen */
        --primary: #2c1f17;       /* Cokelat Tua Gelap */
        --coklat: #8B5E3C;        /* Cokelat Aksen */
        --coklat-light: #c89f72;  /* Emas/Cokelat Muda */
        --glass: rgba(255, 255, 255, 0.75);
        --border-soft: rgba(62, 44, 35, 0.06);
        --white: #ffffff;
    }

    body {
        background: var(--bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--primary);
        -webkit-font-smoothing: antialiased;
    }

    .container-premium {
        max-width: 1300px;
        margin: 0 auto;
        padding: 60px 40px;
    }

    /* --- HEADER SECTION --- */
    .header-section {
        margin-bottom: 60px;
    }

    .title-area h1 {
        font-size: 56px;
        font-weight: 800;
        letter-spacing: -3px;
        margin: 0;
        background: linear-gradient(to bottom, var(--primary), var(--coklat));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .title-area p {
        font-size: 17px;
        font-weight: 500;
        color: var(--coklat);
        margin-top: 10px;
        opacity: 0.8;
    }

    /* --- SEARCH BAR REFINED --- */
    .search-container {
        position: relative;
        max-width: 550px;
        margin-top: 35px;
    }

    .search-container i {
        position: absolute;
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--coklat);
        font-size: 20px;
        pointer-events: none;
        z-index: 10;
    }

    .input-premium {
        width: 100%;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1.5px solid var(--border-soft);
        padding: 18px 25px 18px 60px;
        border-radius: 100px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 600;
        color: var(--primary);
        outline: none;
        box-sizing: border-box;
        transition: 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 10px 30px rgba(44, 31, 23, 0.02);
    }

    .input-premium:focus {
        border-color: var(--accent);
        background: #fff;
        box-shadow: 0 15px 40px rgba(139, 94, 60, 0.08);
    }

    /* --- CATEGORY CHIPS --- */
    .filter-scroll {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        overflow-x: auto;
        padding-bottom: 10px;
        scrollbar-width: none;
    }

    .filter-scroll::-webkit-scrollbar { display: none; }

    .chip {
        padding: 10px 24px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
        white-space: nowrap;
        background: #fff;
        color: var(--coklat);
        border: 1.5px solid var(--border-soft);
    }

    .chip-active {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        box-shadow: 0 10px 20px rgba(44, 31, 23, 0.15);
    }

    .chip:hover:not(.chip-active) {
        border-color: var(--coklat);
        background: var(--bg);
    }

    /* --- BENTO GRID CARDS REFINED --- */
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .book-card {
        background: #ffffff;
        border: 1.5px solid var(--border-soft);
        border-radius: 40px;
        padding: 30px;
        display: flex;
        gap: 25px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 15px 40px rgba(44, 31, 23, 0.02);
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(44, 31, 23, 0.08);
        border-color: var(--coklat-light);
    }

    .cover-wrapper {
        flex-shrink: 0;
        position: relative;
    }

    .cover-wrapper img {
        width: 120px;
        height: 170px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 12px 25px rgba(44, 31, 23, 0.12);
        border: 1px solid var(--border-soft);
        transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .book-card:hover .cover-wrapper img {
        transform: scale(1.03);
    }

    .category-badge {
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

    .book-details {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-width: 0;
    }

    .book-details h3 {
        font-size: 21px;
        font-weight: 800;
        margin: 0;
        color: var(--primary);
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: -0.5px;
    }

    .book-details .author {
        font-size: 14px;
        color: var(--coklat);
        margin-top: 5px;
        font-weight: 600;
    }

    .meta-info {
        font-size: 12px;
        color: #a89c90;
        margin: 10px 0;
        display: flex;
        gap: 10px;
        font-weight: 600;
    }

    .stock-info {
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
    }

    /* --- ACTION BUTTONS --- */
    .action-area {
        display: flex;
        gap: 12px;
        margin-top: 15px;
    }

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

    .btn-main:hover:not(.btn-disabled) {
        background: #000000;
        transform: translateY(-2px);
    }

    .btn-disabled {
        background: #FAF8F5;
        color: #a89c90;
        border: 1.5px solid var(--border-soft);
        cursor: not-allowed;
    }

    /* 🔥 FIX UPDATE: Kontras tombol Detail dipertegas dengan garis & teks cokelat tua solid */
    .btn-outline {
        flex: 1;
        background: #ffffff;
        border: 1.5px solid var(--primary);
        color: var(--primary);
        padding: 14px;
        border-radius: 16px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .btn-outline:hover {
        border-color: var(--primary);
        background: var(--primary);
        color: var(--white);
        box-shadow: 0 8px 20px rgba(44, 31, 23, 0.15);
        transform: translateY(-2px);
    }
</style>

<div class="container-premium">

    <div class="header-section">
        <div class="title-area">
            <h1>Katalog <span>Pustaka.</span></h1>
            <p>Telusuri koleksi terbaik untuk perjalanan sastra Anda.</p>
        </div>

        <div class="search-container">
            <form method="GET" action="/books">
                <i class="ri-search-line"></i>
                <input type="text" name="search" class="input-premium" placeholder="Cari judul, penulis, atau genre..." value="{{ request('search') }}">
            </form>
        </div>

        <div class="filter-scroll">
            <a href="/books" class="chip {{ request('kategori') ? '' : 'chip-active' }}">Semua Koleksi</a>
            
            @foreach($kategoris as $k)
                <a href="/books?kategori={{ $k->nama_kategori }}" class="chip {{ request('kategori') == $k->nama_kategori ? 'chip-active' : '' }}">
                    {{ $k->nama_kategori }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="book-grid">
        @forelse($books as $book)
        <article class="book-card">
            <div class="cover-wrapper">
                <img src="{{ asset('storage/'.$book->cover) }}" onerror="this.src='https://via.placeholder.com/150x220?text=No+Cover'">
            </div>

            <div class="book-details" style="display:flex; flex-direction:column; justify-content:space-between; flex:1;">
                <div>
                    <span class="category-badge">{{ $book->kategori }}</span>
                    <h3>{{ $book->judul }}</h3>
                    <div class="author">by {{ $book->penulis }}</div>
                    <div class="meta-info">
                        <span>{{ $book->tahun ?? $book->tahun_terbit ?? '-' }}</span>
                        <span>•</span>
                        <span>{{ $book->penerbit }}</span>
                    </div>

                    <div class="stock-info" style="color: {{ $book->stok > 0 ? '#2ecc71' : '#e74c3c' }}">
                        <i class="{{ $book->stok > 0 ? 'ri-checkbox-circle-line' : 'ri-error-warning-line' }}"></i>
                        <span>{{ $book->stok > 0 ? 'Tersedia: ' . $book->stok . ' Buku' : 'Stok Habis' }}</span>
                    </div>
                </div>

                <div class="action-area">
                    @if($book->stok > 0)
                        <a href="/pinjam/{{ $book->id }}/form" class="btn-main">Pinjam</a>
                    @else
                        <a href="javascript:void(0)" class="btn-main btn-disabled">Habis</a>
                    @endif
                    <a href="/books/{{ $book->id }}" class="btn-outline">Detail</a>
                </div>
            </div>
        </article>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 100px; opacity: 0.5;">
            <i class="ri-book-open-line" style="font-size: 50px; color: var(--coklat);"></i>
            <p style="margin-top: 15px; font-weight: 700; color: var(--primary);">Buku tidak ditemukan.</p>
        </div>
        @endforelse
    </div>

</div>
@endsection