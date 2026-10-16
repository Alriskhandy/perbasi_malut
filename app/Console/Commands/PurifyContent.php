<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Posts;
use Illuminate\Console\Command;

class PurifyContent extends Command
{
    protected $signature = 'content:purify {--dry-run : Hanya tampilkan data yang akan berubah}';
    protected $description = 'Bersihkan HTML konten berita & halaman yang sudah tersimpan (HTMLPurifier)';

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $changed = 0;

        $models = [
            'berita' => Posts::withTrashed(),
            'halaman' => Page::query(),
        ];

        foreach ($models as $label => $query) {
            $query->select(['id', 'content'])->chunkById(100, function ($items) use ($label, $dryRun, &$changed) {
                foreach ($items as $item) {
                    $original = $item->getRawOriginal('content');
                    if ($original === null) {
                        continue;
                    }

                    $item->content = $original; // mutator menjalankan clean()
                    if ($item->content === $original) {
                        continue;
                    }

                    $changed++;
                    $this->line("• {$label} #{$item->id} berubah");

                    if (! $dryRun) {
                        $item->saveQuietly();
                    }
                }
            });
        }

        $this->info($dryRun
            ? "Dry run: {$changed} data akan dibersihkan."
            : "Selesai: {$changed} data dibersihkan.");
    }
}
