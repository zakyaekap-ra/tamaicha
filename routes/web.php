<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PhotoController;

Route::get('/', function () {
    return view('home');
});

// Route untuk mengecek password
Route::post('/check-password', function(\Illuminate\Http\Request $request) {
    if($request->password === '250526') {
        session(['unlocked' => true]);
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
});

// Rute yang akan dilindungi password
Route::middleware(\App\Http\Middleware\CheckUnlock::class)->group(function () {
    Route::get('/gallery', [PhotoController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [PhotoController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{id}', [PhotoController::class, 'destroy'])->name('gallery.destroy');
});

// Rute Rahasia untuk menjalankan Migrasi Database di InfinityFree
Route::get('/setup-database-rahasia', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('storage:link');
        return 'Database dan Storage berhasil di-setup! Silakan hapus rute ini di web.php untuk keamanan.';
    } catch (\Exception $e) {
        return 'Terjadi Kesalahan: ' . $e->getMessage();
    }
});
