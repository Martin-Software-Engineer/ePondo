<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Checkifpossible
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
        // dd($request ->$this->id);
        $user_id = $request->user()->id;

        if (DB::table('jobseeker_backgrounds')->where('user_id', $user_id)->doesntExist()) {
            // dd($user_id);
            // return route('jobseeker.background.create');
            // return redirect('jobseeker/campaigns/index');
            // jobseeker.campaigns.create
            return redirect('jobseeker/background/create')->with('NoJobseekerBackground', 'Before beginning we would like to ask you a few more questions, thank you!');
        }

        return $next($request);
    }
}
