<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillables = ['user_id', 'name', 'value'];


    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
}
