<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DeveloperMiddleware
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
        if(Auth::user()->usertype == 'developer'|| Auth::user()->usertype == 'officer')
        {
            return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You are not allowed to view Winghead Dashboard!');
        }
    }
}
