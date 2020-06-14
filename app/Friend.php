<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Friendable;

class Friend extends Model
{
    use Friendable;

    protected $fillable = ['requester', 'requestee','status'];


}
