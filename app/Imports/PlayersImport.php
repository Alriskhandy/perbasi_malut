<?php

namespace App\Imports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class PlayersImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function __construct(private int $teamId) {}

    public function model(array $row): ?Player
    {
        $name = trim($row['nama'] ?? $row['name'] ?? '');
        if (!$name) return null;

        return new Player([
            'name'     => $name,
            'gender'   => $row['jenis_kelamin'] ?? $row['gender'] ?? null,
            'height'   => is_numeric($row['tinggi_badan'] ?? $row['height'] ?? null) ? $row['tinggi_badan'] ?? $row['height'] : null,
            'weight'   => is_numeric($row['berat_badan'] ?? $row['weight'] ?? null) ? $row['berat_badan'] ?? $row['weight'] : null,
            'position' => $row['posisi'] ?? $row['position'] ?? null,
            'status'   => in_array(strtolower($row['status'] ?? ''), ['aktif', 'tidak aktif']) ? strtolower($row['status']) : 'aktif',
            'team_id'  => $this->teamId,
        ]);
    }
}
