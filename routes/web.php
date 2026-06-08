<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/search-menu', [SearchController::class, 'searchMenu'])->name('search-menu')->middleware('auth');

Route::get('/', [FrontEndController::class, 'index']);
Route::get('/search', [SearchController::class, 'searchPosts'])->name('search')->middleware('throttle:30,1');

// Daftarkan rute-rute Laravel File Manager secara terpisah
Route::group(['prefix' => 'cms-unkhair-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/galleries', [GalleriesController::class, 'front'])->name('galleries.front');
Route::get('/gallery/{slug}', [GalleriesController::class, 'detail'])->name('gallery.detail');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// 
// Route::get('{slug}', [PageController::class, 'show'])->name('pages.show');
// Route for Pages
Route::get('pages/{slug}', [FrontEndController::class, 'showPage'])->name('pages.show');


// Route for Posts
Route::get('posts/{slug}', [FrontEndController::class, 'showPost'])->name('posts.show');
Route::get('posts', [FrontEndController::class, 'allPosts'])->name('allPosts');

// Route for Categories
Route::get('categories/{slug}', [FrontEndController::class, 'showCategories'])->name('categories.show');
// Route::get('{slug}', [FrontEndController::class, 'showUrl'])->name('url.show');
// 
// comments
Route::post('comments-post', [CommentsController::class, 'store'])->name('comments.store');

require __DIR__.'/auth.php';
require __DIR__.'/backend.php';



// Route::get('/api/check-update', function () {
//     return response()->json([
//         'version' => '1.2.0',
//         'changelog' => 'Tambah fitur X, fix bug Y',
//         'file_url' => 'https://wahyuumaternate.my.id/resources.zip',
//         'migrate' => true
//     ]);
// });
