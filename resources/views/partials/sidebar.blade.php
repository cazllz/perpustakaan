<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Suite — Oase.Sastra Control</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --primary: #3e2c23;    /* Warm Chocolate */
            --accent: #d4a373;     /* Silk Gold */
            --bg-linen: #f5efe6;   /* Krem Linen */
            --white: #ffffff;
            --accent-rose: #d69b82; /* Warna aktif persis foto */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-linen);
            height: 100vh;
            overflow: hidden;
            color: var(--primary);
        }

        /* --- MASTER LAYOUT --- */
        .admin-layout {
            display: flex;
            height: 100vh;
            padding: 24px;
            gap: 24px;
        }

        /* --- SIDEBAR PERSIS FOTO --- */
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

        /* Logo Pena Emas Sesuai Request */
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
            margin: 30px 0 15px 15px;
            opacity: 0.5;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            padding: 16px 22px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 6px;
        }

        .nav-link i { font-size: 22px; }

        .nav-link:hover {
            color: var(--white);
            background: rgba(255, 255, 255, 0.05);
        }

        /* State Aktif Warna Peach Gelap Sesuai Foto */
        .nav-link.active {
            background: var(--accent-rose);
            color: var(--primary);
            box-shadow: 0 12px 25px rgba(214, 155, 130, 0.2);
        }

        /* --- MAIN WORKSPACE --- */
        .workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow: hidden; /* Konten yang scroll, bukan workspace-nya */
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

        .content-area {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
            padding-bottom: 20px;
        }
        .content-area::-webkit-scrollbar { display: none; }

        /* Area Card yield content agar rapi melayang */
        .card-inner {
            background: var(--white);
            border-radius: 40px;
            padding: 40px;
            min-height: 100%;
            box-shadow: 0 15px 50px rgba(0,0,0,0.01);
        }

        .btn-exit {
            margin-top: auto;
            color: #ff7675;
            background: rgba(255, 118, 117, 0.05);
        }
        .btn-exit:hover { background: #ff7675; color: white; }
    </style>
</head>
<body>

<div class="admin-layout">
    
    <aside class="sidebar">
        <div class="brand-box">
            <div class="logo-os"><i class="ri-quill-pen-fill"></i></div>
            <span>Oase.Control</span>
        </div>

        <div class="nav-group">
            <p class="nav-label">General</p>
            <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="ri-compass-3-line"></i> Dashboard
            </a>
            <a href="/admin/kategori" class="nav-link {{ request()->is('admin/kategori') ? 'active' : '' }}">
                <i class="ri-compass-3-line"></i> kategori
            </a>
            <a href="/admin/buku" class="nav-link {{ request()->is('admin/buku*') ? 'active' : '' }}">
                <i class="ri-book-read-line"></i> Kelola Buku
            </a>
            <a href="/admin/users" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="ri-group-line"></i> Kelola User
            </a>
            <a href="/admin/peminjaman" class="nav-link {{ request()->is('admin/peminjaman*') ? 'active' : '' }}">
                <i class="ri-calendar-check-line"></i> Peminjaman
            </a>

        
        </div>

        <a href="/logout" class="nav-link btn-exit">
            <i class="ri-logout-box-r-line"></i> Logout
        </a>
    </aside>

    <main class="workspace">
        <header class="top-bar">
            <h2>Panel <span style="color: var(--accent);">Administrator</span></h2>
            
            <div class="admin-profile">
                <span class="admin-name" style="font-size: 12px; font-weight: 800;">{{ auth()->user()->name }}</span>
                <div class="admin-avatar">AD</div>
            </div>
        </header>

        <div class="content-area">
            <div class="card-inner">
                @yield('content')
            </div>
        </div>
    </main>
</div>

</body>
</html>