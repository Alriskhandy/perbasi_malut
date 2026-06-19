<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->string('education')->nullable()->after('name');
            $table->string('email')->nullable()->after('education');
            $table->string('contact')->nullable()->after('email');
            $table->date('joined_at')->nullable()->after('contact');
            $table->string('position')->nullable()->after('joined_at');
            $table->enum('status', ['registered', 'not registered'])->default('registered')->after('position');
        });
    }

    public function down(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->dropColumn(['education', 'email', 'contact', 'joined_at', 'position', 'status']);
        });
    }
};
