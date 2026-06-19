<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->string('pic_img_path')->nullable()->after('img_path');
            $table->string('sk_path')->nullable()->after('pic_img_path');
        });
    }

    public function down(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn(['pic_img_path', 'sk_path']);
        });
    }
};
