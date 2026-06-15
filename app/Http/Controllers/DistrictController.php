<?php

namespace App\Http\Controllers;

use App\Helpers\Media;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::withCount(['teams', 'referees'])->latest()->get();
        return view('backend.districts.index', compact('districts'));
    }

    public function create()
    {
        return view('backend.districts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'nullable|string|max:255|unique:districts,slug|regex:/^[a-z0-9-]+$/',
            'district_name' => 'nullable|string|max:255',
            'pic'           => 'nullable|string|max:255',
            'pic_position'  => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255',
            'contact'       => 'nullable|string|max:50',
            'address'       => 'nullable|string',
            'web_url'       => 'nullable|url|max:255',
            'img_path'      => 'nullable|string|max:255',
        ]);

        try {
            $data = [
                'name'          => $request->name,
                'district_name' => $request->district_name,
                'pic'           => $request->pic,
                'pic_position'  => $request->pic_position,
                'email'         => $request->email,
                'contact'       => $request->contact,
                'address'       => $request->address,
                'web_url'       => $request->web_url,
                'img_path'      => Media::toRelativePath($request->img_path),
            ];
            if ($request->filled('slug')) {
                $data['slug'] = $request->slug;
            }
            District::create($data);

            notify()->success('Distrik berhasil ditambahkan!');
            return redirect()->route('districts.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal menambahkan distrik! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);
        return view('backend.districts.edit', compact('district'));
    }

    public function update(Request $request, $id)
    {
        $district = District::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'slug'          => 'nullable|string|max:255|unique:districts,slug,' . $id . '|regex:/^[a-z0-9-]+$/',
            'district_name' => 'nullable|string|max:255',
            'pic'           => 'nullable|string|max:255',
            'pic_position'  => 'nullable|string|max:255',
            'email'         => 'nullable|email|max:255',
            'contact'       => 'nullable|string|max:50',
            'address'       => 'nullable|string',
            'web_url'       => 'nullable|url|max:255',
            'img_path'      => 'nullable|string|max:255',
        ]);

        try {
            $data = [
                'name'          => $request->name,
                'district_name' => $request->district_name,
                'pic'           => $request->pic,
                'pic_position'  => $request->pic_position,
                'email'         => $request->email,
                'contact'       => $request->contact,
                'address'       => $request->address,
                'web_url'       => $request->web_url,
                'img_path'      => Media::toRelativePath($request->img_path),
            ];
            if ($request->filled('slug')) {
                $data['slug'] = $request->slug;
            }
            $district->update($data);

            notify()->success('Distrik berhasil diperbarui!');
            return redirect()->route('districts.index');
        } catch (\Throwable $th) {
            notify()->error('Gagal memperbarui distrik! ' . $th->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        notify()->success('Distrik berhasil dihapus!');
        return redirect()->route('districts.index');
    }
}
