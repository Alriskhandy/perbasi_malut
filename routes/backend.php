<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostsCategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TeamImportController;


Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // media
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/upload', [MediaController::class, 'upload'])->name('file.upload');
    // posts
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/create-post', [PostsController::class, 'create'])->name('posts.create');
    // Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/post/{post:slug}/edit', [PostsController::class, 'edit'])->name('posts.edit'); // Menampilkan form untuk edit post
    Route::put('/post/{post:slug}', [PostsController::class, 'update'])->name('posts.update'); // Memperbarui post
    // Route::post('/upload-image', [PostsController::class, 'uploadImage'])->name('upload.image');
    Route::post('/posts/bulk', [PostsController::class, 'bulk'])->name('posts.bulk_action');
    // categories
    Route::get('/posts/categories/all', [PostsCategoriesController::class, 'index'])->name('posts.categories.index');
    Route::post('/categories', [PostsCategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [PostsCategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/posts/categories/all/{id}', [PostsCategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [PostsCategoriesController::class, 'destroy'])->name('categories.destroy');
    // themes
    Route::get('/tema', [ThemeController::class, 'index'])->name('tema.index');
    Route::get('/ganti-tema/{themeId}', [ThemeController::class, 'switchTheme'])->name('ganti.tema');
    // pages
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit'); // Menampilkan form untuk edit halaman
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update'); // Memperbarui halaman
    Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy'); // Menghapus halaman
    // menus
    Route::get('/menus/create', [MenuItemController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuItemController::class, 'store'])->name('menus.store');
    Route::get('/menus', [MenuItemController::class, 'index'])->name('menus.index');
    Route::post('/menu/update-order', [MenuItemController::class, 'updateOrder'])->name('menu.updateOrder');
    Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
    Route::patch('/menus/{menu}/update', [MenuItemController::class, 'update'])->name('menus.update');
    // Route untuk Galleries
    Route::get('galleries', [GalleriesController::class, 'index'])->name('galleries.index');
    Route::get('galleries/create', [GalleriesController::class, 'create'])->name('galleries.create');
    Route::post('galleries', [GalleriesController::class, 'store'])->name('galleries.store');
    Route::get('galleries/{id}', [GalleriesController::class, 'show'])->name('galleries.show');
    Route::get('galleries/{id}/edit', [GalleriesController::class, 'edit'])->name('galleries.edit');
    Route::put('galleries/{id}', [GalleriesController::class, 'update'])->name('galleries.update');
    Route::delete('galleries/{id}', [GalleriesController::class, 'destroy'])->name('galleries.destroy'); 
    Route::delete('/gallery/image/{id}', [GalleriesController::class, 'destroyImage']);
    // districts
    Route::resource('districts', DistrictController::class)->except(['show']);
    // teams
    Route::get('teams/import/template', [TeamImportController::class, 'downloadTemplate'])->name('teams.import.template');
    Route::get('teams/{id}/import', [TeamImportController::class, 'importForm'])->name('teams.import.form');
    Route::post('teams/{id}/import', [TeamImportController::class, 'import'])->name('teams.import');
    Route::resource('teams', TeamController::class)->except(['show']);
    // coaches
    Route::post('coaches/bulk', [CoachController::class, 'bulkAction'])->name('coaches.bulk_action');
    Route::resource('coaches', CoachController::class)->except(['show']);
    // players
    Route::post('players/bulk', [PlayerController::class, 'bulkAction'])->name('players.bulk_action');
    Route::resource('players', PlayerController::class)->except(['show']);
    // officials
    Route::post('officials/bulk', [OfficialController::class, 'bulkAction'])->name('officials.bulk_action');
    Route::resource('officials', OfficialController::class)->except(['show']);
    // referees
    Route::post('referees/bulk', [RefereeController::class, 'bulkAction'])->name('referees.bulk_action');
    Route::resource('referees', RefereeController::class)->except(['show']);
    // Halaman Daftar Komentar
    Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
    // Halaman Edit Komentar
    Route::get('/comments/{id}/edit', [CommentsController::class, 'edit'])->name('comments.edit');
    // Proses Update Komentar
    Route::put('/comments/{id}', [CommentsController::class, 'update'])->name('comments.update');
    // Hapus Komentar
    Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');


    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('/dashboard')->middleware(['is_admin','auth'])->group(function () {
    Route::get('/settings', [GeneralSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [GeneralSettingsController::class, 'update'])->name('settings.update');
    Route::post('/admin/update-app', [UpdateController::class, 'updateApp'])->name('admin.update.app');
    Route::resource('users', UserController::class);
});
