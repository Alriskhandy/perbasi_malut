<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
   
    public function index(Request $request)
{
    // Mendapatkan status dari query string
    $status = $request->query('status');
    
    // Menghitung total posts yang tidak dihapus
    $totalPosts = Posts::whereNull('deleted_at')->count();
    
    // Menghitung total posts yang dihapus
    $totalTrashed = Posts::onlyTrashed()->count();
    
    // Memilih posts berdasarkan status
    if ($status === 'trashed') {
        // Mengambil posts yang dihapus dan mengurutkan berdasarkan yang terbaru
        $posts = Posts::onlyTrashed()
                      ->with('categories')
                      ->orderBy('deleted_at', 'desc') // Urutkan berdasarkan deleted_at (terbaru)
                      ->get();
    } else {
        // Mengambil posts yang tidak dihapus dan mengurutkan berdasarkan yang terbaru
        $posts = Posts::whereNull('deleted_at')
                      ->with('categories')
                      ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at (terbaru)
                      ->get();
    }
    
    // Menentukan apakah ada posts yang dihapus
    $hasTrashed = $totalTrashed > 0;

    $categories = Categories::all();

    // Mengembalikan tampilan dengan data yang diperlukan
    return view('backend.posts.index', compact('posts','categories', 'status', 'hasTrashed', 'totalPosts', 'totalTrashed'));
}

    
    public function create()
    {
         // Menghitung jumlah post yang sudah diberi status 'is_featured' dan 'is_banner'
        $featuredCount = Posts::where('is_featured', 1)->count();
        $bannerCount = Posts::where('is_banner', 1)->count();

        // Menentukan apakah fitur is_featured dan is_banner dapat diaktifkan
        $canBeFeatured = $featuredCount < 4; // Batas maksimal 4
        $canBeBanner = $bannerCount < 3;     // Batas maksimal 3
    
        $categories = Categories::all();
        return view('backend.posts.create', compact('categories','canBeFeatured', 'canBeBanner'));
    }

    public function store(Request $request)
    {
        // dd($request->input('category_id'));
        // Validasi input
        $validatedData = $this->validateRequest($request);
        // dd($validatedData['category_id']);

        // Buat dan simpan pos baru menggunakan mass assignment
        $post = Posts::create([
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'excerpt' => Str::limit(strip_tags($validatedData['content']), 150),
            'status' => $validatedData['status'],
            'content' => $validatedData['content'],
            'comments_is_active' => false,
            'is_featured' =>$validatedData['is_featured'],
            'is_banner' =>$validatedData['is_banner'],
            'views' => 0,
            'author' => Auth::user()->name,
            'image' => $request->input('image'),
            'category_id' => $request->input('category_id'),
        ]);

        // // Lampirkan kategori jika ada
        // if (!empty($validatedData['category'])) {
        //     $post->categories()->attach($validatedData['category']);
        // }

        // Menggunakan notifikasi notify()
        notify()->success('Post created successfully!');

        return redirect()->route('posts.index');
    }

    private function validateRequest(Request $request)
    {
        //  dd($request->category_id);
        return $request->validate([
            'title' => 'required|string|max:255|unique:posts',
            'content' => 'required',
            'image' => 'required',
            'status' => 'required|in:draft,published,trashed',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'required|boolean',
            'is_banner' => 'required|boolean',
        ]);
    }

    public function show($id)
    {
        // Temukan post berdasarkan ID
        $post = Posts::findOrFail($id);
        return view('backend.posts.show', compact('post'));
    }

    public function bulk(Request $request)
    {
        $action = $request->input('action');
        $selectedPosts = $request->input('selected_posts', []);
        
        if ($selectedPosts) {
            if ($action === 'trash') {
                Posts::whereIn('id', $selectedPosts)
                    ->update(['status' => PostStatus::Trashed->value, 'deleted_at' => now()]);
                notify()->success('Tindakan bulk berhasil dilakukan: Posts dihapus.');
            } elseif ($action === 'delete') {
                Posts::whereIn('id', $selectedPosts)->forceDelete();
                notify()->success('Tindakan bulk berhasil dilakukan: Posts dihapus permanen.');
            } elseif ($action === 'publish') {
                Posts::whereIn('id', $selectedPosts)
                    ->update(['status' => PostStatus::Published->value]);
                notify()->success('Tindakan bulk berhasil dilakukan: Posts diterbitkan.');
            } elseif ($action === 'draft') {
                Posts::whereIn('id', $selectedPosts)
                    ->update(['status' => PostStatus::Draft->value]);
                notify()->success('Tindakan bulk berhasil dilakukan: Posts dijadikan draft.');
            } elseif ($action === 'kembalikan') {
                Posts::whereIn('id', $selectedPosts)
                    ->restore(); // Mengembalikan dari soft delete
                Posts::whereIn('id', $selectedPosts)
                    ->update(['status' => PostStatus::Published->value]);
                notify()->success('Tindakan bulk berhasil dilakukan: Posts dikembalikan.');
            } else {
                notify()->error('Pilih Tindakan!');
                return redirect()->back();
            }
    
            return redirect()->route('posts.index', ['status' => $request->query('status')]);
        } else {
            notify()->error('Pilih Post Terlebih Dahulu!');
            return redirect()->back();
        }
    }

    public function edit(Posts $post)
{
    
    // Temukan post berdasarkan ID
    // $post = Posts::findOrFail($slug);
    $categories = Categories::all(); // Mengambil semua kategori untuk dropdown
    // Menghitung jumlah post dengan is_featured = 1 dan is_banner = 1
    $featuredCount = Posts::where('is_featured', 1)->count();
    $bannerCount = Posts::where('is_banner', 1)->count();

    // Menentukan apakah opsi is_featured dan is_banner bisa dipilih
    $canBeFeatured = $featuredCount < 4; // Batas 4 untuk featured
    $canBeBanner = $bannerCount < 3;     // Batas 3 untuk banner

    // dd($post);
    // dd($post->status); // This will halt execution and display the status
    return view('backend.posts.edit', compact('post', 'categories', 'canBeFeatured', 'canBeBanner'));
}


    public function update(Request $request, Posts $post)
    {
        // $post = Posts::findOrFail($slug);
        // Validasi untuk memastikan 'is_banner' hanya dibutuhkan jika radio button aktif
        $canBeBanner = Posts::where('is_banner', 1)->count() < 3; // Hanya bisa ada maksimal 3 banner
        $canBeFeatured = Posts::where('is_featured', 1)->count() < 4; // Hanya bisa ada maksimal 4 featured posts
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published,trashed',
           'is_featured' => [
            'nullable', 
            'boolean', 
            // Validasi hanya diterapkan jika jumlah featured belum mencapai batas
            $canBeFeatured ? 'required' : '',
            ],
            'is_banner' => [
                'nullable', 
                'boolean', 
                // Validasi hanya diterapkan jika jumlah banner belum mencapai batas
                $canBeBanner ? 'required' : '',
            ], 
                // 'image' => 'required',
                'category_id' => 'required|exists:categories,id',
            ]);

        // Menghasilkan slug dari judul
        $slugs = Str::slug($request->title);

        // Memperbarui post dengan data yang baru
        $post->update([
            'title' => $request->title,
            'slug' => $slugs,
            'image' => $request->input('image'),
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'comments_is_active' => false,
            'is_featured' => $request->has('is_featured') ? $request->is_featured : $post->is_featured, // Jika tidak ada perubahan, tetap gunakan nilai lama
        'is_banner' => $request->has('is_banner') ? $request->is_banner : $post->is_banner, // Jika tidak ada perubahan, tetap gunakan nilai lama
            // Tambahkan kategori jika diperlukan
        ]);

        // // Lampirkan kategori jika ada
        // if ($request->has('category')) {
        //     $post->categories()->sync($request->category);
        // }

        notify()->success('Post berhasil diperbarui.');
        return redirect()->route('posts.index');
    }
}
