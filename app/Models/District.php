<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'district_name',
        'pic',
        'pic_position',
        'email',
        'contact',
        'address',
        'web_url',
        'img_path',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }
}
