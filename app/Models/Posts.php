<?php

namespace App\Models;

use App\Enums\PostStatus;
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
