<?php

namespace App\Imports;

use App\Models\Official;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class OfficialsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function __construct(private int $teamId) {}

    public function model(array $row): ?Official
    {
        $name = trim($row['nama'] ?? $row['name'] ?? '');
        if (!$name) return null;

        return new Official([
            'name'    => $name,
            'team_id' => $this->teamId,
        ]);
    }
}
