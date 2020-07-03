<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;


class CreateNewProfile implements ShouldQueue
{
  

    /**
     * Handle the event.
     *
     * @param  NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        Profile::create([
            'user_id' => $event->user->id,
        ]);
    }
}
