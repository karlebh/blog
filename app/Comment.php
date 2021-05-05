<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];


    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    public function likes()
    {
    	return $this->morphMany(Post::class, 'likeable');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function commentable()
    {
    	return $this->morphTo();
    }
}
