<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User as User;

class UserTest extends TestCase
{

        use RefreshDatabase;

         /** @test */
        public function user_can_be_created()
        {
            $user = factory(User::class)->create();

            $this->assertCount(1, User::all());
        }

        
}
