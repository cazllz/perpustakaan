<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Oase.Sastra</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2c1f17;    /* Deep Cocoa */
            --accent: #d4a373;     /* Silk Gold */
            --bg-app: #f5efe6;     /* Krem Linen */
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-app);
            overflow: hidden;
            position: relative;
        }

        /* ✨ DECORATIVE WATERMARK (Sama seperti Regis) */
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

        /* BOLA CAHAYA HALUS */
        .blob {
            position: absolute;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(212, 163, 115, 0.12), transparent 70%);
            filter: blur(80px);
            z-index: 1;
        }

        /* 🎴 CENTERED LOGIN CARD */
        .login-card {
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 60px 50px;
            border-radius: 50px;
            box-shadow: 0 40px 100px rgba(44, 31, 23, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.6);
            z-index: 5;
            text-align: center;
            animation: cardEntrance 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: scale(0.95) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .brand-logo {
            display: inline-flex; align-items: center; gap: 10px;
            margin-bottom: 25px; color: var(--primary); font-weight: 800; font-size: 20px;
        }
        .brand-logo i { color: var(--accent); font-size: 30px; }

        h2 { font-size: 34px; font-weight: 800; letter-spacing: -2px; color: var(--primary); margin-bottom: 8px; }
        .subtitle { font-size: 14px; color: #a89c90; margin-bottom: 35px; font-weight: 600; }

        /* --- FORM STYLING --- */
        .input-group { margin-bottom: 22px; text-align: left; }
        .input-group label {
            font-size: 10px; font-weight: 800; color: var(--accent);
            letter-spacing: 1.5px; text-transform: uppercase; padding-left: 5px;
            margin-bottom: 10px; display: block;
        }

        .input-wrapper { position: relative; }
        .input-wrapper i {
            position: absolute; left: 20px; top: 50%;
            transform: translateY(-50%); color: #a89c90;
            font-size: 20px; transition: 0.3s;
        }

        input {
            width: 100%; padding: 16px 20px 16px 55px;
            background: rgba(255, 255, 255, 0.9); border: 2.5px solid transparent;
            border-radius: 18px; font-size: 14px; font-weight: 600;
            color: var(--primary); outline: none; transition: 0.3s;
        }

        input:focus {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 10px 25px rgba(212, 163, 115, 0.15);
            transform: translateY(-2px);
        }

        input:focus + i { color: var(--accent); }

        /* --- BUTTON ACTION --- */
        .btn-submit {
            width: 100%; margin-top: 25px; padding: 18px;
            background: var(--primary); color: var(--accent);
            border: none; border-radius: 20px;
            font-size: 14px; font-weight: 800; text-transform: uppercase;
            letter-spacing: 2px; cursor: pointer; transition: 0.4s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .btn-submit:hover {
            background: #000; transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(44, 31, 23, 0.25);
        }

        .footer-link { margin-top: 30px; font-size: 14px; font-weight: 600; color: #a89c90; }
        .footer-link a { color: var(--primary); text-decoration: none; font-weight: 800; border-bottom: 2px solid var(--accent); }
    </style>
</head>
<body>

    <div class="bg-text bg-text-1">OASE.SASTRA</div>
    <div class="bg-text bg-text-2">OASE.SASTRA</div>
    <div class="blob" style="top: -10%; right: -10%;"></div>
    <div class="blob" style="bottom: -10%; left: -10%;"></div>

    <div class="login-card">
        <div class="brand-logo">
            <i class="ri-quill-pen-fill"></i>
            <span>Oase.Sastra</span>
        </div>

        <h2>Masuk Galeri</h2>
        <p class="subtitle">Silakan masuk untuk akses peminjaman.</p>

        @if(session('error'))
            <div style="background: rgba(214, 48, 49, 0.05); color: #d63031; padding: 15px; border-radius: 20px; font-size: 13px; font-weight: 700; margin-bottom: 25px; border: 1px solid rgba(214, 48, 49, 0.1); text-align: left;">
                <i class="ri-error-warning-fill"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="input-group">
                <label>Alamat Email</label>
                <div class="input-wrapper">
                    <i class="ri-mail-line"></i>
                    <input type="email" name="email" placeholder="nama@email.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Kata Sandi</label>
                <div class="input-wrapper">
                    <i class="ri-lock-password-line"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Masuk Sekarang <i class="ri-arrow-right-line"></i>
            </button>
        </form>

        <div class="footer-link">
            Belum punya akses? <a href="/register">Buat Akun</a>
        </div>
    </div>

</body>
</html>