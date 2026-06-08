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
use App\Models\Theme;
class FrontEndController extends Controller
{
   
    public function index()
    {
        $theme = Theme::where('active', true)->first()->path;

        // Ambil berita utama
        $beritaUtama = Posts::where('is_featured', 1)->latest()->get();

        // Ambil ID dari post yang sudah digunakan
        $excludedIds = $beritaUtama->pluck('id')
            ->unique()
            ->toArray();

        // Ambil berita lainnya yang tidak termasuk dalam berita utama dan pengumuman
        $posts = Posts::whereIn('status', ['published', 'approved'])
            ->whereNotIn('id', $excludedIds)
            ->latest()
            ->get();

        // Ambil Galleri
        $galleries = Galleries::all();

        // Statistik klub, pelatih, atlet, wasit
        $klubCount = Team::count();
        $pelatihCount = Coach::count();
        $atletCount = Player::count();
        $wasitCount = Referee::count();

        return view($theme . '.index', compact('beritaUtama', 'posts', 'galleries', 'klubCount', 'pelatihCount', 'atletCount', 'wasitCount'));
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

    public function athletes(Request $request)
    {
        $theme = Theme::where('active', true)->first()->path;

        $search     = $request->input('search', '');
        $teamId     = $request->integer('team_id');
        $districtId = $request->integer('district_id');
        $gender     = $request->input('gender');
        $safeLike   = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $query = Player::with('team.district')->where('status', 'active');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }
        if ($teamId > 0) {
            $query->where('team_id', $teamId);
        }
        if ($districtId > 0) {
            $query->whereHas('team', fn ($q) => $q->where('district_id', $districtId));
        }
        if (in_array($gender, ['L', 'P'])) {
            $query->where('gender', $gender);
        }

        $players   = $query->orderBy('name')->paginate(24)->withQueryString();
        $teams     = Team::where('status', 'aktif')->orderBy('name')->get();
        $districts = District::orderBy('name')->get();

        return view($theme . '.athletes', compact('players', 'teams', 'districts', 'search', 'teamId', 'districtId', 'gender'));
    }

    public function athleteDetail(string $hash)
    {
        $id     = Hashid::decode($hash) ?? abort(404);
        $theme  = Theme::where('active', true)->first()->path;
        $player = Player::with('team.district')->where('status', 'active')->findOrFail($id);

        $relatedPlayers = collect();
        if ($player->team_id) {
            $relatedPlayers = Player::with('team')
                ->where('status', 'active')
                ->where('team_id', $player->team_id)
                ->where('id', '!=', $player->id)
                ->orderBy('name')
                ->limit(6)
                ->get();
        }

        return view($theme . '.detail_athlete', compact('player', 'relatedPlayers'));
    }

    public function coaches(Request $request)
    {
        $theme      = Theme::where('active', true)->first()->path;
        $search     = $request->input('search', '');
        $districtId = $request->integer('district_id');
        $safeLike   = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $query = Coach::with('team.district')->where('status', 'active');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }
        if ($districtId > 0) {
            $query->whereHas('team', fn ($q) => $q->where('district_id', $districtId));
        }

        $coaches   = $query->orderBy('name')->paginate(24)->withQueryString();
        $districts = District::orderBy('name')->get();

        return view($theme . '.coaches', compact('coaches', 'districts', 'search', 'districtId'));
    }


    public function referees(Request $request)
    {
        $theme      = Theme::where('active', true)->first()->path;
        $search     = $request->input('search', '');
        $districtId = $request->integer('district_id');
        $safeLike   = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $query = Referee::with('district');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }
        if ($districtId > 0) {
            $query->where('district_id', $districtId);
        }

        $referees  = $query->orderBy('name')->paginate(24)->withQueryString();
        $districts = District::orderBy('name')->get();

        return view($theme . '.referees', compact('referees', 'districts', 'search', 'districtId'));
    }

    public function clubs(Request $request)
    {
        $theme = Theme::where('active', true)->first()->path;

        $search     = $request->input('search', '');
        $districtId = $request->integer('district_id');

        // Escape wildcard chars to prevent expensive LIKE patterns
        $safeLike = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], trim($search));

        $query = Team::with('district')->where('status', 'aktif');

        if ($safeLike !== '') {
            $query->where('name', 'like', '%' . $safeLike . '%');
        }

        if ($districtId > 0) {
            $query->where('district_id', $districtId);
        }

        $teams     = $query->orderBy('name')->paginate(12)->withQueryString();
        $districts = District::orderBy('name')->get();

        return view($theme . '.clubs', compact('teams', 'districts', 'search', 'districtId'));
    }

    public function clubDetail(string $slug)
    {
        $theme = Theme::where('active', true)->first()->path;

        $team = Team::with('district')
            ->where('status', 'aktif')
            ->where('slug', $slug)
            ->firstOrFail();

        $activePlayers = $team->players()->where('status', 'active')->get();
        $activeCoaches = $team->coaches()->where('status', 'active')->get();
        $officials     = $team->officials()->get();

        return view($theme . '.detail_club', compact('team', 'activePlayers', 'activeCoaches', 'officials'));
    }
}
