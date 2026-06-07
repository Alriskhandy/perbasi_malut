<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\GalleriesMeta;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GalleriesController extends Controller
{
    // Menampilkan daftar semua galeri
    public function index()
    {
        $galleries = Galleries::all();  // Ambil semua galeri
        return view('backend.galleries.index', compact('galleries'));
    }

    // Menampilkan form untuk membuat galeri baru
    public function create()
    {
        return view('backend.galleries.create');
    }

    // Menyimpan galeri baru
    public function store(Request $request)
    {
        // dd($request->slug);
        // dd($request->gallery_images);
        try {
            // dd($request->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:galleries,slug',
                'description' => 'required|string',
                'order' => 'nullable|integer',
                'status' => 'required|string',
                'gallery_images' => 'array', // Array dari URL gambar yang dipilih
                'gallery_images.*.image' => 'nullable|string', // Setiap item harus memiliki URL gambar
                'gallery_images.*.description' => 'nullable|string|max:255',
            ]);
    
            // Simpan galeri baru
            $gallery = new Galleries();
            $gallery->name = $request->name;
            $gallery->image = $request->image;
            $gallery->slug = $request->slug;
            $gallery->description = $request->description;
            $gallery->order = $request->order ?? 0;
            $gallery->status = $request->status;
            $gallery->is_featured = $request->has('is_featured');
            $gallery->user_id = Auth::user()->id; // Menyimpan user ID
            $gallery->save();
    
            // Simpan metadata gambar (jika ada gambar yang dipilih)
            if ($request->has('gallery_images')) {
                foreach ($request->gallery_images as $imageData) {
                    $meta = new GalleriesMeta();
                    $meta->gallery_id = $gallery->id;
                    $meta->image = $imageData['image'];
                    $meta->description = $imageData['description']; // Tambahkan deskripsi jika tersedia
                    $meta->save();
                }
            }
            notify()->success('Galeri berhasil dibuat!');
            return redirect()->route('galleries.index');
        } catch (\Throwable $th) {
            // throw $th;
            notify()->error('Galeri gagal dibuat!  -  '.$th->getMessage());
            return redirect()->back();
        }
    }


    // Menampilkan detail galeri
    public function show($id)
    {
        $gallery = Galleries::findOrFail($id);
        return view('backend.galleries.show', compact('gallery'));
    }

    // Menampilkan form untuk mengedit galeri
    public function edit($id)
    {
        $gallery = Galleries::with('metas')->findOrFail($id);
        return view('backend.galleries.edit', compact('gallery'));
    }

    // Menyimpan perubahan galeri
    public function update(Request $request, $id)
{
    try {
        // Validasi request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',  // Memungkinkan image bisa kosong, jika tidak diubah
            'slug' => 'required|string|max:255|unique:galleries,slug,' . $id,
            'description' => 'required|string',
            'order' => 'nullable|integer',
            'status' => 'required|string',
            'gallery_images' => 'array', // Array dari URL gambar yang dipilih
            'gallery_images.*.image' => 'required|string', // Setiap item harus memiliki URL gambar
            'gallery_images.*.description' => 'nullable|string|max:255', // Deskripsi boleh kosong
        ]);

        // Mencari gallery berdasarkan ID
        $gallery = Galleries::findOrFail($id);

        // Cek apakah user upload image baru atau tidak
        $image = $request->image ?: $gallery->image;
        // Update data gallery utama
        $gallery->update([
            'name' => $request->name,
            'image' =>$image,  // Mengupdate gambar utama, jika ada
            'slug' => $request->slug,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),  // Cek apakah checkbox featured dicentang
            'user_id' => Auth::user()->id,
        ]);

        // Memproses dan menyimpan metadata gambar jika ada
        if ($request->has('gallery_images')) {
            foreach ($request->gallery_images as $imageData) {
                // Mengecek apakah gambar sudah ada di metadata
                $existingMeta = GalleriesMeta::where('gallery_id', $gallery->id)
                    ->where('image', $imageData['image'])
                    ->first();

                if ($existingMeta) {
                    // Jika gambar sudah ada, hanya update deskripsi
                    $existingMeta->update([
                        'description' => $imageData['description'],
                    ]);
                } else {
                    // Jika gambar belum ada, buat entri baru di metadata
                    $meta = new GalleriesMeta();
                    $meta->gallery_id = $gallery->id;
                    $meta->image = $imageData['image'];
                    $meta->description = $imageData['description']; // Deskripsi gambar jika ada
                    $meta->save();
                }
            }
        }

        // Menggunakan Laravel Notify untuk menampilkan notifikasi
        notify()->success('Galeri berhasil diperbarui!', 'Success');
        return redirect()->route('galleries.index');
        
    } catch (\Throwable $th) {
        // Menangani error dengan memberi notifikasi
        notify()->error('Galeri gagal diperbarui! - ' . $th->getMessage(), 'Error');
        return redirect()->back();
    }
}


    // Menghapus galeri
    public function destroy($id)
    {
        $gallery = Galleries::findOrFail($id);
        $gallery->delete();

        // Menggunakan Laravel Notify untuk menampilkan notifikasi
        notify()->success('Galeri berhasil dihapus!', 'Success');
        
        return redirect()->route('galleries.index');
    }

    
    public function destroyImage($id)
    {
        // dd($id);
        try {
            // Temukan metadata gambar berdasarkan ID
            $imageMeta = GalleriesMeta::findOrFail($id);

            // Ambil path file gambar dari database (asumsi kolom 'image' menyimpan path relatif)
            $imagePath = public_path('storage/' . $imageMeta->image);

            // Menghapus file gambar dari server
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // Hapus metadata gambar dari database
            $imageMeta->delete();

            return response()->json(['message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting image', 'error' => $e->getMessage()], 500);
        }
    }
    function front() {
        $theme = Theme::where('active', true)->first()->path;
        $data = []; // Data yang diperlukan
       $galleries = Galleries::where('status', 'active')->latest()->get();
        return view($theme . '.galleries', compact('data','galleries'));
    }

    public function detail($slug)
    {
        // Ambil data gallery berdasarkan slug
        $gallery = Galleries::where('slug', $slug)->firstOrFail();
    
        // Ambil data meta yang berhubungan dengan gallery ini (menggunakan get() jika ada banyak data meta)
        $meta = GalleriesMeta::where('gallery_id', $gallery->id)->get();
    
        // Kirim data gallery dan meta ke view
        $theme = Theme::where('active', true)->first()->path;
        return view($theme . '.detail_galleries', compact('gallery', 'meta'));
    }
    

}
