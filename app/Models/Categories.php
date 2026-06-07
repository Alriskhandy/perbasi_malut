<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $guarded = ['id'];

    // A category can have a parent category
    // public function posts()
    // {
    //     return $this->belongsToMany(Posts::class, 'posts_categories', 'category_id', 'post_id');
    // }
    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'posts_categories', 'category_id', 'post_id');
    }
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
