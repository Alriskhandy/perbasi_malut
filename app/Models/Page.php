<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'status'];

    // Bersihkan HTML dari editor agar tidak bisa disisipi script (stored XSS)
    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value === null ? null : clean($value, 'content'),
        );
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
