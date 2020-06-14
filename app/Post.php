<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Post extends Model
{

    use Searchable;
        
    protected $guarded = [];

    protected $table = 'posts';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    } 

    public function author()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function searchableAs()
    {
        return 'posts_index';
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($post){
            $post->category()->increment('posts_count');
        });

    }


  

}
