<!DOCTYPE html>

<html>
<head>
    <title>Perpustakaan Digital</title>

```
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #F5EFE6;
    }

    /* 🔥 NAVBAR SAMA KAYAK SEBELUMNYA */
    .navbar {
        display: flex;
        align-items: center;
        padding: 15px 40px;
        margin: 15px;
        border-radius: 20px;
        background: #F5EFE6;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    }

    .logo {
        font-weight: 600;
        font-size: 20px;
        color: #3e3a35;
    }

    .menu {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .menu a {
        padding: 8px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        color: #6d6257;
    }

    .menu a:hover {
        background: rgba(200,169,126,0.2);
    }

    .menu a.active {
        background: #C8A97E;
        color: white;
    }

    /* HERO (TIDAK DIUBAH) */
    .hero {
        text-align: center;
        padding: 100px 20px;
    }

    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        background: #C8A97E;
        color: white;
        cursor: pointer;
    }
</style>
```

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

```
<div class="logo">📚 LibVerse</div>

<div class="menu">
    <a href="/" class="active">Home</a>
    <a href="/books">Katalog</a>
    <a href="/login">Login</a>
</div>
```

</div>

<!-- HERO (TETAP) -->

<div class="hero">
    <h1>Selamat Datang di Perpustakaan Digital</h1>
    <p>Temukan dan pinjam buku favoritmu 📖</p>

```
<a href="/books">
    <button class="btn">Lihat Katalog</button>
</a>
```

</div>

</body>
</html>
