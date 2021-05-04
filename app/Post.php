<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Post extends Model
{

    use Searchable;
        
    protected $guarded = [];

    protected $appends = ['path'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
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

    public function path()
    {
        return route('posts.show', $this->slug);
    }

    public function getPathAttribute()
    {
        return $this->path();
    }


  

}
