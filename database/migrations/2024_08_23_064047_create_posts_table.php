<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('excerpt');
            $table->string('image');
            $table->string('author');
            $table->integer('views');
            $table->longText('content');
            $table->boolean('comments_is_active')->default(true); // Menambahkan kolom is_active
            $table->boolean('is_banner')->default(false); // Menandai apakah post ini menjadi banner
            $table->boolean('is_featured')->default(false); // Menandai apakah post ini menjadi featured            
            $table->enum('status', ['draft', 'published', 'trashed'])->default('draft');
            $table->timestamps();
            $table->softDeletes(); // Adds the deleted_at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
