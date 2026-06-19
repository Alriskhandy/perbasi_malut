<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'education',
        'email',
        'contact',
        'joined_at',
        'position',
        'status',
        'img_path',
        'team_id',
    ];

    protected function casts(): array
    {
        return [
            'joined_at' => 'date',
        ];
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
