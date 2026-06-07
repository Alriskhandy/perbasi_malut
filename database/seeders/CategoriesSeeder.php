<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories::factory()->count(10)->create();
        Categories::create(
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman'
            ]
        );
        Categories::create(
            [
                'name' => 'Agenda',
                'slug' => 'agenda'
            ]
        );
        Categories::create([
            'slug' => 'berita',
            'name' => 'Berita',
        ]);
        Categories::create([
            'slug' => 'news',
            'name' => 'News',
        ]);
    }
}
