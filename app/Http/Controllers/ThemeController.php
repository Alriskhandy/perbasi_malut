<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    
    function index() {
        return view('backend.themes.index',[
            'themes'=> Theme::all()
        ]);
    }
    function switchTheme($themeId) {
        //   Menonaktifkan semua tema
        Theme::query()->update(['active' => false]);
    
        // Mengaktifkan tema yang dipilih
        $theme = Theme::findOrFail($themeId);
        $theme->active = true;
        $theme->save();
    
        return redirect()->back()->with('success','Tema Berhasil Di Ganti');
    }
}
