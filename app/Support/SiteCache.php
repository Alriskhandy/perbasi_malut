<?php

namespace App\Support;

use App\Models\Categories;
use App\Models\Comments;
use App\Models\GeneralSettings;
use App\Models\Menu;
use App\Models\Posts;
use App\Models\Theme;
use Illuminate\Support\Facades\Cache;

/**
 * Cache untuk data yang dipakai di hampir setiap halaman (layout, menu, SEO, dll).
 * Dihapus otomatis lewat model event (lihat AppServiceProvider) dan manual
 * lewat SiteCache::flush() pada query builder update yang tidak memicu event.
 */
class SiteCache
{
    private const KEYS = [
        'site.theme',
        'site.settings',
        'site.menus',
        'site.categories',
        'site.banner',
        'site.trending',
        'site.unread_comments',
        'site.home_stats',
    ];

    private static bool $flushed = false;

    /**
     * Hapus semua cache situs. Dipanggil berkali-kali dalam satu request
     * (mis. bulk update) tetap hanya menghapus sekali + sekali lagi di akhir request.
     */
    public static function flush(): void
    {
        if (self::$flushed) {
            return;
        }
        self::$flushed = true;

        self::forgetAll();
        app()->terminating(function () {
            self::forgetAll();
            self::$flushed = false;
        });
    }

    public static function forgetHomeStats(): void
    {
        Cache::forget('site.home_stats');
    }

    /**
     * Statistik jumlah klub/pelatih/atlet/wasit di beranda.
     */
    public static function homeStats(): array
    {
        return Cache::remember('site.home_stats', now()->addMinutes(10), fn () => [
            'klubCount' => \App\Models\Team::count(),
            'pelatihCount' => \App\Models\Coach::count(),
            'atletCount' => \App\Models\Player::count(),
            'wasitCount' => \App\Models\Referee::count(),
        ]);
    }

    private static function forgetAll(): void
    {
        foreach (self::KEYS as $key) {
            Cache::forget($key);
        }
    }

    public static function themePath(): string
    {
        return Cache::rememberForever('site.theme', fn () => Theme::where('active', true)->value('path') ?? 'themes/perbasi');
    }

    /**
     * Data yang dibagikan ke semua view. Hanya dimuat sekali per request.
     */
    public static function sharedViewData(): array
    {
        $settings = Cache::remember('site.settings', now()->addHour(), fn () => GeneralSettings::whereIn('key', [
            'site_name', 'site_logo', 'seo_title', 'seo_description', 'seo_keywords', 'app_url',
        ])->get()->keyBy('key'));

        return [
            'site_name' => $settings['site_name'] ?? null,
            'site_logo' => $settings['site_logo'] ?? null,
            'seo_title' => $settings['seo_title']->value ?? 'Default Title',
            'seo_description' => $settings['seo_description']->value ?? 'Default description',
            'seo_keywords' => $settings['seo_keywords']->value ?? 'default, keywords',
            'app_url' => $settings['app_url']->value ?? 'http://localhost/',

            'menus' => Cache::remember('site.menus', now()->addHour(), fn () => Menu::with(['items' => function ($query) {
                $query->whereNull('parent_id')  // Only top-level items
                    // Relasi anak juga di-eager-load agar tidak ada query tambahan saat header dirender
                    ->with(['page', 'post', 'category', 'children.page', 'children.post', 'children.category', 'children.children'])
                    ->orderBy('order');
            }, 'page'])->where('status', 'aktif')->get()),

            'categoriesAll' => Cache::remember('site.categories', now()->addHour(), fn () => Categories::all()),

            'banner' => Cache::remember('site.banner', now()->addMinutes(10), fn () => Posts::with('category')
                ->where('is_banner', 1)
                ->where('status', 'published')
                ->latest()
                ->get()),

            'trendingPosts' => Cache::remember('site.trending', now()->addMinutes(10), fn () => Posts::where('status', 'published')
                ->orderBy('views', 'desc')
                ->limit(5)
                ->get()),

            'unreadCommentsCount' => Cache::remember('site.unread_comments', now()->addMinutes(5), fn () => Comments::where('read', false)->count()),
        ];
    }
}
