<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Posts;
use App\Models\Theme;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchMenu(Request $request)
    {
        $query = strip_tags(trim($request->input('q', '')));

        // data for menu items
        $menuItems = [
            ['name' => 'Dashboard', 'url' => route('dashboard')],
            // Posts
            ['name' => 'Posts', 'url' => route('posts.index')],
            ['name' => 'Posts > Add Posts', 'url' => route('posts.create')],
            ['name' => 'Posts > Categories', 'url' => route('posts.categories.index')],
            // Pages
            ['name' => 'Pages', 'url' => route('pages.index')],
            ['name' => 'Pages > Add Pages', 'url' => route('pages.create')],
            // Media
            ['name' => 'Media', 'url' => route('media.index')],
            // Themes (dinonaktifkan)
            // ['name' => 'Themes', 'url' => route('tema.index')],
            // Menus
            ['name' => 'Menu', 'url' => route('menus.create')],
            // ['name' => 'Menu > Create Menu', 'url' => route('menus.create')],
            // Galleries
            ['name' => 'Galleries', 'url' => route('galleries.index')],
            ['name' => 'Galleries > Add Gallery', 'url' => route('galleries.create')],
            // Comments (dinonaktifkan)
            // ['name' => 'Comments', 'url' => route('comments.index')],
            // Profile
            ['name' => 'Profile', 'url' => route('profile.index')],
            // Settings
            ['name' => 'Settings', 'url' => route('settings.index')],
            // Backup
            // ['name' => 'Backup > Download Database', 'url' => route('backup.download')],
            // ['name' => 'Backup > Download Storage', 'url' => route('backup.storage')],
        ];

        // Filter menu items based on the query
        $results = array_filter($menuItems, function ($item) use ($query) {
            return stripos($item['name'], $query) !== false;
        });

        return response()->json(array_values($results));
    }
    public function searchPosts(Request $request)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $theme = Theme::where('active', true)->first()->path;

        $query = strip_tags(trim($request->input('q', '')));

        if ($query !== '') {
            $posts = Posts::where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('content', 'LIKE', '%' . $query . '%')
                ->paginate(10)
                ->withQueryString();

            $pages = Page::where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('content', 'LIKE', '%' . $query . '%')
                ->paginate(10)
                ->withQueryString();
        } else {
            $posts = collect([]);
            $pages = collect([]);
        }

        return view($theme . '.search', compact('posts', 'pages', 'query'));
    }

    
}
