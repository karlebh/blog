<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Post;
use App\Like;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class CommentTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function only_auth_user_can_create_comment()
    {
   
      $user = factory('App\User')->create();
      $post = factory('App\Post')->create();

      $resp = $this->post('/comments', [
                 'user_id' => 1,
                 'commentable_id' => 2,
                 'commentable_type' => Post::class,
                 'body' => 'A brand new comment',
      ])->assertRedirect('/login');

      $this->assertCount(0, Comment::all());
    }

     /** @test */
    public function only_auth_user_can_edit_comment()
    {
 
        $post = factory('App\Post')->create();
        $comment = factory('App\Comment')->create();
        $this->get('/comments/'. $comment->id . '/edit')->assertRedirect('/login');

        $this->assertCount(1, Comment::all());
    }


    /** @test */
    public function a_user_can_only_edit_his_or_her_own_comment()
    {

      $user = factory('App\User')->create();
      $post = factory('App\Post')->create();

      $this->actingAs($user)->post('/comments' , [
        $comment = factory('App\Comment')->create([
            'user_id' => $user->id,
        ])
      ]);

      $user2 = factory('App\User')->create();

      $this->actingAs($user2)
                ->get('/comments/' . $comment->id . '/edit')->assertStatus(403);
      $this->actingAs($user2)
                ->patch('/comments/' . $comment->id, [
             $comment = factory('App\Comment')->create([
                'user_id' => $user->id,
                    ])
                ])->assertStatus(403);
    }


    /** @test */
    public function a_comment_can_be_liked()
    {
      
      $comment = factory('App\Comment')->create()->toArray();
      $like = factory('App\Like')->create([
                                    'likeable_id' => $comment['id'],
                                    'likeable_type' => 'App\Comment',
          ])->toArray();

      $this
          ->actingAs(factory('App\User')->create())
          ->post('/likeComment', $like)
          ->assertOk();

    }

    // /** @test */
    // public function a_comment_can_not_be_liked_more_than_once()
    // {

    //   $user = factory('App\User')->create();
    //   try{
    //       $this
    //             ->actingAs($user)
    //             ->post('/likeComment');
      
    //         $this
    //             ->actingAs($user)
    //             ->post('/likeComment');
            
    //     }catch(\Exception $e){
    //         $this->fail('Can\'t like a comment twice');
    //     }

    //   $this->assertCount(1, Like::all());
    // }

    




}