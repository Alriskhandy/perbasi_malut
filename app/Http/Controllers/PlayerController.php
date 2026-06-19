<?php

namespace App\Http\Controllers;

use App\Helpers\Media;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::with('team')->latest();

        if ($request->filled('team_id'))  $query->where('team_id', $request->team_id);
        if ($request->filled('gender'))   $query->where('gender', $request->gender);
        if ($request->filled('position')) $query->where('position', $request->position);
        if ($request->filled('status'))   $query->where('status', $request->status);

        $players = $query->get();
        $teams   = Team::orderBy('name')->get();
        return view('backend.players.index', compact('players', 'teams'));
    }

    public function bulkAction(Request $request)
    {
        $ids = array_filter((array) $request->input('selected_ids', []));
        if (empty($ids)) {
            notify()->error('Tidak ada data yang dipilih.');
            return redirect()->back()->withInput();
        }

        match ($request->action) {
            'registered'     => Player::whereIn('id', $ids)->update(['status' => 'registered']),
            'not_registered' => Player::whereIn('id', $ids)->update(['status' => 'not registered']),
            'hapus'          => Player::whereIn('id', $ids)->delete(),
            default          => null,
        };

        $labels = ['registered' => 'di-register', 'not_registered' => 'di-unregister', 'hapus' => 'dihapus'];
        notify()->success('Pemain berhasil ' . ($labels[$request->action] ?? 'diproses') . '.');
        return redirect()->route('players.index');
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('backend.players.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'id_number'   => 'nullable|string|max:100',
            'gender'      => 'required|in:L,P',
            'height'      => 'nullable|integer|min:100|max:250',
            'weight'      => 'nullable|integer|min:30|max:200',
            'status'      => 'required|in:registered,not registered',
            'position'    => 'nullable|string|max:100',
            'img_path'    => 'nullable|string|max:255',
            'team_id'     => 'required|exists:teams,id',
            'birth_place' => 'nullable|string|max:255',
            'birth_date'  => 'nullable|date',
            'education'   => 'nullable|string|max:255',
            'joined_at'   => 'nullable|date',
            'contact'     => 'nullable|string|max:50',
            'email'       => 'nullable|email|max:255',
            'province'    => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->only([
                'name', 'id_number', 'gender', 'height', 'weight', 'status', 'position',
                'img_path', 'team_id', 'birth_place', 'birth_date', 'education',
                'joined_at', 'contact', 'email', 'province', 'city',
            ]);
            $data['img_path'] = Media::toRelativePath($data['img_path'] ?? null);
            Player::create($data);

            notify()->success('Pemain berhasil ditambahkan!');
            return redirect()->route('players.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan pemain! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $player = Player::findOrFail($id);
        $teams = Team::orderBy('name')->get();
        return view('backend.players.edit', compact('player', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'id_number'   => 'nullable|string|max:100',
            'gender'      => 'required|in:L,P',
            'height'      => 'nullable|integer|min:100|max:250',
            'weight'      => 'nullable|integer|min:30|max:200',
            'status'      => 'required|in:registered,not registered',
            'position'    => 'nullable|string|max:100',
            'img_path'    => 'nullable|string|max:255',
            'team_id'     => 'required|exists:teams,id',
            'birth_place' => 'nullable|string|max:255',
            'birth_date'  => 'nullable|date',
            'education'   => 'nullable|string|max:255',
            'joined_at'   => 'nullable|date',
            'contact'     => 'nullable|string|max:50',
            'email'       => 'nullable|email|max:255',
            'province'    => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->only([
                'name', 'id_number', 'gender', 'height', 'weight', 'status', 'position',
                'img_path', 'team_id', 'birth_place', 'birth_date', 'education',
                'joined_at', 'contact', 'email', 'province', 'city',
            ]);
            $data['img_path'] = Media::toRelativePath($data['img_path'] ?? null);
            $player->update($data);

            notify()->success('Pemain berhasil diperbarui!');
            return redirect()->route('players.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal memperbarui pemain! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        notify()->success('Pemain berhasil dihapus!');
        return redirect()->route('players.index');
    }
}
