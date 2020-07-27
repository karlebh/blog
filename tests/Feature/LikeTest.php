<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Like;
use App\User;
use App\Post;

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
    public function a_post_or_comment_cannot_be_liked_twice()
    {
		$like = factory('App\Like')->create();
		$user = factory('App\User')->create();
      try{
		$this->actingAs($user)->post('/like', [
				'user_id' => $like->user_id,
				'like' => $user->like,
				'dislike' => $user->dislike,
				'likeable_id' => $user->likeable_id,
				'likeable_type' => $user->likeable_type,
		 ]);
		 
		$this->actingAs($user)->post('/like', [
				'user_id' => $like->user_id,
				'like' => $user->like,
				'dislike' => $user->dislike,
				'likeable_id' => $user->likeable_id,
				'likeable_type' => $user->likeable_type,
		 ]);

      }catch(\Exception $e){
         $this->fail('A user can not like a post or comment user!');
      }
          $this->assertCount(1, Like::all());
    }

      /** @test */
     public function an_auth_user_can_like_a_post()
     {
     	$this->actingAs(factory('App\User')->create())->post('/like', [
     		factory('App\Like')->create()
     	])->assertStatus(200);

     	$this->assertCount(1, Like::all());
     }

    //   /** @test */
    //  public function a_user_can_unlike_a_post()
    //  {
	// 	 $this->withoutExceptionHandling();

	// 	$user = factory(User::class)->create();
	// 	$post = factory('App\Post')->create();

	// 	$this->actingAs($user)->post('/like', [
    //  		$post
	// 	 ])->assertStatus(200);

	// 	$this->actingAs($user)->post(route('like.delete'))->assertStatus(200);
    //  }

}
