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
                'slug' => 'Galeri 1',
                'name' => 'Galeri 1',
                'description' => 'This is a description for Galeri 1.',
                'is_featured' => true,
                'order' => 1,
                'user_id' => 1, // Pastikan user_id yang sesuai ada di tabel users
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
