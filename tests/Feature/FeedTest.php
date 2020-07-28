<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class FeedTest extends TestCase
{
  public function test_a_user_followed_post_are_displayed()
  {
    $this->get(route('followedPosts'))->assertStatus(302);
  }
}
