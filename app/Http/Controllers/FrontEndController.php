<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Comments;
use App\Models\Page;
use App\Models\Posts;
use App\Models\Galleries;
use App\Helpers\Hashid;
use App\Models\District;
use App\Models\Team;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Referee;
use Illuminate\Http\Request;
use App\Support\SiteCache;
class FrontEndController extends Controller
{
   
    public function index()
    {
        $theme = SiteCache::themePath();

        // Ambil berita utama
        $beritaUtama = Posts::where('is_featured', 1)->latest()->get();

        // Ambil ID dari post yang sudah digunakan
        $excludedIds = $beritaUtama->pluck('id')
            ->unique()
            ->toArray();

        // Ambil berita lainnya yang tidak termasuk dalam berita utama dan pengumuman
        $posts = Posts::with('category')
            ->whereIn('status', ['published', 'approved'])
            ->whereNotIn('id', $excludedIds)
            ->latest()
            ->limit(12)
            ->get();

        // Ambil Galleri
        $galleries = Galleries::where('status', 'active')->latest()->limit(12)->get();

        // Statistik klub, pelatih, atlet, wasit (cache 10 menit)
        ['klubCount' => $klubCount, 'pelatihCount' => $pelatihCount, 'atletCount' => $atletCount, 'wasitCount' => $wasitCount]
            = SiteCache::homeStats();

        return view($theme . '.index', compact('beritaUtama', 'posts', 'galleries', 'klubCount', 'pelatihCount', 'atletCount', 'wasitCount'));
    }

    public function showPage($slug)
    {
        $theme = SiteCache::themePath();
        $data = []; // Data yang diperlukan
    
        // Temukan halaman berdasarkan slug
        $page = Page::where('slug', $slug)->firstOrFail();
        
        return view($theme . '.pages', compact('data','page'));
    }

    public function showPost($slug)
    {
        $theme = SiteCache::themePath();

        // Temukan halaman berdasarkan slug
        $page = Posts::where('slug', $slug)
            ->whereIn('status', ['published', 'approved'])
            ->firstOrFail();

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
        $theme = SiteCache::themePath();
        // $data = []; // Data yang diperlukan
    
        // Temukan halaman berdasarkan slug
        $category = Categories::where('slug', $slug)->firstOrFail();

        $posts = Posts::with('category')->where('category_id', $category->id)->latest()->paginate(8); // Batasi 10 posting per halaman

        // dd($posts);
        return view($theme . '.posts_categories', compact('category','posts'));
    }

    public function allPosts(){
        $theme = SiteCache::themePath();
        // $data = []; // Data yang diperlukan

        $category = null;
        $posts = Posts::with('category')->whereIn('status', ['published', 'approved'])->latest()->paginate(8);


        // dd($posts);
        return view($theme . '.posts_categories', compact('category', 'posts'));
    }

    public function athletes(Request $request)
    {
        $theme = SiteCache::themePath();

        $search       = $request->input('search', '');
        $teamHash     = (string) ($request->input('team_id') ?? '');
        $districtHash = (string) ($request->input('district_id') ?? '');
        $gender       = $request->input('gender');
        $safeLike     = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $teamId     = $teamHash !== '' ? Hashid::decode($teamHash) : null;
        $districtId = $districtHash !== '' ? Hashid::decode($districtHash) : null;

        $query = Player::with('team.district')->where('status', 'registered');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }
        if ($teamId) {
            $query->where('team_id', $teamId);
        }
        if ($districtId) {
            $query->whereHas('team', fn ($q) => $q->where('district_id', $districtId));
        }
        if (in_array($gender, ['L', 'P'])) {
            $query->where('gender', $gender);
        }

        $players   = $query->orderBy('name')->paginate(24)->withQueryString();
        $teams     = Team::where('status', 'aktif')->orderBy('name')->get();
        $districts = District::orderBy('name')->get();

