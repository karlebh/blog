<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\User;
use App\Friend;
use App\Traits\Friendable;

class FriendableTest extends TestCase
{
    use RefreshDatabase, Friendable;

    public $user;
    public $user2;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory('App\User')->create();
        $this->user2 = factory('App\User')->create();

    }

   /** @test */
   public function a_user_can_add_a_friend_test()
   {
    Event::fake();
    $response = $this->actingAs($this->user)
                        ->get('/addFriend/'. $this->user2->id);
                        $response->assertStatus(200);
                        $response->assertJsonFragment(['status' => 0]);
    $this->assertCount(1, Friend::all());
   } 

     /** @test */
   public function a_user_can_add_a_friend_only_once()
   {
    Event::fake();
    try{

    $this->actingAs($this->user)->get('/addFriend/'. $this->user2->id);
    $this->actingAs($this->user)->get('/addFriend/'. $this->user2->id);

    }catch(\Exception $e){
       $this->fail('Friend can be added only once');
    }
    $this->assertCount(1, Friend::all());
   }

   /** @test */
   public function only_auth_user_can_have_friends()
   {
    Event::fake();
    $response = $this->get('/addFriend/'. $this->user2->id);
    $response->assertRedirect('/login');
    $this->assertCount(0, Friend::all());
   }

   /** @test */
   public function a_friend_can_be_accepted()
   {
    Event::fake();
    $this->actingAs($this->user)
                        ->get('/addFriend/'. $this->user2->id)
                        ->assertStatus(200)
                        ->assertJsonFragment(['status' => 0]);
    $this->assertCount(1, Friend::all());

    Event::fake();
    $this->actingAs($this->user2)
                        ->get('/acceptFriend/'. $this->user->id)
                        ->assertStatus(200)
                        ->assertJsonFragment(['status' => 1]);
    $this->assertCount(1, Friend::all());
   }

   /** @test */

   public function a_friendship_request_can_be_declined()
   {
    Event::fake();
    $this->actingAs($this->user)
                        ->get('/addFriend/'. $this->user2->id)
                        ->assertStatus(200)
                        ->assertJsonFragment(['status' => 0]);
    $this->assertCount(1, Friend::all());

    $this->actingAs($this->user2)
                        ->get('/declineFriend/'. $this->user->id)
                        ->assertOk();
    $this->assertCount(0, Friend::all());
   }

   /** @test */
   public function a_user_can_be_unfriended()
   {
    
   }


}
