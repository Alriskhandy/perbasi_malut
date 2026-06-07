<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Team;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::with('team')->latest()->get();
        return view('backend.coaches.index', compact('coaches'));
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('backend.coaches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|max:255',
            'contact'  => 'nullable|string|max:50',
            'address'  => 'nullable|string',
            'status'   => 'required|in:active,inactive',
            'img_path' => 'nullable|string|max:255',
            'team_id'  => 'required|exists:teams,id',
        ]);

        try {
            Coach::create($request->only(['name', 'email', 'contact', 'address', 'status', 'img_path', 'team_id']));

            notify()->success('Pelatih berhasil ditambahkan!');
            return redirect()->route('coaches.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan pelatih! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $coach = Coach::findOrFail($id);
        $teams = Team::orderBy('name')->get();
        return view('backend.coaches.edit', compact('coach', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $coach = Coach::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'nullable|email|max:255',
            'contact'  => 'nullable|string|max:50',
            'address'  => 'nullable|string',
            'status'   => 'required|in:active,inactive',
            'img_path' => 'nullable|string|max:255',
            'team_id'  => 'required|exists:teams,id',
        ]);

        try {
            $coach->update($request->only(['name', 'email', 'contact', 'address', 'status', 'img_path', 'team_id']));

            notify()->success('Pelatih berhasil diperbarui!');
            return redirect()->route('coaches.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal memperbarui pelatih! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $coach = Coach::findOrFail($id);
        $coach->delete();

        notify()->success('Pelatih berhasil dihapus!');
        return redirect()->route('coaches.index');
    }
}
