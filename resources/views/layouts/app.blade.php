<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oase Sastra — Library Management</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #2c1f17;    /* Deep Chocolate */
            --accent: #d4a373;     /* Silk Gold */
            --bg-linen: #f5efe6;   /* KREM UTAMA */
            --white: #ffffff;
            --sidebar-active: rgba(212, 163, 115, 0.2);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-linen);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* --- NAVBAR TOP --- */
        .navbar-top {
            background-color: var(--primary);
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 60px;
            z-index: 1000;
            flex-shrink: 0;
            position: relative;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            position: absolute;
            left: 60px;
        }

        .quill-icon-nav {
            width: 32px; height: 32px;
            background-color: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .quill-icon-nav i { color: var(--primary); font-size: 18px; }
        .nav-brand span { color: white; font-size: 19px; font-weight: 800; letter-spacing: -0.5px; }

        .nav-links-wrapper { flex: 1; display: flex; justify-content: center; }
        .nav-links { display: flex; gap: 10px; align-items: center; }
        .nav-links a {
            color: rgba(255, 255, 255, 0.5); text-decoration: none; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px; padding: 8px 20px; border-radius: 12px; transition: 0.3s;
        }
        .nav-links a:hover { color: white; }
        .nav-links a.active { background-color: var(--accent); color: var(--primary) !important; }

        .nav-right { position: absolute; right: 60px; display: flex; align-items: center; gap: 15px; }
        
        .user-pill-link {
            text-decoration: none;
            transition: 0.3s;
        }
        .user-pill-link:hover { opacity: 0.8; transform: translateY(-1px); }

        .user-pill {
            display: flex; align-items: center; gap: 10px; background: rgba(255, 255, 255, 0.1);
            padding: 4px 4px 4px 14px; border-radius: 100px; border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .user-pill span { color: white; font-size: 11px; font-weight: 700; }
        .user-pill .avatar {
            width: 28px; height: 28px; background: var(--accent); color: var(--primary);
            border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 10px;
        }

        /* --- MASTER CONTAINER --- */
        .master-container {
            display: flex;
            flex: 1;
            padding: 20px;
            gap: 20px;
            overflow: hidden;
        }

        .sidebar {
            width: 280px;
            background-color: var(--primary);
            border-radius: 40px;
            display: flex;
            flex-direction: column;
            padding: 40px 20px;
            flex-shrink: 0;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }

        .brand-sidebar {
            display: flex; align-items: center; gap: 12px; margin-bottom: 40px; padding-left: 10px;
        }

        .logo-shield {
            width: 45px; height: 45px; 
            border: 2px solid var(--accent); 
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center; 
            color: var(--accent); 
            font-size: 24px;
        }

        .brand-sidebar span { color: white; font-size: 22px; font-weight: 800; }

        .nav-label { font-size: 9px; font-weight: 800; color: var(--accent); text-transform: uppercase; letter-spacing: 2px; margin: 20px 0 12px 12px; opacity: 0.5; }

        .sidebar-item {
            display: flex; align-items: center; gap: 12px; padding: 14px 20px;
            text-decoration: none; color: rgba(255, 255, 255, 0.4);
            font-size: 13px; font-weight: 700; border-radius: 20px; transition: 0.3s;
        }
        .sidebar-item:hover { color: white; background: rgba(255, 255, 255, 0.05); }
        .sidebar-item.active { background: var(--sidebar-active); color: white; }

        /* 🔥 MODIF: Logout Sidebar sekarang Button agar sinkron POST */
        .sidebar-logout { 
            margin-top: auto; padding: 15px 20px; color: #ff7675; cursor: pointer; border: none; background: transparent;
            text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 10px; transition: 0.3s; 
            width: 100%; text-align: left; font-family: inherit;
        }
        .sidebar-logout:hover { opacity: 0.7; }

        .main-workspace {
            flex: 1; display: flex; flex-direction: column; gap: 20px; overflow: hidden;
        }

        .admin-header {
            background: var(--white); height: 75px; border-radius: 25px;
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .white-card {
            background-color: transparent; height: 100%; overflow-y: auto; scrollbar-width: none;
        }
        .white-card::-webkit-scrollbar { display: none; }

        .oase-popup { border-radius: 35px !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
    </style>
</head>
<body>

    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @if(!request()->is('admin*'))
    <nav class="navbar-top">
        <a href="/" class="nav-brand">
            <div class="quill-icon-nav"><i class="ri-quill-pen-fill"></i></div>
            <span>Oase Sastra</span>
        </a>
        <div class="nav-links-wrapper">
            <div class="nav-links">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="/koleksi" class="{{ request()->is('koleksi') ? 'active' : '' }}">Koleksi</a>
                <a href="/profile" class="{{ request()->is('profile*') ? 'active' : '' }}">Profil</a>
            </div>
        </div>
        <div class="nav-right">
            @auth
            <a href="/profile" class="user-pill-link">
                <div class="user-pill">
                    <span>{{ auth()->user()->name }}</span>
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                </div>
            </a>
            {{-- Logout User pemicu Pop-up --}}
            <a href="javascript:void(0)" onclick="confirmLogout()" style="margin-left: 10px; color: var(--accent); font-size: 20px;">
                <i class="ri-logout-box-r-line"></i>
            </a>
            @else
            <a href="/login" style="color: white; text-decoration: none; font-size: 12px; font-weight: 700; letter-spacing: 1px;">LOGIN</a>
            @endauth
        </div>
    </nav>
    @endif

    <div class="master-container">
        @if(auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas') && request()->is('admin*'))
        <aside class="sidebar">
            <div class="brand-sidebar">
                <div class="logo-shield"><i class="ri-quill-pen-fill"></i></div>
                <span>Oase Sastra</span>
            </div>
            <p class="nav-label">GENERAL</p>
            <nav style="display:flex; flex-direction:column; gap:5px;">
                <a href="/admin/dashboard" class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="ri-checkbox-circle-line"></i> Dashboard</a>
                <a href="/admin/kategori" class="sidebar-item {{ request()->is('admin/kategori*') ? 'active' : '' }}"><i class="ri-folder-line"></i> Kelola Kategori</a>
                <a href="/admin/buku" class="sidebar-item {{ request()->is('admin/buku*') ? 'active' : '' }}"><i class="ri-book-3-line"></i> Kelola Buku</a>
                <a href="/admin/petugas" class="sidebar-item {{ request()->is('admin/petugas*') ? 'active' : '' }}"><i class="ri-group-line"></i> Kelola Petugas</a>
                <a href="/admin/users" class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}"><i class="ri-user-follow-line"></i> Kelola User</a>
                <a href="/admin/peminjaman" class="sidebar-item {{ request()->is('admin/peminjaman*') ? 'active' : '' }}"><i class="ri-calendar-event-line"></i> Peminjaman</a>
                <a href="/admin/ulasan" class="sidebar-item {{ request()->is('admin/ulasan*') ? 'active' : '' }}"><i class="ri-chat-3-line"></i> Kelola Ulasan</a>
                <a href="/admin/laporan" class="sidebar-item {{ request()->is('admin/laporan*') ? 'active' : '' }}"><i class="ri-file-list-3-line"></i> Generate Laporan</a>
            </nav>
            {{-- Logout Admin pemicu Pop-up --}}
            <button type="button" onclick="confirmLogout()" class="sidebar-logout">
                <i class="ri-logout-box-r-line"></i> Logout
            </button>
        </aside>
        @endif

        <main class="main-workspace">
            @if(request()->is('admin*'))
            <header class="admin-header">
                <h2 style="font-size: 16px; font-weight: 800;">Panel Administrator: <span style="color:var(--accent)">{{ ucfirst(last(request()->segments())) }}</span></h2>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=d4a373&color=2c1f17" style="width:38px; border-radius:50%; border:2px solid var(--accent);">
                    <div style="background:var(--bg-linen); padding:6px 18px; border-radius:100px; font-size:12px; font-weight:800;">
                        {{ auth()->user()->name }} <span style="color:var(--accent); margin-left:5px;">AD</span>
                    </div>
                </div>
            </header>
            @endif

            <div class="white-card">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function confirmLogout() {
            const userName = "{{ auth()->check() ? explode(' ', auth()->user()->name)[0] : 'User' }}";

            Swal.fire({
                title: 'Akhiri Sesi?',
                text: `Sampai jumpa lagi di Oase Sastra, ${userName}!`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2c1f17',
                cancelButtonColor: '#ff7675',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                customClass: { popup: 'oase-popup' }
            }).then((result) => {
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
                confirmButtonColor: '#2c1f17',
                customClass: { popup: 'oase-popup' }
            });
        @endif
    </script>
</body>
</html>