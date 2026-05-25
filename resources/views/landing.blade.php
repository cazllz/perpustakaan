@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #3d2b1f; /* Deep Espresso */
        --secondary: #634832; /* Mocha */
        --accent: #d4a373; /* Gold Silk */
        --bg: #fdfaf7; /* Creamy White */
        --white: #ffffff;
        --text-muted: #857463;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg);
        margin: 0;
        color: var(--primary);
    }

    /* --- HERO SECTION --- */
    .hero-wrapper {
        position: relative;
        height: 92vh;
        margin: 20px;
        border-radius: 40px;
        overflow: hidden;
        display: flex;
        align-items: center;
        box-shadow: 0 25px 50px rgba(61, 43, 31, 0.15);
    }

    .hero-img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
        transition: transform 1.5s ease;
    }

    .hero-wrapper:hover .hero-img {
        transform: scale(1.05);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(45, 36, 30, 0.9) 30%, rgba(45, 36, 30, 0.3));
    }

    .hero-content {
        position: relative;
        z-index: 10;
        padding-left: 80px;
        max-width: 800px;
        color: var(--white);
    }

    .hero-tagline {
        display: inline-block;
        padding: 8px 16px;
        background: rgba(212, 163, 115, 0.2);
        border: 1px solid var(--accent);
        border-radius: 100px;
        color: var(--accent);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 24px;
        text-transform: uppercase;
    }

    .hero-title {
        font-size: 72px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 25px;
        letter-spacing: -2px;
    }

    .hero-title span { color: var(--accent); }

    .btn-premium {
        display: inline-flex;
        align-items: center;
        padding: 18px 38px;
        background: var(--accent);
        color: var(--white);
        text-decoration: none;
        border-radius: 20px;
        font-weight: 700;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 15px 30px rgba(212, 163, 115, 0.3);
    }

    .btn-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(212, 163, 115, 0.5);
        background: #e5b385;
    }

    /* --- EXCLUSIVE BENEFITS SECTION --- */
    .experience-section {
        background: var(--white);
        margin: 40px 20px;
        border-radius: 40px;
        padding: 100px 60px;
    }

    .experience-header {
        max-width: 1000px;
        margin: 0 auto 60px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }

    .experience-header h2 {
        font-size: 42px;
        font-weight: 800;
        color: var(--primary);
        margin: 10px 0 0;
        letter-spacing: -1px;
    }

    .experience-header p {
        max-width: 400px;
        color: var(--secondary);
        font-size: 16px;
        line-height: 1.6;
        margin: 0;
    }

    .benefit-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .benefit-card {
        padding: 45px 35px;
        background: var(--bg);
        border-radius: 30px;
        border: 1px solid #f0e6dd;
        transition: all 0.4s ease;
    }

    .benefit-card:hover {
        transform: translateY(-10px);
        background: var(--white);
        border-color: var(--accent);
        box-shadow: 0 20px 40px rgba(61, 43, 31, 0.05);
    }

    .benefit-icon {
        font-size: 35px;
        margin-bottom: 25px;
        display: block;
    }

    .benefit-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 15px;
    }

    .benefit-card p {
        color: var(--text-muted);
        line-height: 1.7;
        font-size: 14px;
        margin: 0;
    }

    /* --- INFO BANNER --- */
    .info-banner {
        margin: 0 20px 40px;
        background: var(--primary);
        border-radius: 40px;
        padding: 80px;
        display: flex;
        align-items: center;
        gap: 60px;
        color: var(--white);
    }

    .info-image {
        flex: 1;
        height: 350px;
        border-radius: 25px;
        overflow: hidden;
    }

    .info-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-text {
        flex: 1.2;
    }

    .info-text h2 {
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .info-text p {
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.8;
        font-size: 16px;
        margin-bottom: 30px;
    }

    .stats-row {
        display: flex;
        gap: 40px;
    }

    .stat-item h3 {
        color: var(--accent);
        font-size: 24px;
        margin: 0 0 5px;
    }

    .stat-item p {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 992px) {
        .experience-header, .info-banner { flex-direction: column; align-items: flex-start; padding: 40px; }
        .benefit-grid { grid-template-columns: 1fr; }
        .hero-title { font-size: 50px; }
        .hero-content { padding-left: 40px; }
    }
</style>

<section class="hero-wrapper">
    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000" class="hero-img">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-tagline">Library Boutique Experience</span>
        <h1 class="hero-title">Sentuhan Fisik, <span>Akses Digital.</span></h1>
        <p class="hero-desc" style="font-size: 18px; color: rgba(255,255,255,0.7); margin-bottom: 40px; max-width: 550px;">
            Reservasi buku pilihan Anda secara online dan nikmati kemudahan pengambilan di galeri Oase.Sastra. Menyatukan teknologi dengan kehangatan literatur fisik.
        </p>
        <a href="/dashboard" class="btn-premium">
            Mulai Reservasi &nbsp; 
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </a>
    </div>
</section>

<section class="experience-section">
    <div class="experience-header">
        <div>
            <span style="color: var(--accent); font-weight: 800; letter-spacing: 3px; font-size: 11px; text-transform: uppercase;">Service Excellence</span>
            <h2>Layanan Tanpa Batas</h2>
        </div>
        <p>Kami memastikan setiap detik waktu Anda berharga dengan sistem manajemen peminjaman yang presisi dan elegan.</p>
    </div>

    <div class="benefit-grid">
        <div class="benefit-card">
            <span class="benefit-icon">🏺</span>
            <h3>Reservasi Instan</h3>
            <p>Amankan buku incaran Anda dari mana saja. Sistem kami memastikan koleksi siap saat Anda tiba di galeri.</p>
        </div>
        <div class="benefit-card">
            <span class="benefit-icon">⏳</span>
            <h3>Efisiensi Waktu</h3>
            <p>Ucapkan selamat tinggal pada pencarian rak yang melelahkan. Biarkan tim kami menyiapkan buku pilihan Anda.</p>
        </div>
        <div class="benefit-card">
            <span class="benefit-icon">📜</span>
            <h3>E-Membership</h3>
            <p>Kartu akses digital eksklusif untuk memantau masa pinjam dan riwayat literasi Anda dalam satu aplikasi.</p>
        </div>
    </div>
</section>

<section class="info-banner">
    <div class="info-image">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1000">
    </div>
    <div class="info-text">
        <h2>Komitmen Kenyamanan</h2>
        <p>
            Oase.Sastra hadir untuk mereka yang menghargai aroma kertas dan tekstur halaman buku, namun mendambakan efisiensi modern. Kami mengatur segalanya agar Anda bisa fokus pada apa yang paling penting: menikmati bacaan Anda.
        </p>
        <div class="stats-row">
            <div class="stat-item">
                <h3>15 Min</h3>
                <p>Preparation</p>
            </div>
            <div class="stat-item">
                <h3>14 Days</h3>
                <p>Borrowing Period</p>
            </div>
            <div class="stat-item">
                <h3>No Queue</h3>
                <p>Priority Access</p>
            </div>
        </div>
    </div>
</section>

<footer style="padding: 40px; text-align: center; color: var(--secondary); font-size: 13px; font-weight: 500;">
    &copy; 2026 Oase.Sastra Experience &bull; Heritage & Technology
</footer>

@endsection