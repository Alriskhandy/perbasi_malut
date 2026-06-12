<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\District;
use App\Models\Galleries;
use App\Models\Page;
use App\Models\Posts;
use App\Models\Team;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = Cache::remember('sitemap.urls', 3600, function () {
            $urls = [];

            // Halaman statis
            foreach ([
                ['route' => 'home', 'priority' => '1.0', 'changefreq' => 'daily'],
                ['route' => 'allPosts', 'priority' => '0.8', 'changefreq' => 'daily'],
                ['route' => 'dpd.index', 'priority' => '0.6', 'changefreq' => 'weekly'],
                ['route' => 'clubs.index', 'priority' => '0.6', 'changefreq' => 'weekly'],
                ['route' => 'athletes.index', 'priority' => '0.6', 'changefreq' => 'weekly'],
                ['route' => 'coaches.front', 'priority' => '0.5', 'changefreq' => 'weekly'],
                ['route' => 'referees.front', 'priority' => '0.5', 'changefreq' => 'weekly'],
                ['route' => 'galleries.front', 'priority' => '0.5', 'changefreq' => 'weekly'],
            ] as $item) {
                $urls[] = [
                    'loc' => route($item['route']),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => $item['changefreq'],
                    'priority' => $item['priority'],
                ];
            }

            // Berita
            Posts::whereIn('status', ['published', 'approved'])
                ->orderByDesc('updated_at')
                ->get(['slug', 'updated_at'])
                ->each(function (Posts $post) use (&$urls) {
                    $urls[] = [
                        'loc' => route('posts.show', $post->slug),
                        'lastmod' => $post->updated_at?->toAtomString() ?? now()->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.7',
                    ];
                });

            // Kategori berita
            Categories::get(['slug'])->each(function (Categories $category) use (&$urls) {
                $urls[] = [
                    'loc' => route('categories.show', $category->slug),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.5',
                ];
            });

            // Halaman statis (pages)
            Page::where('status', 'aktif')->get(['slug', 'updated_at'])->each(function (Page $page) use (&$urls) {
                $urls[] = [
                    'loc' => route('pages.show', $page->slug),
                    'lastmod' => $page->updated_at?->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.5',
                ];
            });

            // DPD
            District::get(['slug'])->each(function (District $district) use (&$urls) {
                $urls[] = [
                    'loc' => route('dpd.detail', $district->slug),
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            });

            // Klub
            Team::where('status', 'aktif')->whereNotNull('slug')->get(['slug', 'updated_at'])->each(function (Team $team) use (&$urls) {
                $urls[] = [
                    'loc' => route('clubs.detail', $team->slug),
                    'lastmod' => $team->updated_at?->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            });

            // Galeri
            Galleries::where('status', 'active')->get(['slug', 'updated_at'])->each(function (Galleries $gallery) use (&$urls) {
                $urls[] = [
                    'loc' => route('gallery.detail', $gallery->slug),
                    'lastmod' => $gallery->updated_at?->toAtomString() ?? now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.4',
                ];
            });

            return $urls;
        });

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}
