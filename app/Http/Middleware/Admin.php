<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = new \App\Role;

        if(
            !$request->user() || 
            !$request->user()->roles->contains($role->findOrFail(1)->value > 2
            ) 
        )
        {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
