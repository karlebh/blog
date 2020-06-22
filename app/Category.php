<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function path()
    {
        return route('category.show', $this->slug );
        // return '/category/' . $this->slug;
    }

}
