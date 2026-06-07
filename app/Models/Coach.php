<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'status',
        'img_path',
        'team_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
