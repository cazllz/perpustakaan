@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

<style>
    :root {
        --bg: #f5efe6;            /* Krem Linen */
        --primary: #2c1f17;       /* Cokelat Tua Gelap */
        --coklat: #8B5E3C;        /* Cokelat Aksen */
        --coklat-light: #c89f72;  /* Emas/Cokelat Muda */
        --white: #ffffff;
    }

    body {
        background: var(--bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--primary);
    }

    .about-wrapper {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 40px;
    }

    /* --- HERO ABOUT --- */
    .about-hero {
        text-align: center;
        padding: 100px 40px;
        margin-bottom: 60px;
        position: relative;
    }

    .about-hero h1 {
        font-size: 64px;
        font-weight: 800;
        letter-spacing: -3px;
        margin: 0;
        background: linear-gradient(to bottom, var(--primary), var(--coklat));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.1;
    }

    .about-hero p {
        font-size: 20px;
        color: var(--coklat);
        max-width: 700px;
        margin: 20px auto 0;
        font-weight: 500;
        opacity: 0.9;
    }

    /* --- BENTO CONTENT GRID --- */
    .about-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .about-card-main {
        background: var(--primary);
        color: var(--white);
        padding: 60px;
        border-radius: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 30px 60px rgba(44, 31, 23, 0.2);
    }

    .about-card-main h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 25px;
        color: var(--coklat-light);
        letter-spacing: -1px;
    }

    .about-card-main p {
        font-size: 17px;
        line-height: 1.8;
        opacity: 0.85;
        font-weight: 400;
    }

    .about-image-card {
        border-radius: 40px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .about-image-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    /* --- FEATURES LIST --- */
    .feature-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 30px;
    }

    .feature-item {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 50px 40px;
        border-radius: 40px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.4);
        transition: 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .feature-item:hover {
        transform: translateY(-15px);
        background: var(--white);
        box-shadow: 0 30px 60px rgba(139, 94, 60, 0.1);
        border-color: var(--coklat-light);
    }

    .feature-icon {
        font-size: 40px;
        margin-bottom: 25px;
        display: block;
        color: var(--coklat);
    }

    .feature-item h3 {
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 15px;
        color: var(--primary);
    }

    .feature-item p {
        font-size: 15px;
        color: var(--coklat);
        line-height: 1.6;
        font-weight: 500;
        opacity: 0.8;
    }

    /* --- VISION BANNER --- */
    .vision-banner {
        background: linear-gradient(135deg, var(--coklat), var(--primary));
        padding: 80px 40px;
        border-radius: 40px;
        text-align: center;
        color: var(--white);
        box-shadow: 0 20px 40px rgba(44, 31, 23, 0.15);
    }

    .vision-banner h3 {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 4px;
        margin-bottom: 20px;
        color: var(--coklat-light);
    }

    .vision-banner p {
        font-size: 28px;
        font-weight: 700;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.4;
        letter-spacing: -0.5px;
    }

    @media (max-width: 992px) {
        .about-grid, .feature-row { grid-template-columns: 1fr; }
        .about-hero h1 { font-size: 48px; }
        .about-card-main { padding: 40px; }
    }
</style>

<div class="about-wrapper">
    <header class="about-hero">
        <h1>Filosofi <span>Oase.Sastra</span></h1>
        <p>Menghidupkan kembali kehangatan literatur fisik melalui kemudahan teknologi digital masa kini.</p>
    </header>

    <section class="about-grid">
        <div class="about-card-main">
            <h2>Visi Kami</h2>
            <p>
                Oase.Sastra bukan sekadar sistem peminjaman buku. Kami adalah sebuah pergerakan untuk mengembalikan budaya membaca buku fisik di tengah hiruk-pikuk dunia digital. 
                <br><br>
                Kami percaya bahwa setiap halaman buku memiliki jiwa yang tak tergantikan. Dengan sistem reservasi digital yang elegan, kami memastikan transisi antara niat membaca menjadi sebuah pengalaman yang mulus dan eksklusif.
            </p>
        </div>
        <div class="about-image-card">
            <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1000" alt="Library Interior">
        </div>
    </section>

    <section class="feature-row">
        <div class="feature-item">
            <span class="feature-icon"><i class="ri-book-open-line"></i></span>
            <h3>Kurasi Terpilih</h3>
            <p>Kami menyediakan koleksi bermutu tinggi, mencakup berbagai genre dari penulis terbaik dunia.</p>
        </div>
        <div class="feature-item">
            <span class="feature-icon"><i class="ri-flashlight-line"></i></span>
            <h3>Akses Prioritas</h3>
            <p>Sistem reservasi memastikan buku Anda sudah disiapkan sebelum Anda tiba di galeri kami.</p>
        </div>
        <div class="feature-item">
            <span class="feature-icon"><i class="ri-bar-chart-2-line"></i></span>
            <h3>Insight Literasi</h3>
            <p>Pantau perjalanan bacaan Anda melalui statistik personal yang dirancang dengan antarmuka estetik.</p>
        </div>
    </section>

    <section class="vision-banner">
        <h3>Our Mission</h3>
        <p>"Menyediakan jembatan modern bagi para pecinta sastra untuk mengakses ilmu pengetahuan dengan cara yang paling terhormat."</p>
    </section>

    <footer style="padding: 80px 0 20px; text-align: center; color: var(--coklat); font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; opacity: 0.6;">
        &copy; 2026 Oase.Sastra Experience &bull; Menjaga Warisan Lewat Teknologi
    </footer>
</div>

@endsection