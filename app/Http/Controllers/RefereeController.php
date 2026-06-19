<?php

namespace App\Http\Controllers;

use App\Helpers\Media;
use App\Models\District;
use App\Models\Referee;
use App\Models\Team;
use Illuminate\Http\Request;

class RefereeController extends Controller
{
    public function index(Request $request)
    {
        $query = Referee::with(['district', 'team'])->latest();

        if ($request->filled('district_id')) $query->where('district_id', $request->district_id);
        if ($request->filled('license'))     $query->where('license', $request->license);
        if ($request->filled('status'))      $query->where('status', $request->status);

        $referees  = $query->get();
        $districts = District::orderBy('name')->get();
        return view('backend.referees.index', compact('referees', 'districts'));
    }

    public function bulkAction(Request $request)
    {
        $ids = array_filter((array) $request->input('selected_ids', []));
        if (empty($ids)) {
            notify()->error('Tidak ada data yang dipilih.');
            return redirect()->back()->withInput();
        }

        match ($request->action) {
            'registered'     => Referee::whereIn('id', $ids)->update(['status' => 'registered']),
            'not_registered' => Referee::whereIn('id', $ids)->update(['status' => 'not registered']),
            'hapus'          => Referee::whereIn('id', $ids)->delete(),
            default          => null,
        };

        $labels = ['registered' => 'di-register', 'not_registered' => 'di-unregister', 'hapus' => 'dihapus'];
        notify()->success('Wasit berhasil ' . ($labels[$request->action] ?? 'diproses') . '.');
        return redirect()->route('referees.index');
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        $teams     = Team::orderBy('name')->get();
        return view('backend.referees.create', compact('districts', 'teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'id_number'      => 'nullable|string|max:100',
            'status'         => 'required|in:registered,not registered',
            'img_path'       => 'nullable|string|max:255',
            'district_id'    => 'required|exists:districts,id',
            'license'        => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:255',
            'contact'        => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'education'      => 'nullable|string|max:255',
            'province'       => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'team_id'        => 'nullable|exists:teams,id',
        ]);

        try {
            $data = $request->only([
                'name', 'id_number', 'status', 'img_path', 'district_id',
                'license', 'license_number', 'email', 'contact', 'address',
                'education', 'province', 'city', 'team_id',
            ]);
            $data['img_path'] = Media::toRelativePath($data['img_path'] ?? null);
            Referee::create($data);

            notify()->success('Wasit berhasil ditambahkan!');
            return redirect()->route('referees.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan wasit! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $referee   = Referee::findOrFail($id);
        $districts = District::orderBy('name')->get();
        $teams     = Team::orderBy('name')->get();
        return view('backend.referees.edit', compact('referee', 'districts', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $referee = Referee::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'id_number'      => 'nullable|string|max:100',
            'status'         => 'required|in:registered,not registered',
            'img_path'       => 'nullable|string|max:255',
            'district_id'    => 'required|exists:districts,id',
            'license'        => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:255',
            'contact'        => 'nullable|string|max:50',
            'address'        => 'nullable|string',
            'education'      => 'nullable|string|max:255',
            'province'       => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'team_id'        => 'nullable|exists:teams,id',
        ]);

        try {
            $data = $request->only([
                'name', 'id_number', 'status', 'img_path', 'district_id',
                'license', 'license_number', 'email', 'contact', 'address',
                'education', 'province', 'city', 'team_id',
            ]);
            $data['img_path'] = Media::toRelativePath($data['img_path'] ?? null);
            $referee->update($data);

            notify()->success('Wasit berhasil diperbarui!');
            return redirect()->route('referees.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal memperbarui wasit! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $referee = Referee::findOrFail($id);
        $referee->delete();

        notify()->success('Wasit berhasil dihapus!');
        return redirect()->route('referees.index');
    }
}
