<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingsSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data pengaturan ke dalam tabel 'general_settings'
        DB::table('general_settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'Universitas Khairun',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_logo',
                'value' => '/images/logo.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'footer_text',
                'value' => '© 2024 Universitas Khairun. All rights reserved.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'loader_image',
                'value' => '/images/loader.gif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'app_url',
                'value' => env('APP_URL', 'http://localhost'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // mail
            [
                'key' => 'site_email',
                'value' => env('MAIL_FROM_ADDRESS', 'info@unkhair.ac.id'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_mailer',
                'value' => env('MAIL_MAILER', 'log'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_host',
                'value' => env('MAIL_HOST', '127.0.0.1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_port',
                'value' => env('MAIL_PORT', '2525'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_username',
                'value' => env('MAIL_USERNAME', null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_password',
                'value' => env('MAIL_PASSWORD', null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_encryption',
                'value' => env('MAIL_ENCRYPTION', null),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_from_address',
                'value' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_from_name',
                'value' => env('MAIL_FROM_NAME', env('APP_NAME', 'Laravel')),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // datdabase
            // Pengaturan Database
            [
                'key' => 'database_connection',
                'value' => env('DB_CONNECTION', 'mysql'), // defaultnya mysql
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'database_host',
                'value' => env('DB_HOST', '127.0.0.1'), // default localhost
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'database_port',
                'value' => env('DB_PORT', '3306'), // default port untuk MySQL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'database_name',
                'value' => env('DB_DATABASE', 'your_database_name'), // sesuaikan dengan nama database Anda
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'seo_title',
                'value' => 'Judul Situs Default',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'seo_description',
                'value' => 'Deskripsi default untuk SEO website Anda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'keyword1, keyword2, keyword3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
