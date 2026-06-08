<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Referee;
use Illuminate\Http\Request;

class RefereeController extends Controller
{
    public function index(Request $request)
    {
        $query = Referee::with('district')->latest();

        if ($request->filled('district_id')) $query->where('district_id', $request->district_id);

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

        if ($request->action === 'hapus') {
            Referee::whereIn('id', $ids)->delete();
            notify()->success('Wasit berhasil dihapus.');
        }

        return redirect()->route('referees.index');
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('backend.referees.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'img_path'    => 'nullable|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        try {
            Referee::create($request->only(['name', 'img_path', 'district_id']));

            notify()->success('Wasit berhasil ditambahkan!');
            return redirect()->route('referees.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan wasit! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $referee = Referee::findOrFail($id);
        $districts = District::orderBy('name')->get();
        return view('backend.referees.edit', compact('referee', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $referee = Referee::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'img_path'    => 'nullable|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        try {
            $referee->update($request->only(['name', 'img_path', 'district_id']));

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
