<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE players MODIFY COLUMN status ENUM('active', 'inactive', 'registered', 'not registered') DEFAULT 'registered'");
        DB::table('players')->where('status', 'active')->update(['status' => 'registered']);
        DB::table('players')->where('status', 'inactive')->update(['status' => 'not registered']);
        DB::statement("ALTER TABLE players MODIFY COLUMN status ENUM('registered', 'not registered') DEFAULT 'registered'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE players MODIFY COLUMN status ENUM('active', 'inactive', 'registered', 'not registered') DEFAULT 'active'");
        DB::table('players')->where('status', 'registered')->update(['status' => 'active']);
        DB::table('players')->where('status', 'not registered')->update(['status' => 'inactive']);
        DB::statement("ALTER TABLE players MODIFY COLUMN status ENUM('active', 'inactive') DEFAULT 'active'");
    }
};
