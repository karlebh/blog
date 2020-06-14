<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
	protected $fillable = ['user_id', 'slug'];

	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
