<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'status',
        'img_path',
        'district_id',
        'license',
        'license_number',
        'email',
        'contact',
        'address',
        'education',
        'province',
        'city',
        'team_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
