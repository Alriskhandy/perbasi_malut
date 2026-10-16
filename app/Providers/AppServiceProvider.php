<?php

namespace App\Providers;

use App\Models\Categories;
use App\Models\Coach;
use App\Models\Comments;
use App\Models\GeneralSettings;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Player;
use App\Models\Posts;
use App\Models\Referee;
use App\Models\Team;
use App\Models\Theme;
use App\Support\SiteCache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap(); // Gunakan gaya Bootstrap

        // Data global (menu, setting, SEO, banner, trending) dimuat dari cache
        // hanya saat view pertama dirender, bukan di setiap boot (artisan, redirect, JSON).
        View::composer('*', function () {
            static $shared = false;
            if ($shared) {
                return;
            }
            $shared = true;
            View::share(SiteCache::sharedViewData());
        });

        // Hapus cache saat data terkait berubah
        $models = [
            Posts::class, Page::class, Categories::class, Menu::class, MenuItem::class,
            GeneralSettings::class, Theme::class, Comments::class,
        ];
        foreach ($models as $model) {
            $model::saved(fn () => SiteCache::flush());
            $model::deleted(fn () => SiteCache::flush());
        }
        Posts::restored(fn () => SiteCache::flush());

        // Data atlet/klub hanya memengaruhi statistik beranda
        foreach ([Team::class, Coach::class, Player::class, Referee::class] as $model) {
            $model::created(fn () => SiteCache::forgetHomeStats());
            $model::deleted(fn () => SiteCache::forgetHomeStats());
        }
    }
}
