<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;
use App\User;

class PostSubscriptionTest extends TestCase
{
    use RefreshDatabase;

   /** @test */
   public function user_can_subscribe_to_a_post()
   {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $this
            ->actingAs($user)
            ->post('followPost/' . $post->id)
            ->assertStatus(200);
   }

   /** @test */
   public function user_can_unsubscribe_to_a_post()
   {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $this
            ->actingAs($user)
            ->post('followPost/' . $post->id)
            ->assertStatus(200);

        $this
            ->actingAs($user)
            ->post('followPost/' . $post->id)
            ->assertStatus(200);

        $this->assertCount(0, $post->author);

   }

   /** @test */
   public function a_guest_may_not_subscribe_to_a_post()
   {
        $post = factory(Post::class)->create();

        $this
            ->post('followPost/' . $post->id)
            ->assertStatus(302)
            ->assertRedirect('/login');
   }

}
