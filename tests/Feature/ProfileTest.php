<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Profile;
use App\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */  
    public function guest_can_view_profile()
    {
       
        $this->get('/profile/' . factory(User::class)->create()->slug)->assertOk();
    }

    /** @test */ 
    public function profile_can_be_updated()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post('profile/update', factory(Profile::class)
            ->create(['user_id' => $user->id])
            ->toArray())
            ->assertStatus(302);
    }

    /** @test */ 
    public function guest_can_not_update_profile()
    {
        $user = factory(User::class)->create();

        $this
            ->post('profile/update')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */ 
    public function profile_data_update_is_optional()
    {
       $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post('profile/update', factory(Profile::class)
            ->create([
                'user_id' => $user->id,
                'location' => '',
                ])
            ->toArray())
            ->assertStatus(302);
    }

    /** @test */ 
    public function profile_data_update_is_optional_2()
    {
       $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post('profile/update', factory(Profile::class)
            ->create([
                'user_id' => $user->id,
                'location' => 'Umuode Village',
                'DOB' => '2020/07/17',
                ])
            ->toArray())
            ->assertStatus(302);
    }






  
}
