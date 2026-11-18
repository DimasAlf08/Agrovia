<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agrovia</title>
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
            background: rgba(138, 43, 226, 0.4); /* Ungu */
            top: 10%;
            right: 15%;
        }
        .orb-green {
            width: 300px;
            height: 300px;
            background: rgba(34, 197, 94, 0.2); /* Hijau */
            bottom: 10%;
            left: 10%;
            animation-delay: -4s;
        }
        @keyframes float {
            0% { transform: translateY(0px) scale(1); }
            100% { transform: translateY(-30px) scale(1.1); }
        }

        /* --- ANIMASI GAMBAR SAWIT --- */
        .palm-tree-bg {
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 550px; /* Ukuran gambar */
            height: auto;
            opacity: 0.25; /* Transparansi gambar */
            z-index: 0;
            animation: sway 6s infinite alternate ease-in-out;
            transform-origin: bottom center;
            
            /* Trik agar gambar menyatu dengan dark mode */
            mix-blend-mode: luminosity; 
            filter: contrast(120%) brightness(100%);
            pointer-events: none; /* Agar tidak bisa diklik */
        }
        @keyframes sway {
            0% { transform: rotate(-3deg); }
            100% { transform: rotate(3deg); }
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

        .left-side { flex: 1; padding-right: 50px; z-index: 1;}
        .left-side h1 { font-size: 4.5rem; font-weight: 700; margin-bottom: 15px; letter-spacing: -2px; }
        .left-side h1 span { color: #a855f7; } /* Warna ungu untuk "Agrovia" */
        .left-side p { color: #a1a1aa; font-size: 1.1rem; line-height: 1.6; max-width: 450px; }

        /* --- FORM BOX NEON --- */
        .right-side { flex: 0 0 400px; }
        .login-box {
            background: rgba(10, 10, 10, 0.8);
            border: 2px solid #a855f7; /* Border Ungu */
            box-shadow: 0 0 20px rgba(168, 85, 247, 0.4), inset 0 0 20px rgba(168, 85, 247, 0.2);
            border-radius: 12px;
            padding: 40px 30px;
            backdrop-filter: blur(10px);
        }
        .login-box h2 { text-align: center; font-size: 1.5rem; margin-bottom: 30px; font-weight: 600; }

        .input-group { margin-bottom: 20px; }
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
        .input-group input:focus { outline: none; border-color: #a855f7; box-shadow: 0 0 10px rgba(168, 85, 247, 0.3); }
        .input-group input::placeholder { color: #71717a; }

        .remember { display: flex; align-items: center; font-size: 0.8rem; color: #a1a1aa; margin-bottom: 20px; }
        .remember input { margin-right: 8px; accent-color: #a855f7; }

        .btn-login {
            width: 100%;
            background: linear-gradient(to right, #6b21a8, #a855f7);
            border: none;
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.4);
        }
        .btn-login:hover { background: linear-gradient(to right, #7e22ce, #c084fc); box-shadow: 0 0 25px rgba(168, 85, 247, 0.6); }

        .bottom-text { text-align: center; margin-top: 20px; font-size: 0.8rem; color: #a1a1aa; }
        .bottom-text a { color: #fff; text-decoration: none; transition: all 0.3s; }
        .bottom-text a:hover { text-shadow: 0 0 10px currentColor; }
        .social-login { display: flex; justify-content: center; gap: 15px; margin-top: 15px; }
        .social-login img { width: 24px; cursor: pointer; transition: 0.3s; }
        .social-login img:hover { transform: scale(1.1); }
        
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
            <h1>Welcome <br><span>Agrovia.</span></h1>
            <p>Sistem Informasi Administrasi dan Operasional Perkebunan Kelapa Sawit. Kelola lahan, pekerja, dan hasil panen Anda dengan lebih efisien.</p>
        </div>

        <!-- Kanan (Form) -->
        <div class="right-side">
            <div class="login-box">
                <h2>Login</h2>
                
                @if($errors->any())
                    <div class="error-msg">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="/session">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    
                    <button type="submit" class="btn-login">Login</button>
                </form>

                <div class="bottom-text">
                    <a href="#">Forget Password?</a><br><br>
                    <span>Or</span>
                    <div class="social-login">
                        <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google">
                        <img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook">
                    </div>
                    
                    <p style="margin-top: 20px; font-size: 0.9rem;">
                        Belum punya akun? 
                        <a href="{{ url('/register') }}" style="color: #a855f7; font-weight: 700;">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>