<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('referees', function (Blueprint $table) {
            $table->string('id_number')->nullable()->after('id');
            $table->enum('status', ['registered', 'not registered'])->default('registered')->after('name');
            $table->string('license')->nullable()->after('status');
            $table->string('license_number')->nullable()->after('license');
            $table->string('email')->nullable()->after('license_number');
            $table->string('contact')->nullable()->after('email');
            $table->text('address')->nullable()->after('contact');
            $table->string('education')->nullable()->after('address');
            $table->string('province')->nullable()->after('education');
            $table->string('city')->nullable()->after('province');
            $table->foreignId('team_id')->nullable()->after('city')->constrained('teams')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('referees', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn([
                'id_number',
                'status',
                'license',
                'license_number',
                'email',
                'contact',
                'address',
                'education',
                'province',
                'city',
                'team_id',
            ]);
        });
    }
};
