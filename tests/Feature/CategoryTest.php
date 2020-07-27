<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Category;

class CategoryTest extends TestCase
{
     use RefreshDatabase;

    /** @test */ 
  public function categories_are_displayed_to_all()
  {
    $this->get(route('category.index'))->assertOk();
  }

    /** @test */ 
  public function a_category_can_be_created()
  {
    $user = factory('App\User')->create();
    $category = factory('App\Category')->create();

    $this->actingAs($user)->post('category',[
                                'user_id' => $category->id,
                                'name' => $category->name,
                                'slug' => $category->slug,
                                'desc' => $category->desc,
                                'color' => $category->color,
                                'posts_count' => $category->posts_count,
                                'views_count' => $category->views_count,
                                ])->assertStatus(302);
      $this->assertCount(1, Category::all());
     }
                              
                              
    /** @test */
    public function duplicate_category_cannot_be_created()
    {
      $user = factory('App\User')->create();
     $category = factory('App\Category')->create();
      try{
    $this->actingAs($user)->post('category',[
                                'user_id' => $category->id,
                                'name' => $category->name,
                                'slug' => $category->slug,
                                'desc' => $category->desc,
                                'color' => $category->color,
                                'posts_count' => $category->posts_count,
                                'views_count' => $category->views_count,
                                ])->assertStatus(302);
  
     $this->actingAs($user)->post('category',[
                                'user_id' => $category->id,
                                'name' => $category->name,
                                'slug' => $category->slug,
                                'desc' => $category->desc,
                                'color' => $category->color,
                                'posts_count' => $category->posts_count,
                                'views_count' => $category->views_count,
                                ]);
      }catch(\Exception $e){
         $this->fail('Exactly same categories cannot be created');
      }
          $this->assertCount(1, Category::all());
    }

    /** @test */ 
    public function a_category_can_be_dislayed()
  {
 
    $category = factory(Category::class)->create();

    $response = $this->get(route('category.show', $category->slug))->assertOk();
    $response->assertSeeText($category->name);
  }

    /** @test */
    public function guests_cannot_create_category()
    {

        $this->post(route('category.store'))->assertStatus(302)->assertRedirect(route('login'));

        $this->assertCount(0, Category::all());

    }

    /** @test */
    public function guests_cannot_delete_category()
    {
        
        $category = factory(Category::class)->create();

        $this->delete(route('category.destroy', $category->slug))->assertStatus(302)->assertRedirect(route('login'));
    }

}
