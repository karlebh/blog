<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
        	'user_id' => rand(1, 20),
        	'title' => Str::random(10),
        	'desc' => Str::random(100),
        	'img' => Str::random(7),
        ]);
    }
}
