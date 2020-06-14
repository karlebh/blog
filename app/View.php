<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class View extends Model
{
	protected $fillable = [
		'user_id', 'viewable_type', 'viewable_id', 'slug',
		 'session_id', 'ip', 'url', 'agent',
						];

    public function viewable()
    {
    	return $this->morphTo();
    }

    public static function logView($model, $type = Post::class)
    {
        $data = View::where('ip', \Request::ip())->first();

        if($data->created_at->gte(now()->addMinutes(10))){
            return;
        }

    	View::create([
    		'user_id' => auth()->user()->id ?? null,
    		'viewable_type' => $type,
    		'viewable_id' => $model->id,
    		'slug' => $model->slug ?? '',
    		'session_id' => \Request::getSession()->get('id') ?? null,
    		'ip' => \Request::ip(),
    		'url' => \Request::url(),
    		'agent' => \Request::header('User-Agent'),
    	]);

    }
}







