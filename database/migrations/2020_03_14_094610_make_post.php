<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                            ->references('id')
                            ->on('users')
                            ->onDelete('cascade');
            $table->bigInteger('category_id')
                            ->references('id')
                            ->on('categories')
                            ->onDelete('cascade');
            $table->string('title');
            $table->text('desc');
            $table->string('slug');
            $table->string('img')->nullable();
            $table->bigInteger('comments_count');
            $table->bigInteger('views_count');
            $table->integer('best_reply')
                            ->references('id')
                            ->on('comments')
                            ->onDelete('cascade');
            $table->boolean('locked');
            $table->integer('pinned');

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
        Schema::dropIfExists('posts');
    }
}
