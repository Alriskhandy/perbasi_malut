<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\Page;
use App\Models\Posts;
use App\Models\Theme;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view("backend.index",[
             'totalPages'     => Page::count(),
            'totalPosts'     => Posts::count(),
            'totalGalleries' => Galleries::count(),
            'themes'     => Theme::count(),
        ]);
    }
}
