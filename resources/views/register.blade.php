<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oase.Sastra — Registrasi Anggota</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2c1f17;
            --accent: #d4a373;
            --bg: #f5efe6;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg);
            overflow: hidden;
            position: relative;
        }

        /* ✨ DECORATIVE BACKGROUND ELEMENTS */
        .bg-text {
            position: absolute;
            font-size: 15vw;
            font-weight: 900;
            color: rgba(44, 31, 23, 0.03);
            white-space: nowrap;
            z-index: 0;
            user-select: none;
            letter-spacing: -10px;
        }
        .bg-text-1 { top: -5%; left: -5%; }
        .bg-text-2 { bottom: -5%; right: -5%; }

        .blob {
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(212, 163, 115, 0.15), transparent 70%);
            filter: blur(80px);
            z-index: 1;
            animation: move 15s infinite alternate ease-in-out;
        }
        .blob-1 { top: -10%; right: -10%; }
        .blob-2 { bottom: -10%; left: -10%; animation-delay: -5s; }

        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(50px, 50px) scale(1.1); }
        }

        /* 🏛️ REGISTRATION CARD */
        .reg-card {
            width: 100%;
            max-width: 520px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 55px;
            border-radius: 50px;
            box-shadow: 0 40px 100px rgba(44, 31, 23, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.6);
            z-index: 5;
            text-align: center;
            animation: fadeIn 1s cubic-bezier(0.23, 1, 0.32, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .brand-logo {
            display: inline-flex; align-items: center; gap: 10px;
            margin-bottom: 25px; color: var(--primary); font-weight: 800; font-size: 20px;
        }
        .brand-logo i { color: var(--accent); font-size: 28px; }

        h2 { font-size: 34px; font-weight: 800; letter-spacing: -2px; color: var(--primary); margin-bottom: 8px; }
        .subtitle { font-size: 14px; color: #a89c90; margin-bottom: 35px; font-weight: 600; }

        /* FORM GRID */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; text-align: left; }
        .full { grid-column: span 2; }

        .input-box { display: flex; flex-direction: column; gap: 6px; }
        .input-box label {
            font-size: 10px; font-weight: 800; color: var(--accent);
            letter-spacing: 1.5px; text-transform: uppercase; padding-left: 5px;
        }

        input {
            width: 100%; padding: 15px 20px; background: rgba(255, 255, 255, 0.9);
            border: 2px solid transparent; border-radius: 18px;
            font-size: 14px; font-weight: 600; outline: none; transition: 0.3s;
        }

        input:focus {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 10px 25px rgba(212, 163, 115, 0.15);
            transform: translateY(-2px);
        }

        /* BUTTON */
        .btn-submit {
            width: 100%; margin-top: 30px; padding: 18px;
            background: var(--primary); color: var(--accent);
            border: none; border-radius: 20px; font-size: 14px;
            font-weight: 800; text-transform: uppercase; letter-spacing: 2px;
            cursor: pointer; transition: 0.4s;
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }

        .btn-submit:hover {
            background: #000; transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(44, 31, 23, 0.2);
        }

        .footer-link { margin-top: 30px; font-size: 14px; font-weight: 600; color: #a89c90; }
        .footer-link a { color: var(--primary); text-decoration: none; font-weight: 800; border-bottom: 2px solid var(--accent); }

    </style>
</head>
<body>

    <div class="bg-text bg-text-1">OASE.SASTRA</div>
    <div class="bg-text bg-text-2">LITERATURE</div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="reg-card">
        <div class="brand-logo">
            <i class="ri-quill-pen-fill"></i>
            <span>Oase.Sastra</span>
        </div>

        <h2>Daftar Anggota</h2>
        <p class="subtitle">Mulai perjalanan literasi Anda hari ini.</p>

        <form method="POST" action="/register">
            @csrf
            <div class="form-grid">
                <div class="input-box full">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Nama Anda" required>
                </div>

                <div class="input-box">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="input-box">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="user123" required>
                </div>

                <div class="input-box full">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="input-box full">
                    <label>Alamat Lengkap</label>
                    <input type="text" name="alamat" placeholder="Jl. Raya Sastra No. 10" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Daftar & Pinjam <i class="ri-arrow-right-line"></i>
            </button>
        </form>

        <div class="footer-link">
            Sudah punya akun? <a href="/login">Masuk</a>
        </div>
    </div>

</body>
</html>