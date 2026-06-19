<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('pic')->nullable()->after('img_path');
            $table->string('pic_img_path')->nullable()->after('pic');
            $table->date('founded_at')->nullable()->after('pic_img_path');
            $table->string('bank_account')->nullable()->after('founded_at');
            $table->string('sk_path')->nullable()->after('bank_account');
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn([
                'pic',
                'pic_img_path',
                'founded_at',
                'bank_account',
                'sk_path',
            ]);
        });
    }
};
