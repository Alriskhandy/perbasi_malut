<?php

namespace App\Http\Controllers;

use App\Helpers\Media;
use App\Models\District;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('district')->latest()->get();
        return view('backend.teams.index', compact('teams'));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('backend.teams.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:teams,slug|regex:/^[a-z0-9-]+$/',
            'email'       => 'nullable|email|max:255',
            'contact'     => 'nullable|string|max:50',
            'address'     => 'nullable|string',
            'status'      => 'required|in:aktif,tidak aktif',
            'img_path'    => 'nullable|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'pic'         => 'nullable|string|max:255',
            'pic_img_path' => 'nullable|string|max:255',
            'founded_at'  => 'nullable|date',
            'bank_account' => 'nullable|string|max:255',
            'sk_path'     => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->only([
                'name', 'email', 'contact', 'address', 'status', 'img_path', 'district_id',
                'pic', 'pic_img_path', 'founded_at', 'bank_account', 'sk_path',
            ]);
            $data['img_path']     = Media::toRelativePath($data['img_path'] ?? null);
            $data['pic_img_path'] = Media::toRelativePath($data['pic_img_path'] ?? null);
            $data['sk_path']      = Media::toRelativePath($data['sk_path'] ?? null);
            if ($request->filled('slug')) {
                $data['slug'] = $request->slug;
            }
            Team::create($data);

            notify()->success('Klub berhasil ditambahkan!');
            return redirect()->route('teams.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan tim! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $districts = District::orderBy('name')->get();
        return view('backend.teams.edit', compact('team', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:teams,slug,' . $id . '|regex:/^[a-z0-9-]+$/',
            'email'       => 'nullable|email|max:255',
            'contact'     => 'nullable|string|max:50',
            'address'     => 'nullable|string',
            'status'      => 'required|in:aktif,tidak aktif',
            'img_path'    => 'nullable|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'pic'         => 'nullable|string|max:255',
            'pic_img_path' => 'nullable|string|max:255',
            'founded_at'  => 'nullable|date',
            'bank_account' => 'nullable|string|max:255',
            'sk_path'     => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->only([
                'name', 'email', 'contact', 'address', 'status', 'img_path', 'district_id',
                'pic', 'pic_img_path', 'founded_at', 'bank_account', 'sk_path',
            ]);
            $data['img_path']     = Media::toRelativePath($data['img_path'] ?? null);
            $data['pic_img_path'] = Media::toRelativePath($data['pic_img_path'] ?? null);
            $data['sk_path']      = Media::toRelativePath($data['sk_path'] ?? null);
            if ($request->filled('slug')) {
                $data['slug'] = $request->slug;
            }
            $team->update($data);

            notify()->success('Klub berhasil diperbarui!');
            return redirect()->route('teams.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal memperbarui klub! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        notify()->success('Klub berhasil dihapus!');
        return redirect()->route('teams.index');
    }
}
