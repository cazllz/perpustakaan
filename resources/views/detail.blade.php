@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --primary: #2c1f17;
        --accent: #d4a373;
        --bg-app: #f5efe6;
        --white: #ffffff;
    }

    body {
        background-color: var(--bg-app);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--primary);
        -webkit-font-smoothing: antialiased;
    }

    .container-detail {
        max-width: 1150px;
        margin: 60px auto;
        padding: 0 40px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 50px;
        align-items: start;
    }

    .sticky-box {
        position: sticky;
        top: 100px;
    }

    .cover-card {
        background: var(--white);
        padding: 25px;
        border-radius: 45px;
        box-shadow: 0 30px 60px rgba(44, 31, 23, 0.1);
        text-align: center;
    }

    .cover-img {
        width: 100%;
        aspect-ratio: 3/4.2;
        object-fit: cover;
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(44, 31, 23, 0.25);
    }

    .action-stack {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-premium {
        display: flex; align-items: center; justify-content: center; gap: 12px;
        padding: 18px; border-radius: 20px; font-weight: 800; font-size: 13px;
        text-transform: uppercase; letter-spacing: 1px; cursor: pointer;
        transition: 0.3s; text-decoration: none; border: none;
    }

    .btn-pinjam { background: var(--primary); color: var(--accent); }
    .btn-pinjam:hover { background: #000; transform: translateY(-3px); }

    .btn-koleksi { background: var(--bg-app); color: var(--primary); border: 1.5px solid var(--primary); }
    .btn-koleksi:hover { background: var(--primary); color: var(--accent); }

    .info-card {
        background: var(--white);
        padding: 50px;
        border-radius: 45px;
        box-shadow: 0 10px 40px rgba(44, 31, 23, 0.03);
    }

    .tag-kategori {
        display: inline-block; padding: 8px 18px; background: var(--accent);
        color: var(--primary); border-radius: 12px; font-size: 11px; font-weight: 800;
        text-transform: uppercase; margin-bottom: 25px;
    }

    .title { font-size: 46px; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 10px; }
    .author { font-size: 22px; font-weight: 600; color: var(--accent); margin-bottom: 40px; }

    .meta-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
        margin-bottom: 40px; padding-bottom: 35px; border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .meta-item span { display: block; font-size: 10px; font-weight: 800; color: #a89c90; text-transform: uppercase; margin-bottom: 5px; }
    .meta-item p { font-size: 16px; font-weight: 700; }

    .sinopsis-text {
        color: #5d4a3e; 
        line-height: 1.8;
        white-space: pre-line;
    }

    .ulasan-card {
        background: var(--white); padding: 30px; border-radius: 30px;
        margin-bottom: 20px; border-left: 6px solid var(--accent);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .user-rating {
        color: var(--accent);
        font-size: 14px;
        margin-top: 5px;
    }

    /* SweetAlert Custom Styling */
    .oase-popup {
        border-radius: 35px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
</style>

<div class="container-detail">
    <div class="detail-grid">
        
        <div class="sticky-box">
            <div class="cover-card">
                @if($book->cover)
                    <img class="cover-img" src="{{ asset('storage/'.$book->cover) }}" alt="Cover {{ $book->judul }}" onerror="this.src='https://placehold.co/300x420/fbfbfb/2c1f17?text=No+Image'">
                @else
                    <img class="cover-img" src="https://placehold.co/300x420/fbfbfb/2c1f17?text={{ urlencode($book->judul) }}" alt="No Cover Available">
                @endif
                
                <div class="action-stack">
                    <button onclick="cekPinjam()" class="btn-premium btn-pinjam">
                        <i class="ri-book-open-fill"></i> Pinjam Sekarang
                    </button>

                    <form id="formKoleksi" action="/koleksi/{{ $book->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-premium btn-koleksi" style="width:100%">
                            <i class="ri-heart-3-fill"></i> Simpan Koleksi
                        </button>
                    </form>

                    <a href="/books" style="color: var(--primary); font-size: 12px; font-weight: 700; text-decoration: none; margin-top: 10px; text-align: center;">
                        <i class="ri-arrow-left-line"></i> Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>

        <div class="info-content">
            <div class="info-card">
               <span class="tag-kategori">
    {{ $book->kategori->nama_kategori ?? 'Sastra' }}
</span>
                <h1 class="title">{{ $book->judul }}</h1>
                <p class="author">Karya {{ $book->penulis }}</p>

                <div class="meta-grid">
                    <div class="meta-item"><span>Penerbit</span><p>{{ $book->penerbit }}</p></div>
                    <div class="meta-item"><span>Tahun Terbit</span><p>{{ $book->tahun }}</p></div>
                    <div class="meta-item"><span>Rating Buku</span><p>⭐ {{ $displayRating }}/5</p></div>
                </div>

                <div class="sinopsis">
                    <h4 style="font-weight: 800; margin-bottom: 15px;">Sinopsis</h4>
                  <p class="sinopsis-text">{!! nl2br(e($book->deskripsi)) !!}</p>
                </div>
            </div>

            <div style="margin: 50px 0 25px; display: flex; align-items: center; gap: 15px;">
                <i class="ri-message-3-fill" style="color: var(--accent); font-size: 28px;"></i>
                <h3 style="font-weight: 800;">Ulasan Pembaca</h3>
            </div>

            @forelse($ulasan as $u)
                <div class="ulasan-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <b style="font-size: 16px; color: var(--primary);">{{ $u->nama }}</b>
                            <div class="user-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="ri-star-{{ $i <= $u->rating ? 'fill' : 'line' }}"></i>
                                @endfor
                                <span style="margin-left: 5px; color: #a89c90; font-size: 12px;">({{ $u->rating }}/5)</span>
                            </div>
                        </div>
                        <span style="font-size: 11px; color: #a89c90;">{{ $u->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="margin-top: 15px; color: #5d4a3e; font-style: italic; line-height: 1.6;">
                        "{{ preg_replace('/\s*\[#ID-\d+\]/', '', $u->komentar) }}"
                    </p>
                </div>
            @empty
                <div style="text-align: center; padding: 60px; background: rgba(255,255,255,0.5); border-radius: 40px; border: 2px dashed #dcd7d2;">
                    <i class="ri-chat-delete-line" style="font-size: 40px; color: #dcd7d2; display: block; margin-bottom: 15px;"></i>
                    <p style="color: #a89c90; font-weight: 600;">Belum ada ulasan untuk karya ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Konfigurasi SweetAlert Global
    const Toast = Swal.mixin({
        customClass: { popup: 'oase-popup' },
        confirmButtonColor: '#2c1f17'
    });

    // Alert untuk Peminjaman
    function cekPinjam(){
        let sedangAktif = {{ $pernahPinjam ? 'true' : 'false' }};
        
        if(sedangAktif){
            Toast.fire({
                icon: 'warning',
                title: 'Akses Dibatasi',
                text: 'Maaf Calista, kamu masih memiliki buku yang sedang dipinjam atau dalam masa pengajuan. Selesaikan dulu ya!',
            });
        } else {
            window.location.href = "/pinjam/{{ $book->id }}/form";
        }
    }

    // Handle Session Notifications
    @if(session('success'))
        Toast.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}" });
    @endif

    @if(session('error'))
        Toast.fire({ icon: 'error', title: 'Gagal', text: "{{ session('error') }}" });
    @endif
</script>
@endsection