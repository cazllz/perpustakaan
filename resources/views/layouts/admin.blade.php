<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Suite — Oase.Sastra Control</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #2C1F17;    
            --accent: #d4a373;     
            --bg-linen: #f5efe6;   
            --white: #ffffff;
            --accent-rose: #d69b82; 
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-linen);
            height: 100vh;
            overflow: hidden;
            color: var(--primary);
        }

        .admin-layout {
            display: flex;
            height: 100vh;
            padding: 24px;
            gap: 24px;
        }

        .sidebar {
            width: 300px;
            background: var(--primary);
            border-radius: 40px;
            display: flex;
            flex-direction: column;
            padding: 50px 30px;
            box-shadow: 0 25px 50px rgba(62, 44, 35, 0.15);
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,0.03);
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 50px;
            padding-left: 10px;
        }

        .logo-os {
            width: 45px; height: 45px;
            background: var(--accent);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary);
            font-size: 24px;
            box-shadow: 0 8px 20px rgba(212, 163, 115, 0.2);
        }

        .brand-box span { font-size: 22px; font-weight: 800; color: var(--white); letter-spacing: -1px; }

        .nav-group { 
            flex: 1; 
            overflow-y: auto;
            scrollbar-width: none;
        }
        .nav-group::-webkit-scrollbar { display: none; }

        .nav-label {
            font-size: 10px;
            font-weight: 800;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 25px 0 12px 15px;
            opacity: 0.5;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            padding: 14px 22px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 5px;
        }

        .nav-link i { font-size: 22px; }

        .nav-link:hover {
            color: var(--white);
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            background: var(--accent-rose);
            color: var(--primary);
            box-shadow: 0 12px 25px rgba(214, 155, 130, 0.2);
        }

        .workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow: hidden;
        }

        .top-bar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            padding: 15px 40px;
            border-radius: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px rgba(62, 44, 35, 0.03);
            flex-shrink: 0;
        }

        .top-bar h2 { font-size: 18px; font-weight: 800; }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--white);
            padding: 6px 6px 6px 18px;
            border-radius: 100px;
            border: 1px solid #eee;
        }

        .admin-avatar {
            width: 34px; 
            height: 34px; 
            background: var(--primary); 
            color: var(--accent); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: 800; 
            font-size: 11px;
        }

        .content-area {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
            padding-bottom: 20px;
        }
        .content-area::-webkit-scrollbar { display: none; }

        .card-inner {
            background: var(--white);
            border-radius: 40px;
            padding: 40px;
            min-height: 100%;
            box-shadow: 0 15px 50px rgba(0,0,0,0.01);
        }

        /* --- LOGOUT BUTTON --- */
        .btn-exit {
            margin-top: auto;
            color: #ff7675;
            background: rgba(255, 118, 117, 0.05);
            padding: 14px 22px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: 0.3s;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: left;
        }
        .btn-exit:hover { background: #ff7675; color: white; }

        .oase-popup {
            border-radius: 35px !important;
            padding: 30px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand-box">
            <div class="logo-os"><i class="ri-quill-pen-fill"></i></div>
            <span>Oase.{{ auth()->user()->role == 'admin' ? 'Control' : 'Staff' }}</span>
        </div>

        <div class="nav-group">
            <p class="nav-label">General</p>
            
            @php 
                $role = auth()->user()->role; 
                $prefix = ($role == 'admin') ? 'admin' : 'petugas';
            @endphp

            <a href="/{{ $prefix }}/dashboard" class="nav-link {{ request()->is($prefix.'/dashboard') ? 'active' : '' }}">
                <i class="ri-compass-3-line"></i> Dashboard
            </a>

            @if($role == 'admin')
            <a href="/admin/kategori" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                <i class="ri-folder-line"></i> Kelola Kategori
            </a>
            @endif

            <a href="/{{ $prefix }}/buku" class="nav-link {{ request()->is($prefix.'/buku*') ? 'active' : '' }}">
                <i class="ri-book-read-line"></i> Kelola Buku
            </a>

            @if($role == 'admin')
            <a href="/admin/petugas" class="nav-link {{ request()->is('admin/petugas*') ? 'active' : '' }}">
                <i class="ri-user-settings-line"></i> Kelola Petugas
            </a>
            <a href="/admin/users" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="ri-group-line"></i> Kelola User
            </a>
            @endif

            <a href="/{{ $prefix }}/peminjaman" class="nav-link {{ request()->is($prefix.'/peminjaman*') ? 'active' : '' }}">
                <i class="ri-calendar-check-line"></i> Sirkulasi Pinjam
            </a>

            @if($role == 'admin')
            <a href="/admin/ulasan" class="nav-link {{ request()->is('admin/ulasan*') ? 'active' : '' }}">
                <i class="ri-star-line"></i> Kelola Ulasan
            </a>
            @endif

            <a href="/{{ $prefix }}/laporan" class="nav-link {{ request()->is($prefix.'/laporan*') ? 'active' : '' }}">
                <i class="ri-file-chart-line"></i> Generate Laporan
            </a>

            
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button type="button" onclick="confirmLogout()" class="btn-exit">
            <i class="ri-logout-box-r-line"></i> Logout
        </button>
    </aside>

    <main class="workspace">
        <header class="top-bar">
            <h2>Panel <span style="color: var(--accent);">{{ ucfirst($role) }}</span></h2>
            
            <div class="admin-profile">
                <span class="admin-name" style="font-size: 12px; font-weight: 800;">{{ auth()->user()->name }}</span>
                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
        </header>

        <div class="content-area">
            <div class="card-inner">
                @yield('content')
            </div>
        </div>
    </main>
</div>

<script>
    function confirmLogout() {
        // Ambil nama depan user secara dinamis
        const userDisplayName = "{{ explode(' ', auth()->user()->name)[0] }}";

        Swal.fire({
            title: 'Akhiri Sesi?',
            text: `Pastikan semua pekerjaan kamu sudah tersimpan ya, ${userDisplayName}!`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2C1F17',
            cancelButtonColor: '#ff7675',
            confirmButtonText: 'Ya, Keluar Sekarang',
            cancelButtonText: 'Batal',
            customClass: { popup: 'oase-popup' }
        }).then((result) => {
            // EKSEKUSI FORM POST
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#2C1F17',
            customClass: { popup: 'oase-popup' }
        });
    @endif
</script>

</body>
</html>