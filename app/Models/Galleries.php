<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galleries extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke GalleryMeta
    public function metas()
    {
        return $this->hasMany(GalleriesMeta::class, 'gallery_id');
    }
}
