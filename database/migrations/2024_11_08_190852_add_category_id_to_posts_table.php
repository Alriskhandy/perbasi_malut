<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories')->nullable()->after('id');
            // Atau jika Anda ingin menambahkan dengan cara yang berbeda:
            // $table->unsignedBigInteger('category_id')->nullable()->after('id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Menghapus foreign key
            $table->dropColumn('category_id'); // Menghapus kolom category_id
        });
    }
}
