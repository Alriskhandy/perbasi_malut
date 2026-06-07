<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Pastikan untuk mengimpor Str

class PostsCategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::latest()->get(); // Mendapatkan semua data kategori
        return view('backend.posts.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'slug' dihapus dari validasi, akan dibuat otomatis
        ]);

        // Menghasilkan slug dari nama kategori
        $slug = Str::slug($request->name);

        // Menyimpan kategori baru dengan slug yang dihasilkan
        Categories::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        notify()->success('Kategori berhasil ditambahkan.');
        return redirect()->route('posts.categories.index');
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Menghasilkan slug baru dari nama kategori
        $slug = Str::slug($request->name);

        // Memperbarui kategori dengan slug yang dihasilkan
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        notify()->success('Kategori berhasil diperbarui.');
        return redirect()->route('posts.categories.index');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        notify()->success('Kategori berhasil dihapus.');
        return redirect()->route('posts.categories.index');
    }
}
