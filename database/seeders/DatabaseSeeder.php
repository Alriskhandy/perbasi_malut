<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Theme;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CategoriesSeeder::class,
            PostSeeder::class, // Pastikan PostSeeder juga ditambahkan di sini
            MenuSeeder::class,
            GeneralSettingsSeeder::class,
        ]);

        // Seed User
        User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Hash the password
        ]);

        // Seed Tema
        // Theme::create([
        //     'name' => 'Retmu',
        //     'path' => 'themes/zenblog',
        //     'image' => 'themes/zenblog.png',
        //     'active' => 1,
        // ]);
        // Theme::create([
        //     'name' => 'medicio',
        //     'path' => 'themes/medicio',
        //     'image' => 'themes/medicio.png',
        //     'active' => 0,
        // ]);
        // Theme::create([
        //     'name' => 'blogy',
        //     'path' => 'themes/blogy',
        //     'image' => 'themes/blogy.png',
        //     'active' => 0,
        // ]);
        // Theme::create([
        //     'name' => 'biz-news',
        //     'path' => 'themes/biz-news',
        //     'image' => 'themes/biz-news.png',
        //     'active' => 0,
        // ]);
        // Theme::create([
        //     'name' => 'arsha',
        //     'path' => 'themes/arsha',
        //     'image' => 'themes/arsha.png',
        //     'active' => 0,
        // ]);
        Theme::create([
            'name' => 'perbasi',
            'path' => 'themes/perbasi',
            'image' => 'themes/perbasi.png',
            'active' => 1,
        ]);

        $this->call([
            GalleriesSeeder::class,
        ]);
    }
}
