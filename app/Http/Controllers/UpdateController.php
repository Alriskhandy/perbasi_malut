<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class UpdateController extends Controller
{
   
    public function updateApp(Request $request)
    {
        // Jalankan command yang sudah kita buat sebelumnya
        Artisan::call('app:update');

        // Ambil outputnya
        // $output = Artisan::output();
        notify()->success('Update berhasil dijalankan!');
        // Bisa redirect balik ke halaman admin dengan notifikasi
        return back()->with('success', 'Update berhasil dijalankan!');
    }
}
