<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class testmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        dd($request);
        if(!$request->user() && $request->user()->roles->name != "Backer"){
            return route ('login');
        }
        return $next($request);
    }
}
