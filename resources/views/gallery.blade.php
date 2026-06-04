@extends('layouts.app')

@section('title', 'Gallery - Icha Aprilia')

@section('content')
<style>
    .gallery-header {
        margin-bottom: 30px;
    }
    .gallery-title {
        font-size: 2.8em;
        margin-bottom: 10px;
    }
    .gallery-subtitle {
        color: var(--secondary);
        font-size: 1.1em;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Upload Area */
    .upload-container {
        margin: 0 auto 40px;
        max-width: 500px;
        background: rgba(0, 0, 0, 0.2);
        border: 2px dashed var(--accent);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .upload-container:hover, .upload-container.dragover {
        background: rgba(0, 0, 0, 0.4);
        border-color: #fff;
    }

    .upload-icon {
        font-size: 3em;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .upload-text {
        font-size: 1.1em;
        margin-bottom: 15px;
    }

    .upload-btn {
        background: var(--primary);
        color: #fff;
        padding: 10px 25px;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .upload-btn:hover {
        background: var(--accent);
        transform: translateY(-2px);
    }

    input[type="file"] {
        display: none;
    }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .alert-success {
        background: rgba(46, 204, 113, 0.2);
        border: 1px solid #2ecc71;
        color: #2ecc71;
    }
    .alert-error {
        background: rgba(231, 76, 60, 0.2);
        border: 1px solid #e74c3c;
        color: #e74c3c;
    }

    /* Grid Gallery */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        padding: 10px;
        margin-bottom: 30px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        aspect-ratio: 1 / 1;
        background: rgba(0,0,0,0.2);
        border: 2px solid rgba(255,255,255,0.1);
        transition: transform 0.4s ease;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
        filter: brightness(0.9);
    }

    .gallery-item:hover img {
        transform: scale(1.1);
        filter: brightness(0.6);
    }
    
    /* Overlay Actions */
    .gallery-actions {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        gap: 15px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-actions {
        opacity: 1;
    }

    .action-btn {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-size: 1.2em;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-download {
        background: rgba(46, 204, 113, 0.8);
    }
    .btn-download:hover {
        background: rgba(46, 204, 113, 1);
        transform: scale(1.1);
    }

    .btn-delete {
        background: rgba(231, 76, 60, 0.8);
    }
    .btn-delete:hover {
        background: rgba(231, 76, 60, 1);
        transform: scale(1.1);
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 50px 20px;
        color: var(--secondary);
        font-style: italic;
    }
    
    .empty-state i {
        font-size: 3em;
        margin-bottom: 15px;
        color: var(--accent);
        opacity: 0.5;
    }

    /* Simple Pagination CSS */
    .pagination-container nav {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .pagination-container nav div.hidden {
        display: flex;
        gap: 10px;
    }

    .pagination-container span, .pagination-container a {
        padding: 8px 15px;
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.2s ease;
    }

    .pagination-container a:hover {
        background: var(--primary);
    }

    .pagination-container span[aria-current="page"] span {
        background: var(--primary);
        color: white;
    }

    /* Hide tailwind extra svgs in simple mode if any */
    .pagination-container svg {
        width: 1.2rem;
        height: 1.2rem;
    }
</style>

<div class="glass-card">
    <div class="text-center gallery-header">
        <h1 class="gallery-title heading-gradient">Simpan Foto TAMA & ICHA</h1>
        <p class="gallery-subtitle">Tempat eksklusif untuk menyimpan setiap senyum dan memori indah kita.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error text-center">
            <i class="fa-solid fa-triangle-exclamation"></i> Gagal mengunggah. Pastikan format file benar (Gambar) dan ukurannya tidak terlalu besar.
        </div>
    @endif

    <!-- Upload Form -->
    <div class="upload-container" id="uploadContainer">
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="upload-icon">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="upload-text">Tarik & lepas foto ke sini atau</div>
            <label for="photoInput" class="upload-btn">
                <i class="fa-solid fa-folder-open"></i> Pilih Foto
            </label>
            <input type="file" id="photoInput" name="photo" accept="image/*" onchange="document.getElementById('uploadForm').submit();">
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid">
        @forelse ($photos as $photo)
            <div class="gallery-item">
                <img src="{{ asset('storage/' . $photo->path) }}" alt="Kenangan">
                
                <div class="gallery-actions">
                    <!-- Tombol Download (Original Quality) -->
                    <a href="{{ asset('storage/' . $photo->path) }}" download="{{ $photo->filename }}" class="action-btn btn-download" title="Simpan Foto Asli">
                        <i class="fa-solid fa-download"></i>
                    </a>
                    
                    <!-- Tombol Hapus -->
                    <form action="{{ route('gallery.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kenangan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete" title="Hapus Foto">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fa-regular fa-images"></i>
                <p>Belum ada foto yang diunggah. Tambahkan momen pertama kalian di atas!</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($photos->hasPages())
        <div class="pagination-container">
            {{ $photos->links('pagination::simple-default') }}
        </div>
    @endif
</div>
@endsection
