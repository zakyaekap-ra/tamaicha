@extends('layouts.app')

@section('title', 'TAMA & ICHA')

@section('content')
<style>
    .home-card {
        text-align: center;
        padding-top: 60px;
        padding-bottom: 60px;
    }

    .image-wrapper {
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

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
    }

    .home-title {
        font-size: 3.5em;
        margin: 0 0 15px 0;
    }

    .home-title i {
        color: #ff6b6b;
        -webkit-text-fill-color: #ff6b6b;
        font-size: 0.8em;
        animation: heartbeat 1.5s infinite;
        display: inline-block;
    }

    .home-message {
        font-size: 1.3em;
        line-height: 1.8;
        color: var(--secondary);
        margin-bottom: 40px;
        font-weight: 300;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-btn {
        display: inline-block;
        padding: 12px 30px;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        border-radius: 30px;
        font-weight: 500;
        font-size: 1.1em;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(147, 112, 219, 0.4);
    }

    .cta-btn:hover {
        background: var(--accent);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(221, 160, 221, 0.6);
        color: #fff;
    }

    @media (max-width: 768px) {
        .home-title { font-size: 2.5em; }
        .image-wrapper { width: 200px; height: 200px; }
        .home-message { font-size: 1.1em; }
    }
</style>

<div class="glass-card home-card">
    <div class="image-wrapper">
        <img src="{{ asset('images/WhatsApp Image 2026-06-03 at 12.31.03.jpeg') }}" alt="TAMA & ICHA">
    </div>
    
    <h1 class="home-title heading-gradient">TAMA & ICHA <i class="fa-solid fa-heart"></i></h1>
    
    <p class="home-message">
        Setiap detik kebersamaan kita adalah memori terindah yang patut untuk diabadikan.<br>
        Selamat datang di tempat spesial kita.<br>
        <em>Let's save our beautiful memories together.</em>
    </p>

    <a href="/gallery" class="cta-btn">Lihat Galeri Kita <i class="fa-solid fa-arrow-right ml-2"></i></a>
</div>
@endsection
