<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(){
         // Mengambil informasi penggunaan disk lokal
         $disk = Storage::disk('public');
         $totalSpace = $this->getDiskTotalSpace($disk);
         $usedSpace = $this->getUsedSpace($disk);
 
         $percentage = ($usedSpace / $totalSpace) * 100;
 
         $totalSpaceGB = $totalSpace / 1024 / 1024 / 1024;
         $usedSpaceGB = $usedSpace / 1024 / 1024 / 1024;

        return view("backend.media.index",[
            [
                'current_usage' => number_format($usedSpaceGB, 2) . ' GB',
                'max_usage' => number_format($totalSpaceGB, 2) . ' GB',
                'percentage' => number_format($percentage, 2),
            ]
        ]);
    }

    private function getUsedSpace($disk)
    {
        $usedSpace = 0;
        $files = $disk->allFiles('/');
        foreach ($files as $file) {
            $usedSpace += $disk->size($file);
        }
        return $usedSpace;
    }

    private function getDiskTotalSpace($disk)
    {
        // This function will use PHP's built-in functions to get disk space
        // Example: return disk_total_space('/path/to/your/storage');
        $path = $disk->path('/');
        return disk_total_space($path);
    }

    public function upload(Request $request)
    {
        // Validasi file URL
        $request->validate([
            'file_url' => 'required|url',
        ]);

        $fileUrl = $request->input('file_url');

        // Simulasi pengolahan file (misalnya, menyimpan URL ke database)
        // Contoh:
        // FileModel::create(['url' => $fileUrl]);
        dd($fileUrl);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