        return view($theme . '.athletes', compact('players', 'teams', 'districts', 'search', 'teamHash', 'districtHash', 'gender'));
    }

    public function athleteDetail(string $hash)
    {
        $id     = Hashid::decode($hash) ?? abort(404);
        $theme  = SiteCache::themePath();
        $player = Player::with('team.district')->where('status', 'registered')->findOrFail($id);

        $relatedPlayers = collect();
        if ($player->team_id) {
            $relatedPlayers = Player::with('team')
                ->where('status', 'registered')
                ->where('team_id', $player->team_id)
                ->where('id', '!=', $player->id)
                ->orderBy('name')
                ->limit(6)
                ->get();
        }

        return view($theme . '.detail_athlete', compact('player', 'relatedPlayers'));
    }

    public function dpd(Request $request)
    {
        $theme    = SiteCache::themePath();
        $search   = $request->input('search', '');
        $safeLike = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $query = District::withCount(['teams', 'referees', 'players', 'coaches']);
        if ($safeLike !== '') {
            $query->where(function ($q) use ($safeLike) {
                $q->where('name', 'like', '%' . $safeLike . '%')
                  ->orWhere('district_name', 'like', '%' . $safeLike . '%');
            });
        }

        $districts = $query->orderBy('name')->get();
        return view($theme . '.dpd', compact('districts', 'search'));
    }

    public function dpdDetail(string $slug)
    {
        $theme    = SiteCache::themePath();
        $district = District::withCount(['teams', 'referees', 'players', 'coaches'])
            ->where('slug', $slug)
            ->firstOrFail();

        $teams = Team::where('district_id', $district->id)
            ->where('status', 'aktif')
            ->withCount(['players' => fn ($q) => $q->where('status', 'registered')])
            ->orderBy('name')
            ->get();

        return view($theme . '.detail_dpd', compact('district', 'teams'));
    }

    public function coaches(Request $request)
    {
        $theme        = SiteCache::themePath();
        $search       = $request->input('search', '');
        $districtHash = (string) ($request->input('district_id') ?? '');
        $safeLike     = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $districtId = $districtHash !== '' ? Hashid::decode($districtHash) : null;

        $query = Coach::with('team.district')->where('status', 'registered');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }
        if ($districtId) {
            $query->whereHas('team', fn ($q) => $q->where('district_id', $districtId));
        }

        $coaches   = $query->orderBy('name')->paginate(24)->withQueryString();
        $districts = District::orderBy('name')->get();

        return view($theme . '.coaches', compact('coaches', 'districts', 'search', 'districtHash'));
    }


    public function referees(Request $request)
    {
        $theme        = SiteCache::themePath();
        $search       = $request->input('search', '');
        $districtHash = (string) ($request->input('district_id') ?? '');
        $safeLike     = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $districtId = $districtHash !== '' ? Hashid::decode($districtHash) : null;

        $query = Referee::with('district');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }
        if ($districtId) {
            $query->where('district_id', $districtId);
        }

        $referees  = $query->orderBy('name')->paginate(24)->withQueryString();
        $districts = District::orderBy('name')->get();

        return view($theme . '.referees', compact('referees', 'districts', 'search', 'districtHash'));
    }

    public function clubs(Request $request)
    {
        $theme = SiteCache::themePath();

        $search       = $request->input('search', '');
        $districtHash = (string) ($request->input('district_id') ?? '');

        // Escape wildcard chars to prevent expensive LIKE patterns
        $safeLike = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $districtId = $districtHash !== '' ? Hashid::decode($districtHash) : null;

        $query = Team::with('district')->where('status', 'aktif');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }

        if ($districtId) {
            $query->where('district_id', $districtId);
        }

        $teams     = $query->orderBy('name')->paginate(12)->withQueryString();
        $districts = District::orderBy('name')->get();

        return view($theme . '.clubs', compact('teams', 'districts', 'search', 'districtHash'));
    }

    public function clubDetail(string $slug)
    {
        $theme = SiteCache::themePath();

        $team = Team::with('district')
            ->where('status', 'aktif')
            ->where('slug', $slug)
            ->firstOrFail();

        $activePlayers = $team->players()->where('status', 'registered')->get();
        $activeCoaches = $team->coaches()->where('status', 'registered')->get();
        $officials     = $team->officials()->get();

        return view($theme . '.detail_club', compact('team', 'activePlayers', 'activeCoaches', 'officials'));
    }
}
