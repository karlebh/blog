<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfileUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user', function(Blueprint $table){

        $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreignId('profile_id')->references('id')->on('profiles')->onDelete('cascade');

        $table->primary(['user_id', 'profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_user');
    }
}
