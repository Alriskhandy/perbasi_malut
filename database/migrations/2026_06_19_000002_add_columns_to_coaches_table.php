<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            $table->string('id_number')->nullable()->after('id');
            $table->string('education')->nullable()->after('address');
            $table->string('province')->nullable()->after('education');
            $table->string('city')->nullable()->after('province');
            $table->string('license')->nullable()->after('city');
            $table->string('license_number')->nullable()->after('license');
        });

        DB::statement("ALTER TABLE coaches MODIFY COLUMN status ENUM('active', 'inactive', 'registered', 'not registered') DEFAULT 'registered'");
        DB::table('coaches')->where('status', 'active')->update(['status' => 'registered']);
        DB::table('coaches')->where('status', 'inactive')->update(['status' => 'not registered']);
        DB::statement("ALTER TABLE coaches MODIFY COLUMN status ENUM('registered', 'not registered') DEFAULT 'registered'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE coaches MODIFY COLUMN status ENUM('active', 'inactive', 'registered', 'not registered') DEFAULT 'active'");
        DB::table('coaches')->where('status', 'registered')->update(['status' => 'active']);
        DB::table('coaches')->where('status', 'not registered')->update(['status' => 'inactive']);
        DB::statement("ALTER TABLE coaches MODIFY COLUMN status ENUM('active', 'inactive') DEFAULT 'active'");

        Schema::table('coaches', function (Blueprint $table) {
            $table->dropColumn([
                'id_number',
                'education',
                'province',
                'city',
                'license',
                'license_number',
            ]);
        });
    }
};
