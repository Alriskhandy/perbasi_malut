<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::with('team')->latest();

        if ($request->filled('team_id')) $query->where('team_id', $request->team_id);
        if ($request->filled('gender'))  $query->where('gender', $request->gender);
        if ($request->filled('status'))  $query->where('status', $request->status);

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
            'aktifkan'    => Player::whereIn('id', $ids)->update(['status' => 'active']),
            'nonaktifkan' => Player::whereIn('id', $ids)->update(['status' => 'inactive']),
            'hapus'       => Player::whereIn('id', $ids)->delete(),
            default       => null,
        };

        $labels = ['aktifkan' => 'diaktifkan', 'nonaktifkan' => 'dinonaktifkan', 'hapus' => 'dihapus'];
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
            'name'     => 'required|string|max:255',
            'gender'   => 'required|in:L,P',
            'height'   => 'nullable|integer|min:100|max:250',
            'weight'   => 'nullable|integer|min:30|max:200',
            'status'   => 'required|in:active,inactive',
            'position' => 'nullable|string|max:100',
            'img_path' => 'nullable|string|max:255',
            'team_id'  => 'required|exists:teams,id',
        ]);

        try {
            Player::create($request->only(['name', 'gender', 'height', 'weight', 'status', 'position', 'img_path', 'team_id']));

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
            'name'     => 'required|string|max:255',
            'gender'   => 'required|in:L,P',
            'height'   => 'nullable|integer|min:100|max:250',
            'weight'   => 'nullable|integer|min:30|max:200',
            'status'   => 'required|in:active,inactive',
            'position' => 'nullable|string|max:100',
            'img_path' => 'nullable|string|max:255',
            'team_id'  => 'required|exists:teams,id',
        ]);

        try {
            $player->update($request->only(['name', 'gender', 'height', 'weight', 'status', 'position', 'img_path', 'team_id']));

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
