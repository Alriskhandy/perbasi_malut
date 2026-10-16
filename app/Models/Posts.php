<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes,HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'status' => PostStatus::class,
    ];

    // Bersihkan HTML dari editor agar tidak bisa disisipi script (stored XSS)
    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value === null ? null : clean($value, 'content'),
        );
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Categories::class, 'posts_categories', 'post_id', 'category_id');
    // }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'posts_categories', 'post_id', 'category_id');

    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class,'post_id');
    }

}
