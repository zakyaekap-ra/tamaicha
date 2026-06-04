<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TAMA & ICHA')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #9370DB; /* Medium Purple */
            --secondary: #E6E6FA; /* Lavender */
            --dark: #4B0082; /* Indigo */
            --accent: #DDA0DD; /* Plum */
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }
        
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0; 
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a0033 0%, #4B0082 100%) fixed;
            min-height: 100vh;
            color: #fff;
            overflow-x: hidden;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background: transparent url('https://www.transparenttextures.com/patterns/stardust.png') repeat;
            opacity: 0.3;
            z-index: 0;
        }

        /* Navigation Bar */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 20px 0;
            background: rgba(26, 0, 51, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 100;
            display: flex;
            justify-content: center;
            border-bottom: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 30px;
        }

        nav ul li a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.1em;
            transition: all 0.3s ease;
            position: relative;
        }

        nav ul li a:hover, nav ul li a.active {
            color: #fff;
            text-shadow: 0 0 10px var(--accent);
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--accent);
            transition: width 0.3s ease;
        }

        nav ul li a:hover::after, nav ul li a.active::after {
            width: 100%;
        }

        /* Main Container */
        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 900px;
            margin: 100px auto 40px; /* offset for fixed nav */
            padding: 20px;
        }

        /* Glass Card */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        .heading-gradient {
            background: linear-gradient(to right, #E6E6FA, #DDA0DD);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .text-center {
            text-align: center;
        }

        /* Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        @keyframes heartbeat {
            0% { transform: scale(1); }
            14% { transform: scale(1.3); }
            28% { transform: scale(1); }
            42% { transform: scale(1.3); }
            70% { transform: scale(1); }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            nav ul {
                gap: 15px;
            }
            nav ul li a {
                font-size: 1.1em;
            }
            .glass-card {
                padding: 25px;
            }
        }
        
        /* Floating Audio Player */
        .floating-audio {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.2em;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            animation: pulse-ring 2s infinite;
        }

        .floating-audio:hover {
            transform: scale(1.1);
            background: var(--accent);
        }

        .floating-audio.paused {
            animation: none;
            background: rgba(255,255,255,0.2);
            color: var(--secondary);
            border: 1px solid var(--glass-border);
        }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(147, 112, 219, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(147, 112, 219, 0); }
            100% { box-shadow: 0 0 0 0 rgba(147, 112, 219, 0); }
        }

        /* Swup Transitions */
        html.is-animating .transition-fade {
            opacity: 0;
        }
        .transition-fade {
            transition: opacity 0.4s ease-in-out;
            opacity: 1;
        }

        /* Welcome Overlay */
        .welcome-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, #1a0033 0%, #4B0082 100%);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 1s ease-in-out;
        }
        .welcome-content {
            text-align: center;
            color: #fff;
            animation: fadeIn 2s ease-out;
            padding: 20px;
            width: 100%;
            max-width: 500px;
        }
        .welcome-content h2 {
            font-size: 3.5em;
            font-family: 'Playfair Display', serif;
            margin-bottom: 10px;
            background: linear-gradient(to right, #E6E6FA, #DDA0DD);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .welcome-content p {
            font-size: 1.2em;
            color: var(--secondary);
            margin-bottom: 30px;
        }
        .welcome-btn {
            padding: 15px 40px;
            background: var(--primary);
            border: none;
            border-radius: 50px;
            color: white;
            font-size: 1.2em;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            animation: pulse-ring 2s infinite;
        }
        .welcome-btn:hover {
            background: var(--accent);
            transform: scale(1.05);
        }

        /* Password Input */
        .password-input {
            padding: 12px 20px;
            border-radius: 30px;
            border: 2px solid var(--accent);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 10px;
            outline: none;
            width: 100%;
            max-width: 280px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        .password-input:focus {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 15px var(--accent);
        }
        .password-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Floating Hearts Animation */
        .floating-heart {
            position: fixed;
            bottom: -50px;
            color: #ff6b6b;
            z-index: 9998;
            animation: floatUp 4s ease-in forwards;
            pointer-events: none;
            opacity: 0.8;
            filter: drop-shadow(0 0 5px rgba(255, 107, 107, 0.5));
        }
        @keyframes floatUp {
            0% { transform: translateY(0) scale(0.5); opacity: 1; }
            100% { transform: translateY(-120vh) scale(1.5); opacity: 0; }
        }

        /* Monkey Failed Animation */
        .monkey-emoji {
            position: absolute;
            font-size: 5em;
            top: 40%;
            left: 50%;
            z-index: 10000;
            animation: monkeyWiggle 1.5s ease-in-out forwards;
            pointer-events: none;
        }

        @keyframes monkeyWiggle {
            0% { transform: translate(-50%, 100px) scale(0); opacity: 0; }
            20% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            40% { transform: translate(-50%, -50%) scale(1) rotate(-20deg); }
            60% { transform: translate(-50%, -50%) scale(1) rotate(20deg); }
            80% { transform: translate(-50%, -50%) scale(1) rotate(0deg); opacity: 1; }
            100% { transform: translate(-50%, 100px) scale(0); opacity: 0; }
        }
        /* Mobile Responsiveness */
        @media (max-width: 480px) {
            .welcome-content h2 { font-size: 2.5em; }
            .welcome-content p { font-size: 1em; }
            .password-input { font-size: 1.1em; padding: 10px 15px; }
            .welcome-btn { font-size: 1.1em; padding: 12px 30px; }
            .monkey-emoji { font-size: 4em; }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Welcome Overlay -->
    <div id="welcomeOverlay" class="welcome-overlay">
        <div class="welcome-content">
            <h2>TAMA & ICHA</h2>
            <p>Ada kenangan manis yang menunggu untuk dibuka...</p>
            
            @if(!session('unlocked'))
                <input type="password" id="secretPassword" placeholder="Masukkan Password" class="password-input" onkeypress="handleEnter(event)" oninput="hideError()">
                <br>
                <p id="loginError" style="color:#ff6b6b; display:none; font-size:0.9em; margin-bottom:15px; text-shadow: 0 0 5px rgba(0,0,0,0.5);">Password salah, coba lagi!</p>
                <button onclick="attemptLogin()" class="welcome-btn" id="loginBtn"><i class="fa-solid fa-lock"></i> Buka Memori</button>
            @else
                <button onclick="startExperience()" class="welcome-btn"><i class="fa-solid fa-heart"></i> Lanjutkan Memori</button>
            @endif
        </div>
    </div>

    <div class="stars"></div>
    
    <nav>
        <ul id="main-nav">
            <li><a href="/" class="nav-link" data-path="/">Home</a></li>
            <li><a href="/gallery" class="nav-link" data-path="/gallery">Gallery Foto</a></li>
        </ul>
    </nav>

    <div class="container">
        <!-- SWUP CONTAINER -->
        <main id="swup" class="transition-fade">
            @yield('content')
        </main>
    </div>

    <!-- Floating Audio Player -->
    <div class="floating-audio paused" id="audioController" onclick="toggleGlobalAudio()" title="Putar Musik">
        <i class="fa-solid fa-music" id="globalAudioIcon"></i>
    </div>
    <!-- Lagu Spesial Kalian -->
    <!-- atribut autoplay saya hilangkan agar musik hanya menyala saat tombol Buka diklik -->
    <audio id="globalAudio" src="{{ asset('audio/ytmp3free.cc_hindia-everything-u-are-youtubemp3free.org.mp3') }}" loop></audio>

    <!-- Swup JS -->
    <script src="https://unpkg.com/swup@4"></script>
    <script>
        // Audio Logic
        const globalAudio = document.getElementById('globalAudio');
        const audioController = document.getElementById('audioController');

        // Note: auto-play dihapus dari onload karena kita menggunakan tombol Buka Memori
        window.addEventListener('DOMContentLoaded', () => {
            updateNav();
            initGalleryScripts();
        });

        // Update Navbar Active State on page view
        function updateNav() {
            const path = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('data-path') === path) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        // Fitur responsif menekan Enter pada input password
        function handleEnter(e) {
            if(e.key === 'Enter') {
                attemptLogin();
            }
        }
        function hideError() {
            document.getElementById('loginError').style.display = 'none';
        }

        // Fungsi mengecek password via AJAX
        function attemptLogin() {
            const pwd = document.getElementById('secretPassword').value;
            const btn = document.getElementById('loginBtn');
            
            if(!pwd) return; // Mencegah submit kosong
            
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Membuka...';
            
            fetch('/check-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ password: pwd })
            }).then(r => r.json()).then(data => {
                if(data.success) {
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Berhasil!';
                    btn.style.background = '#2ecc71';
                    setTimeout(() => startExperience(), 400); // Jeda sebentar agar efek berhasil terlihat
                } else {
                    showMonkey(); // Panggil animasi monyet saat gagal
                    document.getElementById('loginError').style.display = 'block';
                    btn.innerHTML = '<i class="fa-solid fa-lock"></i> Buka Memori';
                    document.getElementById('secretPassword').value = ''; // Kosongkan input
                }
            }).catch(e => {
                showMonkey();
                btn.innerHTML = '<i class="fa-solid fa-lock"></i> Buka Memori';
            });
        }

        // Animasi Monyet saat gagal login
        function showMonkey() {
            const monkey = document.createElement('div');
            monkey.classList.add('monkey-emoji');
            monkey.innerText = '🐵😜';
            document.getElementById('welcomeOverlay').appendChild(monkey);
            
            setTimeout(() => {
                monkey.remove();
            }, 1500);
        }

        // Fungsi dipanggil saat tombol Buka Memori diklik
        function startExperience() {
            const overlay = document.getElementById('welcomeOverlay');
            overlay.style.pointerEvents = 'none'; // Mencegah bug klik tertahan
            
            // 1. Mainkan Musik
            globalAudio.play().then(() => {
                audioController.classList.remove('paused');
            }).catch(e => console.log('Audio autoplay ditolak browser'));

            // 2. Munculkan Love Bertebaran (Banyak)
            triggerHearts(40);

            // 3. Hilangkan Overlay
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.style.display = 'none'; // Ganti dari visibility agar benar-benar hilang dari DOM flow
            }, 1000);
        }

        // Fungsi pemicu love bertebaran
        function triggerHearts(count = 20) {
            for(let i = 0; i < count; i++) {
                setTimeout(createHeart, i * 80); 
            }
        }

        // Logika untuk membuat 1 buah love melayang
        function createHeart() {
            const heart = document.createElement('i');
            heart.classList.add('fa-solid', 'fa-heart', 'floating-heart');
            
            // Posisi dan ukuran acak
            heart.style.left = Math.random() * 100 + 'vw';
            heart.style.animationDuration = (Math.random() * 3 + 2) + 's'; // 2s hingga 5s
            heart.style.fontSize = (Math.random() * 20 + 10) + 'px'; // 10px hingga 30px
            
            document.body.appendChild(heart);
            
            // Hapus dari memori setelah animasi selesai (5 detik)
            setTimeout(() => {
                heart.remove();
            }, 5000);
        }

        function toggleGlobalAudio() {
            if (globalAudio.paused) {
                globalAudio.play();
                audioController.classList.remove('paused');
            } else {
                globalAudio.pause();
                audioController.classList.add('paused');
            }
        }

        // Initialize Swup tanpa plugin eksternal agar stabil
        const swup = new Swup();

        function updateNav() {
            const path = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('data-path') === path) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        function initGalleryScripts() {
            const container = document.getElementById('uploadContainer');
            const form = document.getElementById('uploadForm');
            const input = document.getElementById('photoInput');

            if(container && form && input) {
                // Hapus event listener lama jika ada (untuk mencegah double trigger saat pindah halaman)
                const newContainer = container.cloneNode(true);
                container.parentNode.replaceChild(newContainer, container);
                
                const currentForm = document.getElementById('uploadForm');
                const currentInput = document.getElementById('photoInput');

                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    newContainer.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    newContainer.addEventListener(eventName, () => newContainer.classList.add('dragover'), false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    newContainer.addEventListener(eventName, () => newContainer.classList.remove('dragover'), false);
                });

                newContainer.addEventListener('drop', (e) => {
                    let dt = e.dataTransfer;
                    let files = dt.files;
                    currentInput.files = files;
                    if(currentInput.files.length > 0) {
                        currentForm.submit();
                    }
                }, false);
            }
        }

        // Jalankan ulang script setiap kali Swup selesai memuat halaman baru
        swup.hooks.on('page:view', () => {
            updateNav();
            initGalleryScripts();
            triggerHearts(15); // Munculkan love saat ganti halaman
        });
    </script>
</body>
</html>
