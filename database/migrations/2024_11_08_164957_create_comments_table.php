<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); // Foreign key to posts table
            $table->text('content'); // The actual comment content
            $table->string('name')->nullable(); // Optional field for guest's name
            $table->string('email')->nullable(); // Optional field for guest's email
            $table->boolean('read')->default(false); // Menandai apakah post ini menjadi banner
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->timestamps();

            // Foreign key constraint to posts table
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
