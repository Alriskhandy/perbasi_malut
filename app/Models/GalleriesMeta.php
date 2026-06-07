<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleriesMeta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'galleries_meta';

    // Relasi ke Gallery
    public function gallery()
    {
        return $this->belongsTo(Galleries::class);
    }
}
