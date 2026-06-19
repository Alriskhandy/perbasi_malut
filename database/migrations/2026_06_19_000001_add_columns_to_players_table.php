<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('id_number')->nullable()->after('id');
            $table->string('birth_place')->nullable()->after('gender');
            $table->date('birth_date')->nullable()->after('birth_place');
            $table->string('education')->nullable()->after('position');
            $table->date('joined_at')->nullable()->after('education');
            $table->string('contact')->nullable()->after('joined_at');
            $table->string('email')->nullable()->after('contact');
            $table->string('province')->nullable()->after('email');
            $table->string('city')->nullable()->after('province');
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn([
                'id_number',
                'birth_place',
                'birth_date',
                'education',
                'joined_at',
                'contact',
                'email',
                'province',
                'city',
            ]);
        });
    }
};
