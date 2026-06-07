<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Comments;
use App\Models\Page;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\Theme;
class FrontEndController extends Controller
{
   
    public function index()
    {
        $theme = Theme::where('active', true)->first()->path;

        // Ambil berita utama
        $beritaUtama = Posts::where('is_featured', 1)->latest()->get();

        // Ambil pengumuman
        $pengumumanPosts = Posts::whereHas('category', function ($query) {
            $query->where('name', 'Pengumuman');
        })->latest()->get();

        // Ambil ID dari post yang sudah digunakan
        $excludedIds = $beritaUtama->pluck('id')
            ->merge($pengumumanPosts->pluck('id'))
            ->unique()
            ->toArray();

        // Ambil berita lainnya yang tidak termasuk dalam berita utama dan pengumuman
        $posts = Posts::whereIn('status', ['published', 'approved'])
            ->whereNotIn('id', $excludedIds)
            ->latest()
            ->get();

        return view($theme . '.index', compact('beritaUtama', 'pengumumanPosts', 'posts'));
    }

    public function showPage($slug)
    {
        $theme = Theme::where('active', true)->first()->path;
        $data = []; // Data yang diperlukan
    
        // Temukan halaman berdasarkan slug
        $page = Page::where('slug', $slug)->firstOrFail();
        
        return view($theme . '.pages', compact('data','page'));
    }

    public function showPost($slug)
    {
        $theme = Theme::where('active', true)->first()->path;

        // Temukan halaman berdasarkan slug
        $page = Posts::where('slug', $slug)->firstOrFail();

        // Tambahkan jumlah views
        $page->increment('views');

        $comments = Comments::where('status', 'approved')
                    ->where('post_id', $page->id)
                    ->latest()
                    ->get();

        return view($theme . '.detail_post', compact('comments', 'page'));
    }

    public function showCategories($slug)
    {
        $theme = Theme::where('active', true)->first()->path;
        // $data = []; // Data yang diperlukan
    
        // Temukan halaman berdasarkan slug
        $category = Categories::where('slug', $slug)->firstOrFail();

        $posts = Posts::where('category_id', $category->id)->latest()->paginate(8); // Batasi 10 posting per halaman

        // dd($posts);
        return view($theme . '.posts_categories', compact('category','posts'));
    }

    public function allPosts(){
        $theme = Theme::where('active', true)->first()->path;
        // $data = []; // Data yang diperlukan

        $posts = Posts::whereIn('status', ['published', 'approved'])->latest()->paginate(8);


        // dd($posts);
        return view($theme . '.posts_categories', compact('posts'));
    }
}
