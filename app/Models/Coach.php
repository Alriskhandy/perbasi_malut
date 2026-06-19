<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'email',
        'contact',
        'address',
        'status',
        'img_path',
        'team_id',
        'education',
        'province',
        'city',
        'license',
        'license_number',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
