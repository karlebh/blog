<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('desc')->unique()->nullable();
            $table->string('color', 40)->default('#ddd')->nullable();
            $table->bigInteger('posts_count');
            $table->bigInteger('views_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
