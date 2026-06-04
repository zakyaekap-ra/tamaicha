<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teruntuk Icha Aprilia</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #9370DB; /* Medium Purple */
            --secondary: #E6E6FA; /* Lavender */
            --dark: #4B0082; /* Indigo */
            --accent: #DDA0DD; /* Plum */
        }
        
        body {
            margin: 0; 
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a0033 0%, #4B0082 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 800px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            text-align: center;
            width: 100%;
            animation: fadeIn 1.5s ease-out;
        }

        .image-container {
            position: relative;
            width: 250px;
            height: 250px;
            margin: 0 auto 30px;
            border-radius: 50%;
            padding: 10px;
            background: linear-gradient(45deg, var(--accent), var(--primary));
            box-shadow: 0 15px 35px rgba(147, 112, 219, 0.4);
            animation: float 6s ease-in-out infinite;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5em;
            margin: 0 0 15px 0;
            background: linear-gradient(to right, #E6E6FA, #DDA0DD);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        h1 i {
            color: #ff6b6b;
            -webkit-text-fill-color: #ff6b6b;
            font-size: 0.8em;
            animation: heartbeat 1.5s infinite;
            display: inline-block;
        }

        p.message {
            font-size: 1.2em;
            line-height: 1.8;
            color: var(--secondary);
            margin-bottom: 40px;
            font-weight: 300;
        }

        .audio-player {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 50px;
            padding: 10px 20px;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .audio-player:hover {
            background: rgba(0, 0, 0, 0.5);
            border-color: var(--primary);
        }

        .play-btn {
            background: var(--primary);
            color: #fff;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2em;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(147, 112, 219, 0.4);
        }

        .play-btn:hover {
            transform: scale(1.1);
            background: var(--accent);
        }

        .track-info {
            text-align: left;
        }

        .track-info .title {
            font-size: 0.9em;
            font-weight: 500;
            color: #fff;
            margin: 0;
        }

        .track-info .artist {
            font-size: 0.8em;
            color: var(--accent);
            margin: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

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

        @media (max-width: 768px) {
            .card { padding: 30px 20px; }
            h1 { font-size: 2.5em; }
            .image-container { width: 200px; height: 200px; }
        }
    </style>
</head>
<body>
    <div class="stars"></div>
    <div class="container">
        <div class="card">
            <div class="image-container">
                <img src="{{ asset('images/couple.png') }}" alt="Romantic Couple">
            </div>
            
            <h1>Teruntuk Icha Aprilia <i class="fa-solid fa-heart"></i></h1>
            
            <p class="message">
                Setiap detik bersamamu adalah melodi terindah dalam hidupku.<br>
                Terima kasih sudah menjadi alasan di balik senyumku setiap hari.<br>
                <em>I love you more than words can say.</em>
            </p>

            <div class="audio-player">
                <button class="play-btn" id="playBtn" onclick="togglePlay()">
                    <i class="fa-solid fa-play" id="playIcon"></i>
                </button>
                <div class="track-info">
                    <p class="title">Our Song</p>
                    <p class="artist">Romantic Vibes</p>
                </div>
                <!-- Anda bisa mengganti URL di bawah ini dengan link mp3 pilihan Anda -->
                <audio id="myAudio" src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" loop></audio>
            </div>
        </div>
    </div>

    <script>
        const audio = document.getElementById('myAudio');
        const playBtn = document.getElementById('playBtn');
        const playIcon = document.getElementById('playIcon');
        let isPlaying = false;

        function togglePlay() {
            if (isPlaying) {
                audio.pause();
                playIcon.classList.remove('fa-pause');
                playIcon.classList.add('fa-play');
                playBtn.style.animation = 'none';
            } else {
                audio.play();
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-pause');
                playBtn.style.animation = 'pulse 2s infinite';
            }
            isPlaying = !isPlaying;
        }
    </script>
</body>
</html>