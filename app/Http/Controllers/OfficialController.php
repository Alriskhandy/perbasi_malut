<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Team;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::with('team')->latest()->get();
        return view('backend.officials.index', compact('officials'));
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
