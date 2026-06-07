<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menyisipkan data ke tabel galleries
        DB::table('galleries')->insert([
            [
                'image' => 'image',
                'slug' => 'Gallery One',
                'name' => 'Gallery One',
                'description' => 'This is a description for Gallery One.',
                'is_featured' => true,
                'order' => 1,
                'user_id' => 1, // Pastikan user_id yang sesuai ada di tabel users
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'image',
                'slug' => 'Gallery Two',
                'name' => 'Gallery Two',
                'description' => 'This is a description for Gallery Two.',
                'is_featured' => false,
                'order' => 2,
                'user_id' => 1,
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => 'image',
                'slug' => 'Gallery Three',
                'name' => 'Gallery Three',
                'description' => 'This is a description for Gallery Three.',
                'is_featured' => true,
                'order' => 3,
                'user_id' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
