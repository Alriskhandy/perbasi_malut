<?php

namespace App\Imports;

use App\Models\Coach;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class CoachesImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function __construct(private int $teamId) {}

    public function model(array $row): ?Coach
    {
        $name = trim($row['nama'] ?? $row['name'] ?? '');
        if (!$name) return null;

        return new Coach([
            'name'    => $name,
            'email'   => $row['email'] ?? null,
            'contact' => $row['kontak'] ?? $row['contact'] ?? null,
            'address' => $row['alamat'] ?? $row['address'] ?? null,
            'status'  => in_array(strtolower($row['status'] ?? ''), ['aktif', 'tidak aktif']) ? strtolower($row['status']) : 'aktif',
            'team_id' => $this->teamId,
        ]);
    }
}
