<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Coach;
use App\Models\Player;

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

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (District $district) {
            if (empty($district->slug)) {
                $base = Str::slug($district->name);
                $slug = $base;
                $i    = 1;
                while (static::where('slug', $slug)->where('id', '!=', $district->id ?? 0)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $district->slug = $slug;
            }
        });
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }

    public function players()
    {
        return $this->hasManyThrough(Player::class, Team::class);
    }

    public function coaches()
    {
        return $this->hasManyThrough(Coach::class, Team::class);
    }
}
