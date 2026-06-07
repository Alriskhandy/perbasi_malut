<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id')->nullable(); 
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('set null');
            $table->unsignedBigInteger('post_id')->nullable(); 
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
            $table->unsignedBigInteger('category_id')->nullable(); 
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
        });
    }
};
