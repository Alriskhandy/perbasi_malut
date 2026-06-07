<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\DB;


class GeneralSettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
{
    // Ambil semua pengaturan dari tabel general_settings
    $settings = DB::table('general_settings')->pluck('value', 'key');

    // Ambil versi aplikasi saat ini dari config
    $currentVersion = config('app.version');

    // Ambil versi terbaru dari server update
    $remoteVersion = null;
    try {
        $response = Http::get('https://cms-unkhair.wahyuumaternate.my.id/api/check-update');
        if ($response->ok()) {
            $remoteVersion = $response->json('version');
        }
    } catch (\Exception $e) {
        // Optional: log error atau tangani jika server update tidak bisa diakses
        $remoteVersion = null;
    }
// dd($remoteVersion);
    // Tampilkan halaman settings
    return view('backend.settings.index', [
        'settings' => $settings,
        'currentVersion' => $currentVersion,
        'remoteVersion' => $remoteVersion,
    ]);
    }

    /**
     * Memperbarui pengaturan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try {
            // Definisikan semua field yang akan diupdate
            $fields = [
                'site_name', 'footer_text', 'app_url', 'loader_image', 'site_email',
                'mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password',
                'mail_encryption', 'mail_from_address', 'mail_from_name',
                'database_connection', 'database_host', 'database_port', 'database_name',
                'seo_title', 'seo_description', 'seo_keywords'
            ];
    
            // Validasi semua input
            $validatedData = $request->validate([
                'site_name' => 'nullable|string|max:255',
                'footer_text' => 'nullable|string|max:255',
                'app_url' => 'nullable|string|max:255',
                'loader_image' => 'nullable|string|max:255',
                'site_email' => 'nullable|email|max:255',
                'mail_mailer' => 'nullable|string|max:255',
                'mail_host' => 'nullable|string|max:255',
                'mail_port' => 'nullable|string|max:255',
                'mail_username' => 'nullable|string|max:255',
                'mail_password' => 'nullable|string|max:255',
                'mail_encryption' => 'nullable|string|max:255',
                'mail_from_address' => 'nullable|email|max:255',
                'mail_from_name' => 'nullable|string|max:255',
                'database_connection' => 'nullable|string|max:255',
                'database_host' => 'nullable|string|max:255',
                'database_port' => 'nullable|string|max:255',
                'database_name' => 'nullable|string|max:255',
                'site_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                 // SEO
                'seo_title' => 'nullable|string|max:255',
                'seo_description' => 'nullable|string|max:500',
                'seo_keywords' => 'nullable|string|max:500',
            ]);
    
            // Proses upload logo baru jika ada
            if ($request->hasFile('site_logo')) {
                // Cek logo lama
                $existingLogo = DB::table('general_settings')->where('key', 'site_logo')->value('value');
                if ($existingLogo && Storage::disk('public')->exists($existingLogo)) {
                    Storage::disk('public')->delete($existingLogo);
                }
    
                // Upload logo baru
                $logoPath = $request->file('site_logo')->store('logo', 'public');
                DB::table('general_settings')->where('key', 'site_logo')->update([
                    'value' => $logoPath,
                    'updated_at' => now(),
                ]);
            }
    
            // Update semua field yang lain
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    DB::table('general_settings')->where('key', $field)->update([
                        'value' => $validatedData[$field],
                        'updated_at' => now(),
                    ]);
                }
            }
    
            notify()->success('Settings berhasil diperbarui.');
            return redirect()->back();
    
        } catch (\Throwable $th) {
            notify()->error('Settings gagal diperbarui: ' . $th->getMessage());
            return redirect()->back();
        }
    }
    

public function downloadStorageBackup()
{
    try {
        // Nama file zip yang akan diunduh
        $fileName = 'storage_backup_' . date('Y_m_d_His') . '.zip';

        // Membuat objek ZipArchive
        $zip = new ZipArchive();
        $tmpFile = tempnam(sys_get_temp_dir(), 'zip'); // File sementara di memori

        if ($zip->open($tmpFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return response()->json(['error' => 'Tidak dapat membuat file zip.'], 500);
        }

        // Menambahkan semua file dari storage/app/public ke dalam zip
        $files = Storage::allFiles('public');
        foreach ($files as $file) {
            $absolutePath = storage_path('app/' . $file);
            if (file_exists($absolutePath)) {
                $zip->addFile($absolutePath, $file);
            }
        }

        // Tutup arsip zip
        $zip->close();

        // Membersihkan buffer output sebelum streaming
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Membaca file zip dan mengirimkan sebagai respons unduhan
        return response()->streamDownload(function () use ($tmpFile) {
            readfile($tmpFile);
        }, $fileName, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);

        // Hapus file sementara setelah dikirim
        // unlink($tmpFile);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Terjadi kesalahan saat membuat backup storage: ' . $e->getMessage()], 500);
    }
}

}
