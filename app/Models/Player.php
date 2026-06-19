<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'gender',
        'height',
        'weight',
        'status',
        'position',
        'img_path',
        'team_id',
        'birth_place',
        'birth_date',
        'education',
        'joined_at',
        'contact',
        'email',
        'province',
        'city',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'joined_at'  => 'date',
        ];
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
