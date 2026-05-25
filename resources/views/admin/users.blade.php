@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* RESET CONTAINER DEFAULT LARAVEL */
    .content-area { padding: 0 !important; }

    .card-inner { 
        background: transparent !important; 
        box-shadow: none !important; 
        padding: 0 !important; 
        border: none !important;
    }

    /* MASTER WORKSPACE CONTAINER */
    .admin-workspace { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: #2C1F17; 
        padding: 20px 30px;
        animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeIn { 
        from { 
            opacity: 0; 
            transform: translateY(15px); 
        } 

        to { 
            opacity: 1; 
            transform: translateY(0); 
        } 
    }

    /* ================= HEADER BAR BARU ================= */
    .direktori-header-bar{
        width: 100%;
        background: linear-gradient(90deg, #3A2115 0%, #2A160D 100%);
        border-radius: 32px;
        padding: 26px 34px;
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 35px;
        box-shadow: 0 10px 30px rgba(44,31,23,0.10);
    }

    .direktori-icon-box{
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #F3E8DB;
        font-size: 24px;
        flex-shrink: 0;
    }

    .direktori-header-bar h2{
        margin: 0;
        color: #FFF7F0;
        font-size: 38px;
        font-weight: 900;
        letter-spacing: -1.5px;
        line-height: 1;
    }

    .direktori-header-bar p{
        margin: 8px 0 0;
        color: #D8B89A;
        font-size: 14px;
        font-weight: 500;
    }

    /* ==========================================================================
       BENTO COMPONENT 1: KARTU STATISTIK
       ========================================================================== */
    .stats-strip { 
        display: grid; 
        grid-template-columns: repeat(3, 1fr); 
        gap: 25px; 
        margin-bottom: 30px;
    }

    .stat-card-luxe {
        background: #ffffff; 
        padding: 25px 28px; 
        border-radius: 28px; 
        border: 1.5px solid rgba(212, 163, 115, 0.12); 
        display: flex; 
        align-items: center; 
        gap: 20px; 
        box-shadow: 0 10px 30px rgba(62, 44, 35, 0.03);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .stat-card-luxe:hover { 
        transform: translateY(-5px); 
        border-color: #D4A373; 
        box-shadow: 0 20px 40px rgba(62, 44, 35, 0.06); 
    }

    .icon-circle {
        width: 52px; 
        height: 52px; 
        background: #2C1F17; 
        color: #D4A373; 
        border-radius: 16px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 22px; 
        box-shadow: 0 8px 20px rgba(44, 31, 23, 0.12);
    }

    /* ==========================================================================
       BENTO COMPONENT 2: BAR PENCARIAN
       ========================================================================== */
    .search-bento-box {
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

    .search-wrapper { 
        position: relative; 
        flex: 1; 
        max-width: 500px; 
    }

    .search-wrapper input {
        width: 100%; 
        padding: 14px 20px 14px 50px; 
        border-radius: 16px;
        border: 2px solid #F8F5F2; 
        background: #FBFAFA;
        font-weight: 700; 
        font-size: 14px; 
        outline: none; 
        transition: 0.3s; 
        color: #2C1F17;
    }

    .search-wrapper input:focus { 
        border-color: #D4A373; 
        background: white; 
        box-shadow: 0 8px 20px rgba(212, 163, 115, 0.08); 
    }

    .search-wrapper i {
        position: absolute; 
        left: 20px; 
        top: 16px; 
        color: #D4A373; 
        font-size: 20px;
    }

    /* ==========================================================================
       BENTO COMPONENT 3: KOTAK TABEL UTAMA
       ========================================================================== */
    .table-bento-box {
        background: #ffffff;
        border-radius: 32px; 
        padding: 35px;
        border: 1.5px solid rgba(62, 44, 35, 0.06); 
        box-shadow: 0 15px 45px rgba(44, 31, 23, 0.02);
    }

    /* PREMIUM TABLE */
    .table-container-luxe { 
        overflow: visible !important; 
    }

    .premium-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 0 12px; 
    }

    .premium-table th { 
        font-size: 11px; 
        font-weight: 800; 
        color: #A89C90; 
        text-transform: uppercase; 
        letter-spacing: 2px; 
        padding: 0 20px 8px; 
        text-align: left; 
    }
    
    .premium-table td { 
        background: #FDFDFD; 
        padding: 22px 20px; 
        font-size: 14px; 
        font-weight: 700; 
        border-top: 1.5px solid #F6F3EE; 
        border-bottom: 1.5px solid #F6F3EE; 
        transition: all 0.3s ease;
    }

    .premium-table tr td:first-child { 
        border-radius: 20px 0 0 20px; 
        border-left: 1.5px solid #F6F3EE; 
    }

    .premium-table tr td:last-child { 
        border-radius: 0 20px 20px 0; 
        border-right: 1.5px solid #F6F3EE; 
    }
    
    .premium-table tr:hover td { 
        background: #FCFAF8; 
        border-color: #D4A373 !important; 
        transform: translateY(-2px);
    }

    /* AVATAR & BADGES */
    .avatar-initial {
        width: 48px; 
        height: 48px; 
        background: #2C1F17; 
        color: #D4A373;
        border-radius: 15px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-weight: 900; 
        font-size: 16px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
    }

    .role-tag { 
        padding: 6px 14px; 
        border-radius: 10px; 
        font-size: 10px; 
        font-weight: 800; 
        text-transform: uppercase; 
        display: inline-flex; 
        align-items: center; 
        gap: 6px; 
        border: 1.5px solid rgba(212, 163, 115, 0.2);
    }

    .tag-admin { 
        background: #FDF9F4; 
        color: #D4A373; 
    }

    .tag-member { 
        background: #F2F9F4; 
        color: #6DBB80; 
        border-color: rgba(109, 187, 128, 0.1); 
    }

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
        color: #fff;
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
        margin-top: 3px; 
        display: block; 
    }

    @keyframes pulse { 
        0% { opacity: 1; } 
        50% { opacity: 0.4; } 
        100% { opacity: 1; } 
    }

    /* OVERRIDE TEXT & LOGO LAYOUT FOR SWEETALERT2 */
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
    /* Mengatur jarak tombol seperti mockup */
    .swal2-actions {
        gap: 15px !important;
    }
</style>

<div class="admin-workspace">

    <div class="direktori-header-bar">
        <div class="direktori-icon-box">
            <i class="ri-user-star-fill"></i>
        </div>

        <div>
            <h2>Direktori Anggota.</h2>
            <p>Manajemen Basis Data Pembaca dan Otoritas Pengguna.</p>
        </div>
    </div>

    <div class="stats-strip">

        <div class="stat-card-luxe">
            <div class="icon-circle">
                <i class="ri-group-fill"></i>
            </div>

            <div>
                <span style="font-size: 10px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1px;">
                    TOTAL DATABASE
                </span>

                <div style="font-size: 26px; font-weight: 900;">
                    {{ $users->count() }} 
                    <small style="font-size: 13px; color: #A89C90; font-weight: 600;">Anggota</small>
                </div>
            </div>
        </div>

        <div class="stat-card-luxe">
            <div class="icon-circle" style="background: #EAF6EC; color: #6DBB80;">
                <i class="ri-shield-check-fill"></i>
            </div>

            <div>
                <span style="font-size: 10px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1px;">
                    KEAMANAN DATA
                </span>

                <div style="font-size: 15px; font-weight: 800; color: #6DBB80; display: flex; align-items: center; gap: 8px;">
                    <span style="width: 7px; height: 7px; background: #6DBB80; border-radius: 50%; animation: pulse 2s infinite;"></span> 
                    SINKRONISASI AKTIF
                </div>
            </div>
        </div>

        <div class="stat-card-luxe">
            <div class="icon-circle" style="background: #FDF9F4; color: #D4A373;">
                <i class="ri-user-add-fill"></i>
            </div>

            <div>
                <span style="font-size: 10px; font-weight: 800; color: #A89C90; text-transform: uppercase; letter-spacing: 1px;">
                    PENDAFTAR BARU
                </span>

                <div style="font-size: 22px; font-weight: 900;">
                    {{ $users->where('created_at', '>=', now()->subDays(7))->count() }} 
                    <small style="font-size: 12px; color: #A89C90; font-weight: 600;">Kru</small>
                </div>
            </div>
        </div>

    </div>

    <div class="search-bento-box">

        <div class="search-wrapper">
            <i class="ri-search-eye-line"></i>
            <input type="text" id="searchInput" placeholder="Cari nama pengguna atau email...">
        </div>

        <div style="font-size: 11px; font-weight: 800; color: #A89C90; background: #F8F5F2; padding: 8px 16px; border-radius: 12px; border: 1px solid rgba(62,44,35,0.04);">
            LOG UPDATE: {{ date('d M Y') }}
        </div>

    </div>

    <div class="table-bento-box">

        <div style="margin-bottom: 25px;">
            <h3 style="font-weight: 900; font-size: 22px; letter-spacing: -1px; color: #2C1F17; margin: 0;">
                Daftar Pengguna Sistem
            </h3>

            <p style="margin: 4px 0 0; font-size: 12px; color: #A89C90; font-weight: 500;">
                Menampilkan seluruh hak akses pengguna yang sah dalam database.
            </p>
        </div>

        <div class="table-container-luxe">

            <table class="premium-table" id="usersTable">

                <thead>
                    <tr>
                        <th>Identitas Anggota</th>
                        <th>Alamat Domisili</th>
                        <th>Terdaftar Sejak</th>
                        <th style="text-align: right;">Aksi & Otoritas</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($users as $u)

                    <tr class="user-row">

                        <td width="35%">
                            <div style="display:flex; align-items:center; gap:18px;">

                                <div class="avatar-initial">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>

                                <div>
                                    <b class="name-target" style="display:block; font-size: 15px; color: #2C1F17;">
                                        {{ $u->name }}
                                    </b>

                                    <span style="font-size:10px; color:#a89c90; font-family: 'JetBrains Mono'; font-weight: 700;">
                                        ID: USER-{{ str_pad($u->id, 4, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <span class="sub-data">
                                        {{ $u->email }}
                                    </span>
                                </div>

                            </div>
                        </td>

                        <td>
                            <div style="display: flex; align-items: center; gap: 8px; color: #6B5E55; font-size: 13px;">
                                <i class="ri-map-pin-user-fill" style="color: #D4A373; font-size: 16px;"></i>
                                {{ $u->alamat ?? 'Lokasi belum diperbarui' }}
                            </div>
                        </td>

                        <td>
                            <div style="font-size: 13px; font-weight: 800; color: #2C1F17;">
                                {{ $u->created_at->format('d/m/y') }}
                            </div>

                            <span class="sub-data">
                                Pukul: {{ $u->created_at->format('H:i') }} WIB
                            </span>
                        </td>

                        <td align="right">

                            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px;">

                                <span class="role-tag {{ $u->role == 'admin' ? 'tag-admin' : 'tag-member' }}">
                                    <span style="width: 5px; height: 5px; background: currentColor; border-radius: 50%;"></span>

                                    {{ $u->role == 'admin' ? 'Administrator' : 'Anggota Aktif' }}
                                </span>
                                
                                <button type="button" class="btn-delete-luxe" onclick="confirmDelete('{{ $u->id }}', '{{ $u->name }}')">
                                    <i class="ri-delete-bin-6-line"></i>
                                </button>
                                
                                <form id="delete-form-{{ $u->id }}" action="/admin/users/{{ $u->id }}" method="POST" style="display:none;">
                                    @csrf 
                                    @method('DELETE')
                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>
        
        <div id="emptyState" style="display: none; text-align: center; padding: 80px 0;">
            <i class="ri-user-search-line" style="font-size: 45px; color: #EFEBE4; opacity: 0.6;"></i>

            <p style="color: #A89C90; margin-top: 15px; font-weight: 700; font-size: 14px;">
                Pengguna tidak ditemukan dalam database.
            </p>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, name) {

        Swal.fire({
            /* 🔥 Mengganti ikon bawaan dengan menyisipkan Remix Icon lingkaran tipis warna coklat di bagian atas */
            html: `
                <div style="font-size: 64px; color: #C68352; margin-bottom: 15px;">
                    <i class="ri-error-warning-line"></i>
                </div>
                <div class="swal-custom-title">Cabut Akses?</div>
                <div class="swal-custom-text">Akun "${name}" akan dihapus secara permanen dari sistem.</div>
            `,
            background: '#ffffff', /* Tetap putih bersih */
            showCancelButton: true,
            confirmButtonColor: '#C64333', /* Tombol konfirmasi merah bata presisi */
            cancelButtonColor: '#211916',  /* Tombol batal hitam pekat presisi */
            confirmButtonText: 'Ya, Hapus Akun',
            cancelButtonText: 'Batalkan',
            buttonsStyling: true
        }).then((result) => {

            if (result.isConfirmed) { 
                document.getElementById('delete-form-' + id).submit(); 
            }

        });

    }

    // Live Search Script
    document.getElementById('searchInput').addEventListener('keyup', function() {

        let val = this.value.toLowerCase();
        let rows = document.querySelectorAll('#usersTable tbody tr.user-row');
        let found = false;

        rows.forEach(row => {

            let name = row.querySelector('.name-target').innerText.toLowerCase();
            let email = row.innerText.toLowerCase();

            if(name.includes(val) || email.includes(val)) {
                row.style.display = '';
                found = true;
            } else {
                row.style.display = 'none';
            }

        });

        document.getElementById('emptyState').style.display = found ? 'none' : 'block';
        document.getElementById('usersTable').style.display = found ? '' : 'none';

    });
</script>
@endsection