<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */
    'use_package_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Shared folder / Private folder
    |--------------------------------------------------------------------------
    |
    | Jika keduanya diset false, maka folder shared akan diaktifkan.
    |
    */
    'allow_private_folder' => true,
    'private_folder_name' => 'My Files', // Nama folder private, akan dipisahkan berdasarkan pengguna
    'allow_shared_folder' => true,
    'shared_folder_name' => 'shared', // Folder bersama yang bisa diakses semua orang

    /*
    |--------------------------------------------------------------------------
    | Folder Konfigurasi
    |--------------------------------------------------------------------------
    |
    | Folder untuk kategori file dan gambar.
    |
    */
    'folder_categories' => [
        'file' => [
            'folder_name'  => 'files', 
            'startup_view' => 'grid',
            'max_size'     => 5000, // ukuran file dalam KB
            'valid_mime'   => [
                'video/mp4', 'image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'text/plain'
            ],
        ],
        'image' => [
            'folder_name'  => 'images', 
            'startup_view' => 'grid',
            'max_size'     => 5000, // ukuran file dalam KB
            'valid_mime'   => [
                'image/jpeg', 'image/png', 'image/gif'
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Disk
    |--------------------------------------------------------------------------
    |
    | Tentukan disk untuk penyimpanan file
    |
    */
    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Item Columns
    |--------------------------------------------------------------------------
    */
    'item_columns' => ['name', 'url', 'time', 'icon', 'is_file', 'is_image', 'thumb_url'],
    
    /*
    |--------------------------------------------------------------------------
    | File Extension Information
    |--------------------------------------------------------------------------
    */
    'file_type_array' => [
        'pdf'  => 'Adobe Acrobat',
        'doc'  => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls'  => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip'  => 'Archive',
        'gif'  => 'GIF Image',
        'jpg'  => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png'  => 'PNG Image',
        'ppt'  => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | php.ini overrides
    |--------------------------------------------------------------------------
    |
    | Pengaturan override untuk php.ini sebelum mengunggah file.
    |
    */
    'php_ini_overrides' => [
        'memory_limit' => '256M',
    ],
];
