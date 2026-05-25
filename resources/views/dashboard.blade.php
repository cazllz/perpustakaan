@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    :root {
        --deep: #2c1f17;
        --mocha: #3d2b1f;
        --gold: #d4a373;
        --bg-app: #f5efe6;
    }

    body {
        background-color: var(--bg-app);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--deep);
        margin: 0;
        overflow: hidden; 
    }

    .app-viewport {
        display: flex;
        height: 100vh;
        padding: 24px;
        gap: 24px;
        box-sizing: border-box;
    }

    /* --- SIDEBAR --- */
    .app-sidebar {
        width: 280px;
        background: var(--deep);
        border-radius: 40px;
        display: flex;
        flex-direction: column;
        padding: 45px 25px;
        color: white;
        box-shadow: 0 30px 60px rgba(44, 31, 23, 0.2);
        flex-shrink: 0;
    }

    .brand-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 60px;
        padding-left: 10px;
    }

    .brand-section i {
        background: var(--gold);
        color: var(--deep);
        width: 48px; height: 48px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 16px; font-size: 26px;
    }

    .brand-section span { font-size: 22px; font-weight: 800; letter-spacing: -1px; }

    .nav-btn {
        display: flex; align-items: center; gap: 16px; padding: 16px 22px;
        color: rgba(255,255,255,0.4); text-decoration: none; font-weight: 700;
        font-size: 14px; border-radius: 20px; transition: 0.3s; margin-bottom: 8px;
    }

    .nav-btn.active, .nav-btn:hover { background: rgba(255,255,255,0.08); color: var(--gold); }

    /* --- WORKSPACE --- */
    .app-workspace {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 24px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .search-container-header {
        position: relative;
        width: 100%;
        max-width: 400px;
        margin-bottom: 20px;
    }

    .search-container-header i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gold);
        font-size: 20px;
        z-index: 10;
        pointer-events: none;
    }

    .input-search-premium {
        width: 100%;
        padding: 16px 25px 16px 55px; 
        border-radius: 20px;
        border: 1.5px solid #eae2d8;
        background: white;
        outline: none;
        font-family: inherit;
        font-weight: 600;
        font-size: 14px;
        color: var(--deep);
        transition: 0.3s;
    }

    .input-search-premium:focus {
        border-color: var(--gold);
        box-shadow: 0 10px 25px rgba(212, 163, 115, 0.1);
    }

    .bento-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .glass-card {
        background: white;
        border-radius: 40px;
        padding: 35px;
        box-shadow: 0 10px 40px rgba(44, 31, 23, 0.03);
        border: 1px solid rgba(0,0,0,0.02);
        transition: 0.4s ease;
    }

    .col-2 { grid-column: span 2; }
    .col-4 { grid-column: span 4; }
    .row-2 { grid-row: span 2; }

    .welcome-banner { background: var(--deep); color: white; border: none; }
    .welcome-banner h1 { font-size: 42px; font-weight: 800; margin: 0; letter-spacing: -2px; }
    .welcome-banner p { color: var(--gold); font-size: 16px; margin: 10px 0 0; }

    .stat-number { font-size: 52px; font-weight: 800; display: block; color: var(--deep); }
    .stat-label { font-size: 11px; font-weight: 800; text-transform: uppercase; color: var(--gold); letter-spacing: 2px; }

    .activity-table { width: 100%; border-collapse: collapse; }
    .activity-table td { padding: 18px 0; border-bottom: 1px solid rgba(0,0,0,0.04); }

    .user-avatar {
        width: 48px; height: 48px; background: var(--bg-app); border-radius: 16px;
        display: flex; align-items: center; justify-content: center; font-weight: 800;
        color: var(--deep);
        overflow: hidden; /* 🔥 Tambahan: Biar gambar cover tidak tumpah */
    }

    .app-workspace::-webkit-scrollbar { width: 6px; }
    .app-workspace::-webkit-scrollbar-thumb { background: #dcd7d2; border-radius: 10px; }
</style>

<div class="app-viewport">
    <aside class="app-sidebar">
        <div class="brand-section">
            <i class="ri-book-3-fill"></i>
            <span>Oase Sastra</span>
        </div>
        <nav style="flex: 1;">
            <a href="/dashboard" class="nav-btn active"><i class="ri-dashboard-fill"></i> Dashboard</a>
            <a href="/books" class="nav-btn"><i class="ri-book-open-fill"></i> Katalog</a>
            <a href="/koleksi" class="nav-btn"><i class="ri-heart-fill"></i> Koleksi</a>
            <a href="/profile" class="nav-btn"><i class="ri-user-3-fill"></i> Profil</a>
        </nav>
        <a href="/logout" class="nav-btn" style="color: #ff6b6b;"><i class="ri-logout-box-r-line"></i> Keluar</a>
    </aside>

    <main class="app-workspace">
        <div class="search-container-header">
            <i class="ri-search-2-line"></i>
            <input type="text" class="input-search-premium" placeholder="Cari judul buku atau penulis...">
        </div>

        <div class="bento-grid">
            <div class="glass-card welcome-banner col-2">
                <h1>Halo, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                <p>Temukan petualangan sastra baru hari ini.</p>
            </div>

            @php 
                $pinjamanAktif = \App\Models\Peminjaman::where('user_id', auth()->id())->where('status', 'dipinjam')->first();
                $totalBuku = \App\Models\Book::count();
                $totalStok = \App\Models\Book::sum('stok');
                $peminjaman = \App\Models\Peminjaman::with(['user', 'book'])->latest()->take(4)->get();
            @endphp

            <div class="glass-card col-2" style="{{ $pinjamanAktif ? 'background: var(--gold); border:none;' : '' }}">
                @if($pinjamanAktif)
                    <div style="display: flex; align-items: center; gap: 15px; height: 100%;">
                        <div style="background: var(--deep); color: var(--gold); width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden;">
                             {{-- 🔥 Cover buku yang sedang dibaca --}}
                            <img src="{{ asset('storage/' . $pinjamanAktif->book->cover) }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://via.placeholder.com/45x45?text=?'">
                        </div>
                        <div>
                            <p style="margin:0; font-size: 11px; font-weight: 800; color: var(--deep); opacity: 0.7;">SEDANG DIBACA</p>
                            <p style="margin:0; font-size: 14px; font-weight: 700; color: var(--deep);">{{ $pinjamanAktif->book->judul }}</p>
                            <span style="font-size: 10px; font-weight: 800; color: var(--mocha);">SISA STOK: {{ $pinjamanAktif->book->stok }}</span>
                        </div>
                    </div>
                @else
                    <div style="display: flex; align-items: center; gap: 15px; height: 100%; opacity: 0.5;">
                        <i class="ri-leaf-line" style="font-size: 24px;"></i>
                        <p style="margin:0; font-size: 14px; font-weight: 700;">Tidak ada pinjaman aktif.</p>
                    </div>
                @endif
            </div>

            <div class="glass-card">
                <span class="stat-label">Judul Buku</span>
                <span class="stat-number">{{ number_format($totalBuku) }}</span>
            </div>

            <div class="glass-card">
                <span class="stat-label">Total Stok</span>
                <span class="stat-number" style="color: var(--gold);">{{ number_format($totalStok) }}</span>
            </div>

            <div class="glass-card col-2 row-2">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                    <h3 style="font-weight: 800; margin: 0; font-size: 20px;">Analisis Minat</h3>
                    <span style="font-size: 11px; font-weight: 800; color: var(--gold);">7 HARI TERAKHIR</span>
                </div>
                <canvas id="appChart" height="200"></canvas>
            </div>

            <div class="glass-card col-2 row-2">
                <h3 style="font-weight: 800; margin-bottom: 20px; font-size: 20px;">Aktivitas Terkini</h3>
                <table class="activity-table">
                    @forelse($peminjaman as $p)
                    <tr>
                        <td width="60">
                            {{-- 🔥 GANTI: Dari inisial huruf ke Cover Buku Asli --}}
                            <div class="user-avatar" style="position: relative; background: none;">
                                <img src="{{ asset('storage/' . ($p->book->cover ?? 'default.jpg')) }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;"
                                     onerror="this.src='https://via.placeholder.com/48x48?text={{ substr($p->user->name, 0, 1) }}'">
                                
                                {{-- Inisial User kecil melayang --}}
                                <div style="position: absolute; right: -5px; bottom: -5px; width: 18px; height: 18px; background: var(--gold); color: var(--deep); border-radius: 5px; font-size: 9px; display: flex; align-items: center; justify-content: center; font-weight: 900; border: 1.5px solid white;">
                                    {{ substr($p->user->name, 0, 1) }}
                                </div>
                            </div>
                        </td>
                        <td style="padding-left: 10px;">
                            <p style="margin: 0; font-size: 14px; font-weight: 700;">{{ $p->user->name }}</p>
                            <span style="font-size: 11px; opacity: 0.6;">{{ $p->book->judul }}</span>
                        </td>
                        <td align="right">
                            <span style="font-size: 10px; font-weight: 800; color: var(--gold); display: block;">STOK: {{ $p->book->stok }}</span>
                            <span style="font-size: 10px; font-weight: 700; opacity: 0.4;">
                                {{ $p->created_at->diffForHumans() }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align: center; padding: 40px; opacity: 0.5;">Belum ada aktivitas.</td></tr>
                    @endforelse
                </table>
            </div>

            <div class="glass-card col-4" style="display: flex; justify-content: space-between; align-items: center; background: var(--gold); border: none;">
                <div style="color: var(--deep);">
                    <h3 style="margin:0; font-weight: 800; font-size: 24px;">Jelajahi Dunia Sastra Sekarang</h3>
                    <p style="margin:5px 0 0; font-size: 15px; opacity: 0.9;">Tersedia {{ $totalStok }} buku siap baca untukmu.</p>
                </div>
                <a href="/books" style="background: var(--deep); color: white; padding: 18px 40px; border-radius: 20px; text-decoration: none; font-weight: 800; font-size: 14px;">Buka Katalog</a>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('appChart').getContext('2d');
    const grad = ctx.createLinearGradient(0, 0, 0, 350);
    grad.addColorStop(0, '#d4a373');
    grad.addColorStop(1, 'rgba(212, 163, 115, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                data: [45, 52, 48, 70, 65, 85, 90],
                borderColor: '#d4a373',
                borderWidth: 4,
                tension: 0.4,
                fill: true,
                backgroundColor: grad,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { weight: '700' }, color: '#3d2b1f' } },
                y: { display: false }
            }
        }
    });
</script>
@endsection