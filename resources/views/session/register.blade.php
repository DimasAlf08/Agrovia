<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Agrovia</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        :root {
            --bg-color: #030303;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --card-bg: rgba(13, 17, 23, 0.85);
            --card-border: rgba(34, 197, 94, 0.4);
            --card-shadow: 0 0 35px rgba(34, 197, 94, 0.22), inset 0 0 15px rgba(34, 197, 94, 0.08);
            --input-bg: rgba(22, 27, 34, 0.8);
            --input-border: #27272a;
            --input-text: #ffffff;
            --brand-green: #22c55e;
            --brand-dark-green: #15803d;
        }

        body.light-theme {
            --bg-color: #f7faf7;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --card-bg: #ffffff;
            --card-border: rgba(22, 163, 74, 0.2);
            --card-shadow: 0 20px 45px -12px rgba(16, 24, 40, 0.08), 0 0 1px 1px rgba(0, 0, 0, 0.04);
            --input-bg: #ffffff;
            --input-border: #e2e8f0;
            --input-text: #0f172a;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 24px 16px;
            transition: background-color 0.3s ease;
        }

        /* --- THEME TOGGLE BUTTON --- */
        .theme-toggle-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: var(--text-main);
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        body.light-theme .theme-toggle-btn {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.1);
            color: #1e293b;
        }

        .theme-toggle-btn:hover {
            transform: scale(1.04);
            border-color: var(--brand-green);
        }

        /* --- ANIMASI GLOWING ORBS --- */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(110px);
            z-index: 0;
            pointer-events: none;
            animation: floatOrb 8s infinite alternate ease-in-out;
        }

        .orb-green {
            width: 420px;
            height: 420px;
            background: rgba(34, 197, 94, 0.22);
            top: 8%;
            left: 8%;
        }

        body.light-theme .orb-green {
            background: rgba(167, 243, 208, 0.65);
        }

        .orb-purple {
            width: 450px;
            height: 450px;
            background: rgba(147, 51, 234, 0.18);
            bottom: 8%;
            right: 10%;
            animation-delay: -4s;
        }

        body.light-theme .orb-purple {
            background: rgba(254, 240, 138, 0.55);
        }

        @keyframes floatOrb {
            0% {
                transform: translateY(0px) scale(1);
            }

            100% {
                transform: translateY(-30px) scale(1.08);
            }
        }

        /* --- ANIMASI GAMBAR KELAPA SAWIT --- */
        .palm-tree-bg {
            position: fixed;
            bottom: -30px;
            right: -30px;
            width: 520px;
            height: auto;
            opacity: 0.2;
            z-index: 0;
            animation: swayTree 7s infinite alternate ease-in-out;
            transform-origin: bottom right;
            pointer-events: none;
            mix-blend-mode: luminosity;
            filter: contrast(120%) brightness(100%);
        }

        body.light-theme .palm-tree-bg {
            opacity: 0.12;
            mix-blend-mode: multiply;
        }

        @keyframes swayTree {
            0% {
                transform: rotate(2deg);
            }

            100% {
                transform: rotate(-2.5deg);
            }
        }

        /* --- MAIN CONTAINER --- */
        .container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            margin: auto;
            z-index: 1;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        /* --- LEFT SIDE BRANDING --- */
        .left-side {
            flex: 1;
            padding-right: 20px;
        }

        .left-side h1 {
            font-size: 4.2rem;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -2px;
            line-height: 1.1;
        }

        .left-side h1 span {
            color: var(--brand-green);
            text-shadow: 0 0 25px rgba(34, 197, 94, 0.4);
        }

        .left-side p {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 460px;
        }

        .feature-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 26px;
        }

        .feature-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.25);
            border-radius: 20px;
            font-size: 0.82rem;
            color: var(--brand-green);
            font-weight: 600;
        }

        /* --- RIGHT SIDE / REGISTER BOX --- */
        .right-side {
            flex: 0 0 430px;
            max-width: 100%;
        }

        .register-box {
            background: var(--card-bg);
            border: 1.5px solid var(--card-border);
            box-shadow: var(--card-shadow);
            border-radius: 26px;
            padding: 38px 34px 34px 34px;
            backdrop-filter: blur(14px);
            text-align: center;
            transition: all 0.3s ease;
        }

        /* ================================================= */
        /* --- ANIMASI LOGO AGROVIA (FLOATING & NEON RING) --- */
        /* ================================================= */
        .logo-wrapper {
            position: relative;
            width: 86px;
            height: 86px;
            margin: 0 auto 12px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .logo-glow-ring {
            position: absolute;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.5) 0%, rgba(34, 197, 94, 0.15) 50%, transparent 72%);
            animation: ringPulse 3.5s infinite ease-in-out;
            z-index: 0;
            pointer-events: none;
        }

        .logo-img {
            position: relative;
            z-index: 1;
            width: 78px;
            height: 78px;
            object-fit: contain;
            filter: drop-shadow(0 0 14px rgba(34, 197, 94, 0.45));
            animation: logoFloat 4.5s infinite ease-in-out;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), filter 0.3s ease;
        }

        .logo-wrapper:hover .logo-img {
            transform: scale(1.12) rotate(2deg);
            filter: drop-shadow(0 0 24px rgba(34, 197, 94, 0.85));
        }

        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-7px) rotate(1.5deg);
            }
        }

        @keyframes ringPulse {

            0%,
            100% {
                transform: scale(0.92);
                opacity: 0.55;
            }

            50% {
                transform: scale(1.22);
                opacity: 0.95;
            }
        }

        /* --- BRAND TITLE & SUB --- */
        .brand-title {
            font-size: 1.38rem;
            font-weight: 800;
            color: var(--brand-green);
            letter-spacing: 2px;
            margin: 0;
            text-transform: uppercase;
            line-height: 1.15;
            text-shadow: 0 0 16px rgba(34, 197, 94, 0.3);
        }

        body.light-theme .brand-title {
            color: #15803d;
            text-shadow: none;
        }

        .brand-tagline {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 4px 0 20px 0;
        }

        .form-heading {
            font-size: 1.22rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 6px 0;
        }

        .form-subheading {
            font-size: 0.84rem;
            color: var(--text-muted);
            margin: 0 0 22px 0;
            line-height: 1.4;
        }

        /* --- NOTIFIKASI ERROR --- */
        .error-alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 0.82rem;
            margin-bottom: 18px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        body.light-theme .error-alert {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }

        /* --- FORM INPUTS DENGAN FOCUS NEON --- */
        .input-group {
            margin-bottom: 14px;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            height: 48px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            padding: 0 16px;
            border-radius: 12px;
            color: var(--input-text);
            font-size: 0.92rem;
            transition: all 0.25s ease;
            box-sizing: border-box;
            outline: none;
        }

        .input-group input::placeholder {
            color: #71717a;
            font-size: 0.88rem;
        }

        .input-group input:focus {
            border-color: var(--brand-green);
            box-shadow: 0 0 16px rgba(34, 197, 94, 0.35);
        }

        /* --- TOMBOL DAFTAR --- */
        .btn-register {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #15803d 0%, #22c55e 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 700;
            font-size: 0.96rem;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.35);
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #166534 0%, #4ade80 100%);
            box-shadow: 0 0 28px rgba(34, 197, 94, 0.55);
            transform: translateY(-1.5px);
        }

        .btn-register:active {
            transform: translateY(1px);
        }

        /* --- LINK BOTTOM --- */
        .bottom-text {
            text-align: center;
            margin-top: 22px;
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .bottom-text a {
            color: var(--brand-green);
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .bottom-text a:hover {
            text-shadow: 0 0 10px rgba(34, 197, 94, 0.6);
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                text-align: center;
            }

            .left-side {
                padding-right: 0;
            }

            .left-side h1 {
                font-size: 3rem;
            }

            .left-side p {
                margin: auto;
            }

            .feature-pills {
                justify-content: center;
            }

            .right-side {
                width: 100%;
                max-width: 440px;
            }
        }

        /* Animasi untuk Form Login */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            /* Terapkan animasi ke container utama */
            animation: fadeInUp 1.2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        
    </style>
</head>

<body>

    <!-- Tombol Ganti Tema Cepat (Dark / Light) -->
    <button class="theme-toggle-btn" id="themeToggle" type="button" title="Ganti Mode Gelap / Terang">
        <span id="themeIcon">☀️</span>
        <span id="themeLabel">Mode Terang</span>
    </button>

    <!-- Ornamen Glowing Neon -->
    <div class="orb orb-green"></div>
    <div class="orb orb-purple"></div>

    <!-- Animasi Gambar Kelapa Sawit -->
    <img src="https://png.pngtree.com/png-clipart/20230105/original/pngtree-palm-fruit-on-transparent-background-png-image_8873069.png" class="palm-tree-bg" alt="Kelapa Sawit">

    <div class="container">
        <!-- Kiri: Branding Agrovia -->
        <div class="left-side">
            <h1>Join <br><span>Agrovia.</span></h1>
            <p>Bergabunglah dengan sistem informasi perkebunan kelapa sawit masa depan. Kelola blok lahan, hasil panen TBS, dan produktivitas pekerja Anda secara digital dan efisien.</p>

            <div class="feature-pills">
                <div class="feature-pill">🌱 Manajemen Blok Lahan</div>
                <div class="feature-pill">📊 Rekapitulasi Panen TBS</div>
                <div class="feature-pill">👥 Monitoring Mandor &amp; Pekerja</div>
            </div>
        </div>

        <!-- Kanan: Form Registrasi Akun Baru -->
        <div class="right-side">
            <div class="register-box">

                {{-- Logo Agrovia dengan Animasi Floating & Neon Ring Pulse --}}
                <div class="logo-wrapper" title="Agrovia Palm Oil & Agriculture">
                    <div class="logo-glow-ring"></div>
                    <img src="{{ asset('assets/img/logo-agrovia.png') }}" class="logo-img" alt="Logo Agrovia">
                </div>

                <h2 class="brand-title">AGROVIA</h2>
                <p class="brand-tagline">PALM OIL &amp; AGRICULTURE</p>

                <h3 class="form-heading">Daftar Akun Baru</h3>
                <p class="form-subheading">Lengkapi formulir untuk membuat akun pengawas kebun</p>

                @if($errors->any())
                <div class="error-alert">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form method="POST" action="{{ url('/register') }}" id="registerForm">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required autofocus autocomplete="name">
                    </div>
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username (misal: mandor123)" value="{{ old('username') }}" required autocomplete="username">
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Alamat Email (misal: nama@email.com)" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Kata Sandi (min. 6 karakter)" required autocomplete="new-password">
                    </div>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn-register" id="btnRegister">
                        Sign Up
                    </button>
                </form>

                <div class="bottom-text">
                    Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Interaktif: Audio Web API & Toggle Tema --}}
    <script>
        (function() {
            // 1. Audio Click Synthesis
            let audioCtx = null;

            function playClickSound() {
                try {
                    const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                    if (!audioCtx && AudioContextClass) audioCtx = new AudioContextClass();
                    if (!audioCtx || audioCtx.state === 'suspended') {
                        audioCtx.resume().catch(() => {});
                        return;
                    }
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(520, audioCtx.currentTime);
                    osc.frequency.exponentialRampToValueAtTime(780, audioCtx.currentTime + 0.05);
                    gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.06);
                    osc.connect(gain);
                    gain.connect(audioCtx.destination);
                    osc.start();
                    osc.stop(audioCtx.currentTime + 0.06);
                } catch (e) {}
            }

            const btn = document.getElementById('btnRegister');
            if (btn) btn.addEventListener('click', playClickSound);

            // 2. Theme Toggle (Dark Mode / Light Mode)
            const toggleBtn = document.getElementById('themeToggle');
            const icon = document.getElementById('themeIcon');
            const label = document.getElementById('themeLabel');

            function applyTheme(isLight) {
                if (isLight) {
                    document.body.classList.add('light-theme');
                    icon.textContent = '🌙';
                    label.textContent = 'Mode Gelap';
                    localStorage.setItem('agrovia_auth_theme', 'light');
                } else {
                    document.body.classList.remove('light-theme');
                    icon.textContent = '☀️';
                    label.textContent = 'Mode Terang';
                    localStorage.setItem('agrovia_auth_theme', 'dark');
                }
            }

            const saved = localStorage.getItem('agrovia_auth_theme');
            if (saved === 'light') applyTheme(true);

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    playClickSound();
                    const isNowLight = !document.body.classList.contains('light-theme');
                    applyTheme(isNowLight);
                });
            }
        })();
    </script>
</body>

</html>