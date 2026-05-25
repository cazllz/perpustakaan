@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* RESET CONTAINER DEFAULT LARAVEL (Agar background krem asli bawaan aplikasi meluap bersih) */
    .content-area { padding: 0 !important; }
    .card-inner { 
        background: transparent !important; 
        box-shadow: none !important; 
        padding: 0 !important; 
        border: none !important;
    }

    .admin-workspace { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: #2C1F17; 
        padding: 20px 30px;
        animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeIn { 
        from { opacity: 0; transform: translateY(15px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    /* HEADER PREMIUM FULL */
    .hero-header {
        width: 100%;
        background: linear-gradient(135deg, #2C1F17 0%, #3B2417 50%, #4A2C1D 100%);
        border-radius: 34px;
        padding: 28px 34px;
        margin-bottom: 35px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 18px 40px rgba(44, 31, 23, 0.18);
    }

    .hero-icon {
        width: 62px;
        height: 62px;
        border-radius: 20px;
        background: rgba(255,255,255,0.10);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #E7BE8A;
        font-size: 28px;
        flex-shrink: 0;
    }

    .hero-header h2 {
        margin: 0;
        color: #FFF8F1;
        font-size: 38px;
        font-weight: 900;
        letter-spacing: -1.8px;
        line-height: 1;
    }

    .hero-header p {
        margin: 7px 0 0;
        color: #D8C2AF;
        font-size: 14px;
        font-weight: 500;
    }

    /* BENTO COMPONENT 1: KARTU STATISTIK */
    .stats-strip { 
        display: grid; 
        grid-template-columns: repeat(3, 1fr); 
        gap: 25px; 
        margin-bottom: 30px;
    }

    .stat-card-luxe {
        background: #ffffff; 
        padding: 28px; 
        border-radius: 32px; 
        border: 1.5px solid rgba(212, 163, 115, 0.12); 
        display: flex; 
        align-items: center; 
        gap: 22px; 
        box-shadow: 0 10px 30px rgba(62, 44, 35, 0.03);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .stat-card-luxe:hover { 
        transform: translateY(-5px); 
        border-color: #D4A373; 
        box-shadow: 0 20px 40px rgba(62, 44, 35, 0.06); 
    }

    .icon-circle {
        width: 56px; 
        height: 56px; 
        background: #2C1F17; 
        color: #D4A373; 
        border-radius: 18px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 24px; 
        box-shadow: 0 8px 20px rgba(44, 31, 23, 0.12);
    }

    /* BENTO COMPONENT 2: BAR FILTER CONTROL */
    .filter-bento-box {
        background: #ffffff;
        padding: 15px 25px;
        border-radius: 24px;
        border: 1.5px solid rgba(62, 44, 35, 0.06);
        box-shadow: 0 10px 30px rgba(62, 44, 35, 0.02);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .filter-nexus { 
        display: flex; 
        gap: 15px; 
        align-items: center; 
        flex-wrap: wrap;
    }

    .filter-pill { 
        padding: 12px 25px; 
        border-radius: 100px; 
        background: white; 
        border: 1.5px solid #F5EFE6; 
        color: #A89C90; 
        font-size: 11px; 
        font-weight: 800; 
        cursor: pointer; 
        transition: 0.3s; 
        text-transform: uppercase; 
        letter-spacing: 1px;
        display: flex; 
        align-items: center; 
        gap: 6px;
    }

    .filter-pill.active { 
        background: #2C1F17; 
        color: #D4A373; 
        border-color: #2C1F17; 
        box-shadow: 0 10px 20px rgba(44,31,23,0.15); 
    }

    .filter-pill:hover:not(.active) { 
        border-color: #D4A373; 
        color: #D4A373; 
    }

    /* BENTO COMPONENT 3: KOTAK TABEL UTAMA */
    .panel-premium {
        background: #ffffff; 
        border-radius: 40px; 
        padding: 40px;
        border: 1.5px solid rgba(62, 44, 35, 0.06); 
        box-shadow: 0 15px 45px rgba(44, 31, 23, 0.02);
        overflow: visible !important;
    }

    /* PREMIUM TABLE STYLE */
    .table-container-luxe { 
        padding: 5px; 
        overflow: visible !important; 
    }

    .premium-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0 15px; 
    }

    .premium-table th { 
        font-size: 11px; 
        font-weight: 800; 
        color: #A89C90; 
        text-transform: uppercase; 
        letter-spacing: 2px; 
        padding: 0 25px 12px; 
        text-align: left; 
    }
    
    .premium-table td { 
        background: #ffffff; 
        padding: 25px; 
        font-size: 14px; 
        font-weight: 700; 
        border-top: 1.5px solid #F6F3EE; 
        border-bottom: 1.5px solid #F6F3EE; 
        transition: all 0.3s ease;
    }

    .premium-table tr td:first-child { 
        border-radius: 25px 0 0 25px; 
        border-left: 1.5px solid #F6F3EE; 
    }

    .premium-table tr td:last-child { 
        border-radius: 0 25px 25px 0; 
        border-right: 1.5px solid #F6F3EE; 
    }
    
    .premium-table tr:hover td { 
        background: #FCFAF8; 
        border-color: #D4A373 !important; 
        transform: translateY(-2px);
    }

    /* AVATAR & BOOK STYLE */
    .book-thumb { 
        width: 50px; 
        height: 70px; 
        border-radius: 12px; 
        object-fit: cover; 
        box-shadow: 0 8px 15px rgba(0,0,0,0.1); 
        border: 2px solid white; 
    }

    .avatar-circle {
        width: 45px; 
        height: 45px; 
        background: #2C1F17; 
        color: #D4A373;
        border-radius: 15px; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 900; 
        font-size: 16px; 
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* COMMENT BUBBLE */
    .quote-bubble { 
        background: #FDF9F4; 
        padding: 18px 22px; 
        border-radius: 20px; 
        font-size: 13px; 
        line-height: 1.6; 
        color: #5C4B41; 
        font-style: italic;
        border-left: 4px solid #D4A373; 
        position: relative; 
        margin-top: 10px;
    }

    /* LUXE PREMIUM DELETE BUTTON */
    .btn-delete-luxe {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #ffefef, #ffd6d6);
        color: #d62828;
        border: 1.5px solid rgba(214, 40, 40, 0.25);
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 18px;
        box-shadow: 0 6px 18px rgba(214, 40, 40, 0.08);
    }

    .btn-delete-luxe:hover { 
        background: linear-gradient(135deg, #ff3b3b, #d62828);
        color: white; 
        transform: scale(1.12) rotate(-2deg);
        box-shadow: 0 12px 28px rgba(214, 40, 40, 0.25);
    }

    .btn-delete-luxe:active {
        transform: scale(0.98);
    }

    .sub-data { 
        font-size: 11px; 
        color: #A89C90; 
        font-weight: 600; 
        margin-top: 4px; 
        display: block; 
    }

    @keyframes pulse { 
        0% { opacity: 1; } 
        50% { opacity: 0.4; } 
        100% { opacity: 1; } 
    }

    /* STYLE OVERRIDE POP-UP SWEETALERT2 */
    .swal-custom-title {
        color: #211916 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 28px !important;
    }
    .swal-custom-text {
        color: #211916 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 16px !important;
        opacity: 0.85;
    }
</style>

<div class="admin-workspace">

    <div class="hero-header">
        <div class="hero-icon">
            <i class="ri-chat-quote-fill"></i>
        </div>

        <div>
            <h2>Moderasi Ulasan.</h2>
            <p>Pantau opini pembaca dan jaga kualitas komunitas Oase Sastra.</p>
        </div>
    </div>

    <div class="stats-strip">
        <div class="stat-card-luxe">
            <div class="icon-circle"><i class="ri-chat-smile-3-fill"></i></div>
            <div>
                <span style="font-size: 10px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1px;">TOTAL FEEDBACK</span>
                <div style="font-size: 26px; font-weight: 900;">{{ $ulasans->count() }} <small style="font-size: 13px; color: #A89C90; font-weight: 600;">Ulasan</small></div>
            </div>
        </div>

        <div class="stat-card-luxe">
            <div class="icon-circle" style="background: #FFF9F2; color: #D4A373;"><i class="ri-star-smile-fill"></i></div>
            <div>
                <span style="font-size: 10px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1px;">AVERAGE RATING</span>
                <div style="font-size: 26px; font-weight: 900;">{{ number_format($ulasans->avg('rating') ?? 0, 1) }} <small style="font-size: 13px; color: #D4A373; font-weight: 600;">/ 5.0</small></div>
            </div>
        </div>

        <div class="stat-card-luxe">
            <div class="icon-circle" style="background: #EAF6EC; color: #6DBB80;"><i class="ri-shield-user-fill"></i></div>
            <div>
                <span style="font-size: 10px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1px;">STATUS MODERASI</span>
                <div style="font-size: 15px; font-weight: 800; color: #6DBB80; display: flex; align-items: center; gap: 8px;">
                    <span style="width: 7px; height: 7px; background: #6DBB80; border-radius: 50%; animation: pulse 2s infinite;"></span> SISTEM AKTIF
                </div>
            </div>
        </div>
    </div>

    <div class="filter-bento-box">
        <div class="filter-nexus">
            <div class="filter-pill active" onclick="filterRating('semua', this)">Seluruh Ulasan</div>
            <div class="filter-pill" onclick="filterRating(5, this)">
                <i class="ri-star-fill" style="color:#FFB800;"></i> 5 Bintang
            </div>
            <div class="filter-pill" onclick="filterRating('rendah', this)">
                <i class="ri-alert-fill" style="color:#D48E7E;"></i> Rating Rendah
            </div>
        </div>

        <div style="font-size: 11px; font-weight: 800; color: #A89C90; background: #F8F5F2; padding: 10px 20px; border-radius: 12px; border: 1px solid rgba(62,44,35,0.04);">
            LOG PER: {{ date('d M Y') }}
        </div>
    </div>

    <div class="panel-premium">
        <div style="margin-bottom: 25px;">
            <h3 style="font-weight: 900; font-size: 22px; letter-spacing: -1px; color: #2C1F17; margin: 0;">Daftar Opini Pemustaka</h3>
            <p style="margin: 4px 0 0; font-size: 12px; color: #A89C90; font-weight: 500;">Daftar kritik dan review buku dari komunitas.</p>
        </div>

        <div class="table-container-luxe">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th width="28%">Karya Sastra</th>
                        <th width="25%">Identitas Pembaca</th>
                        <th>Opini & Penilaian</th>
                        <th style="text-align: right; padding-right: 15px;">Aksi</th>
                    </tr>
                </thead>

                <tbody id="ulasanBody">
                    @forelse($ulasans as $u)
                    <tr class="ulasan-row" data-rating="{{ $u->rating }}">
                        <td>
                            <div style="display: flex; align-items: center; gap: 18px;">
                                <img src="{{ $u->book && $u->book->cover ? asset('storage/' . $u->book->cover) : 'https://placehold.co/50x70?text=NA' }}" class="book-thumb">

                                <div>
                                    <div style="font-weight: 900; color: #2C1F17; font-size: 15px; line-height: 1.2;">
                                        {{ $u->book->judul ?? 'Karya Tidak Ditemukan' }}
                                    </div>

                                    <span class="sub-data" style="color: #D4A373;">
                                        ID: #BOK-{{ str_pad($u->book_id, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($u->nama ?? '?', 0, 1)) }}
                                </div>

                                <div>
                                    <div style="font-weight: 900; color: #2C1F17;">
                                        {{ $u->nama ?? 'Pembaca Anonim' }}
                                    </div>

                                    <span class="sub-data">
                                        {{ $u->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div style="margin-bottom: 10px; display: flex; gap: 3px;">
                                @for($i=1; $i<=5; $i++)
                                    <i class="ri-star-fill" style="color: {{ $i <= $u->rating ? '#FFB800' : '#EFEBE4' }}; font-size: 14px;"></i>
                                @endfor
                            </div>

                            <div class="quote-bubble">
                                "{{ isset($u->komentar) ? trim(preg_replace('/\[.*?\]/', '', $u->komentar)) : 'Hanya memberikan penilaian bintang tanpa ulasan teks.' }}"
                            </div>
                        </td>

                        <td align="right">
                            <div style="display: flex; justify-content: flex-end; padding-right: 5px;">
                                <button type="button" class="btn-delete-luxe" onclick="confirmDelete('{{ $u->id }}')">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                            </div>

                            <form id="delete-form-{{ $u->id }}" action="/admin/ulasan/{{ $u->id }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" align="center" style="padding: 120px 0; color: #A89C90;">
                            <i class="ri-chat-history-line" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 15px;"></i>
                            BELUM ADA ULASAN YANG TEREKAM
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
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Ulasan?',
            text: "Opini ini akan dihapus secara permanen dari basis data Oase Sastra.",
            icon: 'warning',
            iconColor: '#D4A373',
            background: '#ffffff', /* 🔥 Back to White (Putih Bersih) Sesuai Keinginanmu */
            showCancelButton: true,
            confirmButtonColor: '#C64333', /* Tombol Konfirmasi Merah Bata */
            cancelButtonColor: '#211916',  /* Tombol Batal Hitam Pekat */
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batalkan',
            customClass: {
                title: 'swal-custom-title',
                htmlContainer: 'swal-custom-text'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    function filterRating(rating, element) {
        document.querySelectorAll('.filter-pill').forEach(pill => 
            pill.classList.remove('active')
        );

        element.classList.add('active');

        const rows = document.querySelectorAll('.ulasan-row');

        rows.forEach(row => {
            const rowRating = parseInt(row.getAttribute('data-rating'));

            if (rating === 'semua') {
                row.style.display = '';
            } 
            else if (rating === 'rendah') {
                row.style.display = rowRating <= 3 ? '' : 'none';
            } 
            else {
                row.style.display = rowRating === rating ? '' : 'none';
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            title: 'Sinkronisasi Berhasil',
            text: "{{ session('success') }}",
            icon: 'success',
            iconColor: '#2C1F17',
            background: '#ffffff', /* 🔥 Putih Bersih */
            confirmButtonColor: '#2C1F17',
            customClass: {
                title: 'swal-custom-title',
                htmlContainer: 'swal-custom-text'
            }
        });
    @endif
</script>
@endsection