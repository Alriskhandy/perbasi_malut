<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Official;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class TeamImportController extends Controller
{
    public function downloadTemplate()
    {
        $path = public_path('templates/import/template_import_data_klub.zip');

        abort_unless(file_exists($path), 404, 'File template tidak ditemukan.');

        return response()->download($path, 'template_import_data_klub.zip', [
            'Content-Type' => 'application/zip',
        ]);
    }

    public function importForm(int $id)
    {
        $team = Team::findOrFail($id);
        return view('backend.teams.import', compact('team'));
    }

    public function import(Request $request, int $id)
    {
        $team = Team::findOrFail($id);
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:51200'],
        ]);

        try {
            $path        = $request->file('file')->getRealPath();
            $spreadsheet = IOFactory::load($path);
            $counts      = ['atlet' => 0, 'pelatih' => 0, 'official' => 0];

            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                $title = mb_strtolower(trim($worksheet->getTitle()));
                $rows  = $worksheet->toArray(null, true, true, false);

                if (count($rows) < 2) continue;

                $headers = array_map(fn($h) => mb_strtolower(trim((string) $h)), $rows[0]);
                $data    = array_slice($rows, 1);

                if (str_contains($title, 'atlet') || str_contains($title, 'player')) {
                    $counts['atlet'] = $this->importPlayers($team->id, $headers, $data);
                } elseif (str_contains($title, 'pelatih') || str_contains($title, 'coach')) {
                    $counts['pelatih'] = $this->importCoaches($team->id, $headers, $data);
                } elseif (str_contains($title, 'official')) {
                    $counts['official'] = $this->importOfficials($team->id, $headers, $data);
                }
            }

            $msg = "Import berhasil — Atlet: {$counts['atlet']}, Pelatih: {$counts['pelatih']}, Official: {$counts['official']}";
            notify()->success($msg);
        } catch (\Throwable $e) {
            notify()->error('Gagal import: ' . $e->getMessage());
        }

        return redirect()->route('teams.index');
    }

    private function importPlayers(int $teamId, array $headers, array $rows): int
    {
        $norm    = $this->normalizedHeaders($headers);
        $val     = fn(array $row, string ...$keys) => $this->cellValue($norm, $row, $keys);

        $count = 0;
        foreach ($rows as $row) {
            $name = trim((string) ($val($row, 'nama', 'name', 'namalengkap', 'namaatlet') ?? ''));
            if (!$name || is_numeric($name)) continue;

            $rawGender = trim((string) ($val($row, 'jeniskelamin', 'gender', 'jk', 'lp') ?? ''));
            $gender    = strtoupper(substr($rawGender, 0, 1));
            if (!in_array($gender, ['L', 'P'])) continue;

            $height = $val($row, 'tinggibadan', 'tinggi', 'height', 'tb');
            $weight = $val($row, 'beratbadan', 'berat', 'weight', 'bb');

            Player::create([
                'name'     => $name,
                'gender'   => $gender,
                'height'   => is_numeric($height) ? (int) $height : null,
                'weight'   => is_numeric($weight) ? (int) $weight : null,
                'position' => trim((string) ($val($row, 'posisi', 'position', 'pos') ?? '')) ?: null,
                'status'   => 'active',
                'team_id'  => $teamId,
            ]);
            $count++;
        }
        return $count;
    }

    private function importCoaches(int $teamId, array $headers, array $rows): int
    {
        $norm = $this->normalizedHeaders($headers);
        $val  = fn(array $row, string ...$keys) => $this->cellValue($norm, $row, $keys);

        $count = 0;
        foreach ($rows as $row) {
            $name = trim((string) ($val($row, 'nama', 'name', 'namapelatih', 'namalengkap') ?? ''));
            if (!$name || is_numeric($name)) continue;

            Coach::create([
                'name'    => $name,
                'email'   => trim((string) ($val($row, 'email', 'emailaddress', 'surel') ?? '')) ?: null,
                'contact' => trim((string) ($val($row, 'kontak', 'contact', 'telepon', 'hp', 'nohp', 'notelp', 'phone', 'notelepon') ?? '')) ?: null,
                'address' => trim((string) ($val($row, 'alamat', 'address', 'domisili', 'tempattinggal') ?? '')) ?: null,
                'status'  => 'active',
                'team_id' => $teamId,
            ]);
            $count++;
        }
        return $count;
    }

    private function importOfficials(int $teamId, array $headers, array $rows): int
    {
        $norm = $this->normalizedHeaders($headers);
        $val  = fn(array $row, string ...$keys) => $this->cellValue($norm, $row, $keys);

        $count = 0;
        foreach ($rows as $row) {
            $name = trim((string) ($val($row, 'nama', 'name', 'namaofficial', 'namalengkap') ?? ''));
            if (!$name || is_numeric($name)) continue;

            Official::create([
                'name'    => $name,
                'team_id' => $teamId,
            ]);
            $count++;
        }
        return $count;
    }

    /**
     * Normalize all headers: lowercase, strip spaces/underscores/dots/slashes/parentheses.
     * Returns array keyed by original index with normalized value.
     */
    private function normalizedHeaders(array $headers): array
    {
        return array_map(fn($h) => $this->normalizeKey((string) $h), $headers);
    }

    private function normalizeKey(string $key): string
    {
        return mb_strtolower(preg_replace('/[\s_\-\.\/\(\)#*]+/', '', $key));
    }

    /**
     * Return cell value by normalized key match.
     * 1. Exact match first, then contains match (handles extra units like "(CM)", "(KG)", "/ NO HP").
     * Returns null when header not found.
     */
    private function cellValue(array $normalizedHeaders, array $row, array $keys): mixed
    {
        foreach ($keys as $key) {
            $needle = $this->normalizeKey($key);

            // Exact match
            $idx = array_search($needle, $normalizedHeaders, true);
            if ($idx !== false) return $row[$idx] ?? null;

            // Contains match — header contains the key (e.g. "jeniskelaminlp" contains "jeniskelamin")
            foreach ($normalizedHeaders as $i => $h) {
                if ($h !== '' && str_contains($h, $needle)) return $row[$i] ?? null;
            }
        }
        return null;
    }

}
