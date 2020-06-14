<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Like;
use App\User;

class likeTest extends TestCase
{
	use RefreshDatabase;

   /** @test */
   public function only_auth_user_can_like()
   {
   		$resp = $this->post('/like', [
   				'user_id' => 1,
   				'like' => 1,
   				'dislike' => 0,
   				'likeable_id' => 1,
   				'likeable_type' => 'App\Post'
   		])->assertRedirect('/login');

   		$this->assertCount(0, Like::all());
   }

      /** @test */
     public function an_auth_user_can_like_a_post()
     {
     	$this->actingAs(factory('App\User')->create())->post('/like', [
     		factory('App\Like')->create()
     	])->assertStatus(200);

     	$this->assertCount(1, Like::all());
     }
     

}
