<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create pages for Profil submenu
        $strukturPimpinanPage = Page::create(['title' => 'Struktur Pimpinan', 'slug' => 'struktur-pimpinan', 'status' => 'aktif']);
        $visiMisiPage = Page::create(['title' => 'Visi & Misi', 'slug' => 'visi-misi', 'status' => 'aktif']);
        $tujuanPage = Page::create(['title' => 'Tujuan', 'slug' => 'tujuan', 'status' => 'aktif']);

        // Create Profil menu
        $profilMenu = Menu::create(['name' => 'Profil', 'position' => 'top', 'status' => 'aktif']);

        // Add Profil menu item
        $profilItem = MenuItem::create(['menu_id' => $profilMenu->id, 'label' => 'Profil', 'order' => 3]);

        // Add submenu items under Profil menu
        MenuItem::create(['menu_id' => $profilMenu->id, 'page_id' => $strukturPimpinanPage->id, 'label' => 'Struktur Pimpinan', 'parent_id' => $profilItem->id, 'order' => 1]);
        MenuItem::create(['menu_id' => $profilMenu->id, 'page_id' => $visiMisiPage->id, 'label' => 'Visi & Misi', 'parent_id' => $profilItem->id, 'order' => 2]);
        MenuItem::create(['menu_id' => $profilMenu->id, 'page_id' => $tujuanPage->id, 'label' => 'Tujuan', 'parent_id' => $profilItem->id, 'order' => 3]);

        // Buat beberapa halaman
        $aboutPage = Page::create(['title' => 'About', 'slug' => 'about', 'status' => 'aktif']);
        $categoryPage = Page::create(['title' => 'Category', 'slug' => 'category', 'status' => 'aktif']);
        $contactPage = Page::create(['title' => 'Contact', 'slug' => 'contact', 'status' => 'aktif']);
        
        // Buat menu utama
        $mainMenu = Menu::create(['name' => 'Main Menu', 'position' => 'top', 'status' => 'aktif']);

        // Tambahkan item menu
        $aboutItem = MenuItem::create(['menu_id' => $mainMenu->id, 'page_id' => $aboutPage->id, 'label' => 'About', 'order' => 1]);
        $categoryItem = MenuItem::create(['menu_id' => $mainMenu->id, 'page_id' => $categoryPage->id, 'label' => 'Category', 'order' => 2]);

        // Tambahkan item menu dengan submenu
        $pagesItem = MenuItem::create(['menu_id' => $mainMenu->id, 'label' => 'Pages', 'order' => 4]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'label' => 'Blog', 'parent_id' => $pagesItem->id, 'url' => 'blog', 'order' => 1]);
        
        $subPages = MenuItem::create(['menu_id' => $mainMenu->id, 'label' => 'More Pages', 'parent_id' => $pagesItem->id, 'order' => 2]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'page_id' => $contactPage->id, 'label' => 'Contact Us', 'parent_id' => $subPages->id, 'order' => 1]);
    }
}
