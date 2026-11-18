<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Agrovia</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body {
            background-color: #030303;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
            position: relative;
        }

        /* --- ANIMASI LINGKARAN GLOWING (NEON) --- */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            z-index: 0;
            animation: float 8s infinite alternate ease-in-out;
        }
        .orb-purple {
            width: 400px;
            height: 400px;
            background: rgba(138, 43, 226, 0.3); /* Ungu */
            bottom: 10%;
            right: 15%;
        }
        .orb-green {
            width: 350px;
            height: 350px;
            background: rgba(34, 197, 94, 0.3); /* Hijau */
            top: 10%;
            left: 10%;
            animation-delay: -4s;
        }
        @keyframes float {
            0% { transform: translateY(0px) scale(1); }
            100% { transform: translateY(-30px) scale(1.1); }
        }

        /* --- ANIMASI GAMBAR SAWIT (KANAN BAWAH) --- */
        .palm-tree-bg {
            position: absolute;
            bottom: -30px;
            right: -30px; /* Posisi kanan */
            width: 550px;
            height: auto;
            opacity: 0.25;
            z-index: 0;
            animation: sway 6s infinite alternate ease-in-out;
            transform-origin: bottom right;
            
            mix-blend-mode: luminosity; 
            filter: contrast(120%) brightness(100%);
            pointer-events: none;
        }
        @keyframes sway {
            0% { transform: rotate(3deg); }
            100% { transform: rotate(-3deg); }
        }

        /* --- LAYOUT --- */
        .container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            z-index: 1;
            padding: 20px;
            align-items: center;
            justify-content: space-between;
        }

        .left-side { flex: 1; padding-right: 50px; z-index: 1; }
        .left-side h1 { font-size: 4.5rem; font-weight: 700; margin-bottom: 15px; letter-spacing: -2px; }
        .left-side h1 span { color: #22c55e; } /* Warna hijau untuk "Agrovia" */
        .left-side p { color: #a1a1aa; font-size: 1.1rem; line-height: 1.6; max-width: 450px; }

        /* --- FORM BOX NEON (HIJAU) --- */
        .right-side { flex: 0 0 400px; }
        .register-box {
            background: rgba(10, 10, 10, 0.8);
            border: 2px solid #22c55e; /* Border Hijau */
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.4), inset 0 0 20px rgba(34, 197, 94, 0.2);
            border-radius: 12px;
            padding: 30px 30px;
            backdrop-filter: blur(10px);
        }
        .register-box h2 { text-align: center; font-size: 1.5rem; margin-bottom: 25px; font-weight: 600; }

        .input-group { margin-bottom: 15px; }
        .input-group input {
            width: 100%;
            background: transparent;
            border: 1px solid #3f3f46;
            padding: 12px 15px;
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        .input-group input:focus { outline: none; border-color: #22c55e; box-shadow: 0 0 10px rgba(34, 197, 94, 0.3); }
        .input-group input::placeholder { color: #71717a; }

        .btn-register {
            width: 100%;
            background: linear-gradient(to right, #15803d, #22c55e);
            border: none;
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 15px rgba(34, 197, 94, 0.4);
            margin-top: 10px;
        }
        .btn-register:hover { background: linear-gradient(to right, #166534, #4ade80); box-shadow: 0 0 25px rgba(34, 197, 94, 0.6); }

        .bottom-text { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #a1a1aa; }
        .bottom-text a { color: #22c55e; font-weight: 700; text-decoration: none; transition: all 0.3s; }
        .bottom-text a:hover { text-shadow: 0 0 10px currentColor; }
        
        .error-msg { color: #f87171; font-size: 0.8rem; margin-bottom: 10px; text-align: center; }
    </style>
</head>
<body>

    <!-- Ornamen Glowing -->
    <div class="orb orb-purple"></div>
    <div class="orb orb-green"></div>

    <!-- GAMBAR SAWIT PAKAI LINK (Ganti URL di bawah dengan link gambarmu) -->
    <img src="https://png.pngtree.com/png-clipart/20230105/original/pngtree-palm-fruit-on-transparent-background-png-image_8873069.png" class="palm-tree-bg" alt="Kelapa Sawit">

    <div class="container">
        <!-- Kiri (Teks Agrovia) -->
        <div class="left-side">
            <h1>Join <br><span>Agrovia.</span></h1>
            <p>Bergabunglah dengan sistem informasi perkebunan kelapa sawit masa depan. Mulai kelola lahan, panen, dan pekerja Anda secara digital.</p>
        </div>

        <!-- Kanan (Form Register) -->
        <div class="right-side">
            <div class="register-box">
                <h2>Register</h2>
                
                @if($errors->any())
                    <div class="error-msg">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="/register">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                    
                    <button type="submit" class="btn-register">Sign Up</button>
                </form>

                <div class="bottom-text">
                    Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>