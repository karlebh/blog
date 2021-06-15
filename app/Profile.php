<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
	protected $guarded = [];

	public function getRouteKeyName()
	{
		return 'username';
	}
	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
