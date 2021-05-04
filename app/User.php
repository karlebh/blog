<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Searchable, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }
    
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function content()
    {
        return $this->belongsToMany('App\Post');
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    } 

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function boot()
    {
      parent::boot();

      static::created(function ($user) {
        $user->profile()->create(['user_id' => $user->id]);
      });
    }

    public function scopeAdmin($query)
    {
      $query->roles()
        ->where('name', 'admin')
        ->orWhere('name', 'moderator');
    }
  }
