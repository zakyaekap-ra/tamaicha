<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        // Menggunakan paginate agar ringan jika foto sangat banyak (12 foto per halaman)
        $photos = Photo::orderBy('created_at', 'desc')->paginate(12);
        return view('gallery', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Meningkatkan batas ukuran ke 10MB agar kualitas foto tetap bagus dan tidak dikompresi
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', 
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan file asli tanpa kompresi
            $path = $file->storeAs('photos', $filename, 'public');

            Photo::create([
                'filename' => $filename,
                'path' => $path
            ]);

            return redirect()->back()->with('success', 'Foto kenangan berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto.');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Hapus file dari penyimpanan lokal
        if (Storage::disk('public')->exists($photo->path)) {
            Storage::disk('public')->delete($photo->path);
        }

        // Hapus record dari database
        $photo->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus dari kenangan.');
    }
}
