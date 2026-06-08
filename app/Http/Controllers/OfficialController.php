<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Team;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function index(Request $request)
    {
        $query = Official::with('team')->latest();

        if ($request->filled('team_id')) $query->where('team_id', $request->team_id);

        $officials = $query->get();
        $teams     = Team::orderBy('name')->get();
        return view('backend.officials.index', compact('officials', 'teams'));
    }

    public function bulkAction(Request $request)
    {
        $ids = array_filter((array) $request->input('selected_ids', []));
        if (empty($ids)) {
            notify()->error('Tidak ada data yang dipilih.');
            return redirect()->back()->withInput();
        }

        if ($request->action === 'hapus') {
            Official::whereIn('id', $ids)->delete();
            notify()->success('Official berhasil dihapus.');
        }

        return redirect()->route('officials.index');
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('backend.officials.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'img_path' => 'nullable|string|max:255',
            'team_id'  => 'required|exists:teams,id',
        ]);

        try {
            Official::create($request->only(['name', 'img_path', 'team_id']));

            notify()->success('Official berhasil ditambahkan!');
            return redirect()->route('officials.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan official! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $official = Official::findOrFail($id);
        $teams = Team::orderBy('name')->get();
        return view('backend.officials.edit', compact('official', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $official = Official::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'img_path' => 'nullable|string|max:255',
            'team_id'  => 'required|exists:teams,id',
        ]);

        try {
            $official->update($request->only(['name', 'img_path', 'team_id']));

            notify()->success('Official berhasil diperbarui!');
            return redirect()->route('officials.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal memperbarui official! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $official = Official::findOrFail($id);
        $official->delete();

        notify()->success('Official berhasil dihapus!');
        return redirect()->route('officials.index');
    }
}
