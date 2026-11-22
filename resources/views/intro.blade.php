<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inisialisasi Agrovia...</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            width: 100vw;
            height: 100vh;
            background-color: #030303;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: opacity 1s ease-in-out;
        }

        body.fade-out {
            opacity: 0;
        }

        /* --- BACKGROUND GRID & PARTIKEL --- */
        .grid-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(34, 197, 94, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(34, 197, 94, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
            perspective: 500px;
        }

        .particle {
            position: absolute;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 10px #22c55e;
            animation: floatParticle linear infinite;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-10vh) scale(1.5);
                opacity: 0;
            }
        }

        /* --- CONTAINER UTAMA --- */
        .intro-container {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* --- RADAR RINGS --- */
        .radar-wrapper {
            position: relative;
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgba(34, 197, 94, 0.3);
            border-top-color: #22c55e;
            animation: spinRing 2s linear infinite;
        }

        .ring:nth-child(1) {
            width: 180px;
            height: 180px;
            animation-duration: 3s;
            border-left-color: transparent;
        }

        .ring:nth-child(2) {
            width: 220px;
            height: 220px;
            animation-direction: reverse;
            border-bottom-color: transparent;
        }

        @keyframes spinRing {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* --- LOGO GLITCH --- */
        .logo-intro {
            width: 110px;
            height: auto;
            z-index: 2;
            position: relative;
            animation: glitchReveal 2s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        @keyframes glitchReveal {
            0% {
                opacity: 0;
                transform: scale(0.5) translateY(30px);
            }

            20% {
                opacity: 1;
                transform: scale(1.1) translateX(-5px);
                filter: drop-shadow(-5px 0 10px #22c55e);
            }

            30% {
                transform: scale(1) translateX(5px);
                filter: drop-shadow(5px 0 10px #f59e0b);
            }

            40% {
                transform: scale(1) translateX(0);
                filter: drop-shadow(0 0 20px #22c55e);
            }

            100% {
                opacity: 1;
                transform: scale(1.05);
                filter: drop-shadow(0 0 35px rgba(34, 197, 94, 0.8));
            }
        }

        /* --- TEXT TYPING --- */
        .title-text {
            font-family: 'Orbitron', sans-serif;
            color: #ffffff;
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: 8px;
            margin-top: 25px;
            text-shadow: 0 0 15px rgba(34, 197, 94, 0.6);
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid #22c55e;
            width: 0;
            animation: typing 1.5s steps(20, end) forwards 1s, blinkCursor 0.8s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes blinkCursor {
            50% {
                border-color: transparent;
            }
        }

        .subtitle-text {
            font-family: 'Inter', sans-serif;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 5px;
            margin-top: 10px;
            opacity: 0;
            animation: fadeInSub 1s ease-out 2.5s forwards;
        }

        @keyframes fadeInSub {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- LOADING BAR --- */
        .loading-container {
            width: 250px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
            opacity: 0;
            animation: fadeInSub 0.5s ease-out 2s forwards;
        }

        .loading-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #15803d, #22c55e, #4ade80);
            box-shadow: 0 0 10px #22c55e;
            animation: loadProgress 2s cubic-bezier(0.4, 0, 0.2, 1) forwards 2.2s;
        }

        @keyframes loadProgress {
            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }
        }

        .loading-text {
            font-family: 'Orbitron', sans-serif;
            color: #22c55e;
            font-size: 0.65rem;
            letter-spacing: 2px;
            margin-top: 10px;
            text-align: right;
            width: 250px;
            opacity: 0;
            animation: fadeInSub 0.5s ease-out 2.5s forwards;
        }
    </style>
</head>

<body>

    <div class="grid-bg" id="particleContainer"></div>

    <div class="intro-container">
        <div class="radar-wrapper">
            <div class="ring"></div>
            <div class="ring"></div>
            <img src="{{ asset('assets/img/logo-agrovia.png') }}" class="logo-intro" alt="Agrovia Logo">
        </div>

        <div class="title-text">AGROVIA</div>
        <div class="subtitle-text">PALM OIL & AGRICULTURE</div>

        <div class="loading-container">
            <div class="loading-bar"></div>
        </div>
        <div class="loading-text">INITIALIZING SYSTEM...</div>
    </div>

    <script>
        // ==========================================
        // 1. LOGIKA VISUAL (PARTIKEL & REDIRECT)
        // ==========================================
        const container = document.getElementById('particleContainer');
        for (let i = 0; i < 30; i++) {
            let particle = document.createElement('div');
            particle.classList.add('particle');
            let size = Math.random() * 4 + 1;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.left = Math.random() * 100 + 'vw';
            particle.style.animationDuration = (Math.random() * 3 + 2) + 's';
            particle.style.animationDelay = (Math.random() * 2) + 's';
            container.appendChild(particle);
        }

        setTimeout(() => {
            document.body.classList.add('fade-out');
            localStorage.setItem('agrovia_intro_played', 'true');
            setTimeout(() => {
                window.location.href = "{{ url('/login') }}";
            }, 1000);
        }, 4500);

        // ==========================================
        // 2. LOGIKA SUARA (WEB AUDIO API - 0 KB FILE)
        // ==========================================

        // Inisialisasi Audio Context
        let audioCtx;

        function initAudio() {
            if (!audioCtx) {
                audioCtx = new(window.AudioContext || window.webkitAudioContext)();
            }
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
        }

        // Fungsi 1: Suara Bass Drop (Warp Speed) untuk Logo
        function playWarpSound() {
            initAudio();
            if (!audioCtx) return;
            const osc = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();

            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(50, audioCtx.currentTime); // Mulai dari nada rendah
            osc.frequency.exponentialRampToValueAtTime(400, audioCtx.currentTime + 1.5); // Naik cepat

            gainNode.gain.setValueAtTime(0, audioCtx.currentTime);
            gainNode.gain.linearRampToValueAtTime(0.2, audioCtx.currentTime + 0.2);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 1.5);

            osc.connect(gainNode);
            gainNode.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + 1.5);
        }

        // Fungsi 2: Suara Ketikan Komputer (Retro Ticks)
        function playTypingSound() {
            initAudio();
            if (!audioCtx) return;
            // Mainkan suara tik sebanyak 10 kali (menyesuaikan panjang teks)
            let time = audioCtx.currentTime;
            for (let i = 0; i < 10; i++) {
                const osc = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();
                osc.type = 'square';
                osc.frequency.setValueAtTime(800 + (Math.random() * 200), time);

                gainNode.gain.setValueAtTime(0.05, time);
                gainNode.gain.exponentialRampToValueAtTime(0.001, time + 0.05);

                osc.connect(gainNode);
                gainNode.connect(audioCtx.destination);
                osc.start(time);
                osc.stop(time + 0.05);
                time += 0.1; // Jeda antar ketikan
            }
        }

        // Fungsi 3: Suara Chime (System Ready) saat loading selesai
        function playSuccessChime() {
            initAudio();
            if (!audioCtx) return;
            const time = audioCtx.currentTime;

            // Nada Chord (C Major)
            const freqs = [523.25, 659.25, 783.99];
            freqs.forEach((freq, index) => {
                const osc = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(freq, time + (index * 0.1));

                gainNode.gain.setValueAtTime(0, time + (index * 0.1));
                gainNode.gain.linearRampToValueAtTime(0.15, time + (index * 0.1) + 0.05);
                gainNode.gain.exponentialRampToValueAtTime(0.01, time + (index * 0.1) + 1);

                osc.connect(gainNode);
                gainNode.connect(audioCtx.destination);
                osc.start(time + (index * 0.1));
                osc.stop(time + (index * 0.1) + 1);
            });
        }

        // ==========================================
        // 3. SINKRONISASI SUARA DENGAN ANIMASI
        // ==========================================

        // Browsers memblokir suara jika tidak ada interaksi. 
        // Kita coba putar, atau tunggu klik pertama user.
        function attemptAutoplay() {
            playWarpSound();

            // Ketikan mulai pada detik ke-1
            setTimeout(playTypingSound, 1000);

            // Chime mulai pada detik ke-4 (saat loading bar hampir penuh)
            setTimeout(playSuccessChime, 4000);
        }

        // Coba jalankan saat halaman dimuat
        attemptAutoplay();

        // Fallback: Jika browser memblokir suara, aktifkan pada klik pertama
        document.body.addEventListener('click', function triggerAudioOnFirstClick() {
            initAudio();
            attemptAutoplay();
            // Hapus event listener setelah diklik sekali
            document.body.removeEventListener('click', triggerAudioOnFirstClick);
        }, {
            once: true
        });
    </script>

</body>

</html>