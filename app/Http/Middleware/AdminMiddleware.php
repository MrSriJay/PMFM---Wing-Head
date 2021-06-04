<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'dg' || Auth::user()->usertype == 's01' || Auth::user()->usertype == 'c-controller' || Auth::user()->usertype == 'c-coordinator' || Auth::user()->usertype == 'hq')
        {
            return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You are not allowed to view the Admin Dashboard!');
        }
      
    }
}