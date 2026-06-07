<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $table = 'menu_items';
    protected $fillable = ['menu_id', 'page_id', 'label', 'url', 'parent_id', 'order','post_id', 'category_id', ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function post()
    {
        return $this->belongsTo(Posts::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }
}
