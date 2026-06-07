<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AutoUpdateApp extends Command
{
    protected $signature = 'app:update';
    protected $description = 'Cek dan update aplikasi dari server pusat';

    public function handle()
    {
        $this->info("🔍 Mengecek update dari server...");

        $response = Http::get('https://cms-unkhair.wahyuumaternate.my.id/api/check-update'); // Ganti dengan URL server kamu

        if (!$response->ok()) {
            $this->error('❌ Gagal menghubungi server update.');
            return;
        }

        $data = $response->json();
        $currentVersion = config('app.version');
        $remoteVersion = $data['version'];

        if (version_compare($remoteVersion, $currentVersion, '<=')) {
            $this->info("✅ Aplikasi sudah versi terbaru ($currentVersion)");
            return;
        }

        $this->info("📦 Update tersedia: v{$remoteVersion}");
        $this->info("📄 Catatan rilis: " . $data['changelog']);

        // 1. Download file ZIP
        $this->info("⬇️ Mengunduh file update...");
        $fileContents = file_get_contents($data['file_url']);
        $zipPath = storage_path("app/update.zip");
        file_put_contents($zipPath, $fileContents);

        // 2. Ekstrak file
        $this->info("📂 Mengekstrak dan meng-overwrite file...");
        $zip = new ZipArchive;
        if ($zip->open($zipPath) === TRUE) {
            $zip->extractTo(base_path());
            $zip->close();
            $this->info("✅ File berhasil diekstrak.");
        } else {
            $this->error("❌ Gagal mengekstrak file ZIP.");
            return;
        }

        // 3. Jalankan migrasi jika diperlukan
        if (isset($data['migrate']) && $data['migrate']) {
            $this->info("🛠️ Menjalankan migrasi database...");
            Artisan::call('migrate', ['--force' => true]);
            $this->info(Artisan::output());
        }

        // 4. Update versi aplikasi di config atau simpan di database
        $this->info("📌 Menyimpan versi aplikasi terbaru...");

        // Contoh jika kamu simpan versi di .env (opsional)
        $envPath = base_path('.env');
        if (file_exists($envPath)) {
            $env = file_get_contents($envPath);
            $env = preg_replace('/APP_VERSION=(.*)/', "APP_VERSION={$remoteVersion}", $env);
            file_put_contents($envPath, $env);
        }

        // Clear cache & rebuild setelah update
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');

        Artisan::call('config:cache');
        Artisan::call('route:cache');
        $this->info("🎉 Update selesai! Sekarang versi {$remoteVersion}");
    }
}

// update melalui github
// <?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use Illuminate\Support\Facades\Http;
// use ZipArchive;
// use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\File;
// use GuzzleHttp\Client;
// class AutoUpdateApp extends Command
// {
//     protected $signature = 'app:update';
//     protected $description = 'Cek dan update aplikasi dari GitHub';

//     public function handle()
//     {
//         $this->info("🔍 Mengecek update dari GitHub...");

//         // Token GitHub (ganti dengan token yang sudah kamu buat)
//         $token = env('GITHUB_TOKEN');

//         // URL API untuk mendapatkan rilis terbaru
//         $url = 'https://api.github.com/repos/wahyuumaternate/CMS_UNKHAIR_11/releases/latest';

//         // Permintaan API dengan otentikasi
//         $response = Http::withHeaders([
//             'Authorization' => 'token ' . $token
//         ])->get($url);

//         if ($response->successful()) {
//             $data = $response->json();
//             $latestVersion = $data['tag_name'];
//             $changelog = $data['body'];

//             $currentVersion = config('app.version');

//             // Mengecek apakah versi terbaru lebih tinggi
//             if (version_compare($latestVersion, $currentVersion, '<=')) {
//                 $this->info("✅ Aplikasi sudah versi terbaru: v{$currentVersion}");
//                 return;
//             }

//             $this->info("📦 Update tersedia: v{$latestVersion}");
//             $this->info("📄 Catatan rilis: " . $changelog);

//             // Guzzle untuk mengunduh file ZIP update
//             $client = new Client();
//             $zipUrl = $data['zipball_url'];

//             $this->info("⬇️ Mengunduh file update...");
//             $response = $client->get($zipUrl, [
//                 'headers' => [
//                     'Authorization' => 'token ' . $token
//                 ]
//             ]);

//             if ($response->getStatusCode() == 200) {
//                 $zipPath = storage_path("app/update.zip");
//                 file_put_contents($zipPath, $response->getBody()->getContents());

//                 // 2. Ekstrak file ZIP dan mengganti file
//                 $this->info("📂 Mengekstrak dan meng-overwrite file...");
//                 $zip = new ZipArchive;
//                 if ($zip->open($zipPath) === TRUE) {
//                     // Mengekstrak ke direktori root aplikasi, pastikan menimpa file yang ada
//                     $zip->extractTo(base_path()); // Mengekstrak ke root aplikasi Laravel
//                     $zip->close();
//                     $this->info("✅ File berhasil diekstrak.");
//                 } else {
//                     $this->error("❌ Gagal mengekstrak file ZIP.");
//                     return;
//                 }

//                 // 3. Jalankan migrasi jika diperlukan
//                 if (isset($data['migrate']) && $data['migrate']) {
//                     $this->info("🛠️ Menjalankan migrasi database...");
//                     Artisan::call('migrate', ['--force' => true]);
//                     $this->info(Artisan::output());
//                 }

//                 // 4. Update versi aplikasi di config atau .env
//                 $this->info("📌 Menyimpan versi aplikasi terbaru...");

//                 // Update versi di .env
//                 $envPath = base_path('.env');
//                 if (file_exists($envPath)) {
//                     $env = file_get_contents($envPath);
//                     $env = preg_replace('/APP_VERSION=(.*)/', "APP_VERSION={$latestVersion}", $env);
//                     file_put_contents($envPath, $env);
//                 }

//                 // Clear cache dan optimasi setelah update
//                 Artisan::call('optimize:clear');
//                 Artisan::call('view:clear');
//                 Artisan::call('config:clear');
//                 Artisan::call('route:clear');
//                 Artisan::call('config:cache');
//                 Artisan::call('route:cache');

//                 $this->info("🎉 Update selesai! Sekarang versi {$latestVersion}");
//             } else {
//                 $this->error("❌ Gagal mengunduh file update. Status code: " . $response->getStatusCode());
//             }
//         } else {
//             $this->error("❌ Gagal menghubungi API GitHub.");
//         }
//     }
// }
