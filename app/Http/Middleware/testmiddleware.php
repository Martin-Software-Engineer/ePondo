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
        // dd($request->user()->roles());
        // if($request){
        //     return route ('login');
        // }
        
        $users_id = $request->user()->role_id;

        if ($users_id == 1) {
             
             return $next($request);
         }
         else
        {
            return redirect('login'); 
            
        }

    }
}
