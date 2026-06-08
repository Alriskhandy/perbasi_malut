<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'contact',
        'address',
        'status',
        'img_path',
        'district_id',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Team $team) {
            if (empty($team->slug)) {
                $base = Str::slug($team->name);
                $slug = $base;
                $i    = 1;
                while (static::where('slug', $slug)->where('id', '!=', $team->id ?? 0)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $team->slug = $slug;
            }
        });
    }

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
