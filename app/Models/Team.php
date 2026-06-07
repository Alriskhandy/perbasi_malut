<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'status',
        'img_path',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function coaches()
    {
        return $this->hasMany(Coach::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function officials()
    {
        return $this->hasMany(Official::class);
    }
}
