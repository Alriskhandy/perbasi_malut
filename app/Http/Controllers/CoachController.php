<?php

namespace App\Http\Controllers;

use App\Helpers\Media;
use App\Models\Coach;
use App\Models\Team;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        $query = Coach::with('team')->latest();

        if ($request->filled('team_id')) $query->where('team_id', $request->team_id);
        if ($request->filled('license')) $query->where('license', $request->license);
        if ($request->filled('status'))  $query->where('status', $request->status);

        $coaches = $query->get();
        $teams   = Team::orderBy('name')->get();
        return view('backend.coaches.index', compact('coaches', 'teams'));
    }

    public function bulkAction(Request $request)
    {
        $ids = array_filter((array) $request->input('selected_ids', []));
        if (empty($ids)) {
            notify()->error('Tidak ada data yang dipilih.');
            return redirect()->back()->withInput();
        }

        match ($request->action) {
            'registered'     => Coach::whereIn('id', $ids)->update(['status' => 'registered']),
            'not_registered' => Coach::whereIn('id', $ids)->update(['status' => 'not registered']),
            'hapus'          => Coach::whereIn('id', $ids)->delete(),
            default          => null,
        };

        $labels = ['registered' => 'di-register', 'not_registered' => 'di-unregister', 'hapus' => 'dihapus'];
        notify()->success('Pelatih berhasil ' . ($labels[$request->action] ?? 'diproses') . '.');
        return redirect()->route('coaches.index');
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        return view('backend.coaches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'id_number'      => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:255',
            'contact'        => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'status'         => 'required|in:registered,not registered',
            'img_path'       => 'nullable|string|max:255',
            'team_id'        => 'required|exists:teams,id',
            'education'      => 'nullable|string|max:255',
            'province'       => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'license'        => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:100',
        ]);

        try {
            $data = $request->only([
                'name', 'id_number', 'email', 'contact', 'address', 'status', 'img_path',
                'team_id', 'education', 'province', 'city', 'license', 'license_number',
            ]);
            $data['img_path'] = Media::toRelativePath($data['img_path'] ?? null);
            Coach::create($data);

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
            'name'           => 'required|string|max:255',
            'id_number'      => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:255',
            'contact'        => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'status'         => 'required|in:registered,not registered',
            'img_path'       => 'nullable|string|max:255',
            'team_id'        => 'required|exists:teams,id',
            'education'      => 'nullable|string|max:255',
            'province'       => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'license'        => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:100',
        ]);

        try {
            $data = $request->only([
                'name', 'id_number', 'email', 'contact', 'address', 'status', 'img_path',
                'team_id', 'education', 'province', 'city', 'license', 'license_number',
            ]);
            $data['img_path'] = Media::toRelativePath($data['img_path'] ?? null);
            $coach->update($data);

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
