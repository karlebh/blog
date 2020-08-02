<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;
use App\Post;
use App\User;
use App\Comment;
use Auth;
use App\Like;

class PostTest extends TestCase
{


    use RefreshDatabase;


       /** @test */
   public function a_post_can_have_a_comment()
    {
        
       $post = factory(Post::class)->create();
       $comment = factory(comment::class)->create([
             'commentable_id' => $post->id,
             'commentable_type' => Post::class,
           ]);

       // $this->assertInstanceOf(Comment::class, $post->comments);
       $this->assertEquals(1, $post->comments->count());
    }

    /** @test */
   public function a_post_has_a_user()
   {

      $user = factory('App\User')->create(); 
      $post = factory('App\Post')->create(['user_id' => $user->id]);
      
      $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->posts);
      $this->assertEquals(1, $user->posts()->count());
      $this->assertCount(1, Post::all());
      $this->assertInstanceOf('App\User', $post->user);
   }


    /** @test */
    public function a_post_can_be_created(){
      $user = factory('App\User')->create();

      $resp = $this->actingAs($user)->post('/posts', [
                'user_id' => $user->id,
                 'title' => 'title',
                 'desc' => 'A brand new title',
                 'image' => 'jjjj',
      ])->assertStatus(302);

    

      $this->assertCount(1, Post::all());
    } 



    /** @test */
    public function only_auth_user_can_create_post(){
      $user = factory('App\User')->create();

      $resp = $this->post('/posts', [
                'user_id' => $user->id,
                 'title' => 'title',
                 'desc' => 'A brand new title',
                 'image' => 'jjjj',
      ])->assertRedirect('/login');

      $this->assertCount(0, Post::all());
    } 


    /** @test */
    public function a_post_can_be_liked_by_a_user()
    {

      $like = factory('App\Like')->create();

      $this->assertCount(1, Like::all());
      $this->assertInstanceOf(Post::class, $like->likeable);
    }


    /** @test */
    public function only_auth_user_can_like_post(){
      $user = factory('App\User')->create();

      $resp = $this->post('/posts', [
                'user_id' => $user->id,
                'like' => 1,
                'dislike' => 0,
                'likeable_id' => $user->post_id,
                'likeable_type' => \App\Post::class,
              ])->assertRedirect('/login');

      $this->assertCount(0, Like::all());
    } 

}
